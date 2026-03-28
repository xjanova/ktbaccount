<?php

namespace App\Services\Fund;

use App\Helpers\TenantContext;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanSchedule;
use App\Services\Accounting\JournalService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanService
{
    public function __construct(
        private JournalService $journalService,
    ) {}

    /**
     * สร้างสัญญาสินเชื่อ พร้อมตารางผ่อนชำระ
     */
    public function createLoan(array $data): Loan
    {
        return DB::transaction(function () use ($data) {
            $tenantId = TenantContext::id();

            $loan = Loan::create([
                'tenant_id' => $tenantId,
                'account_set_id' => $data['account_set_id'],
                'member_id' => $data['member_id'],
                'loan_code' => $this->generateLoanCode($tenantId),
                'loan_type' => $data['loan_type'] ?? 'regular',
                'principal' => $data['principal'],
                'interest_rate' => $data['interest_rate'],
                'term_months' => $data['term_months'],
                'status' => 'pending',
                'guarantor_1_id' => $data['guarantor_1_id'] ?? null,
                'guarantor_2_id' => $data['guarantor_2_id'] ?? null,
                'outstanding_balance' => $data['principal'],
                'created_by' => Auth::id(),
            ]);

            $this->generateSchedule($loan);

            return $loan->load('schedules', 'member');
        });
    }

    /**
     * สร้างตารางผ่อนชำระ (flat rate)
     */
    public function generateSchedule(Loan $loan): Collection
    {
        // คำนวณแบบ flat rate (ดอกเบี้ยคงที่)
        $monthlyInterest = ($loan->principal * $loan->interest_rate / 100) / 12;
        $monthlyPrincipal = $loan->principal / $loan->term_months;
        $monthlyTotal = $monthlyPrincipal + $monthlyInterest;

        $startDate = $loan->disbursed_date
            ? Carbon::parse($loan->disbursed_date)
            : Carbon::now();

        $schedules = collect();

        for ($i = 1; $i <= $loan->term_months; $i++) {
            $dueDate = $startDate->copy()->addMonths($i);

            // งวดสุดท้าย: ปัดเศษเงินต้นที่เหลือ
            $principal = $i === $loan->term_months
                ? $loan->principal - ($monthlyPrincipal * ($loan->term_months - 1))
                : $monthlyPrincipal;

            $schedule = $loan->schedules()->create([
                'installment_no' => $i,
                'due_date' => $dueDate->toDateString(),
                'principal_amount' => round($principal, 2),
                'interest_amount' => round($monthlyInterest, 2),
                'total_amount' => round($principal + $monthlyInterest, 2),
                'status' => 'pending',
            ]);

            $schedules->push($schedule);
        }

        // อัพเดทวันครบกำหนดสินเชื่อ
        $loan->update(['due_date' => $schedules->last()->due_date]);

        return $schedules;
    }

    /**
     * บันทึกการชำระสินเชื่อ
     */
    public function recordPayment(Loan $loan, array $data): LoanPayment
    {
        return DB::transaction(function () use ($loan, $data) {
            $schedule = null;
            if (isset($data['loan_schedule_id'])) {
                $schedule = LoanSchedule::find($data['loan_schedule_id']);
            } else {
                // หางวดที่ยังไม่ชำระ
                $schedule = $loan->schedules()->where('status', 'pending')->orderBy('installment_no')->first();
            }

            $payment = LoanPayment::create([
                'loan_id' => $loan->id,
                'loan_schedule_id' => $schedule?->id,
                'payment_date' => $data['payment_date'] ?? now()->toDateString(),
                'amount' => $data['amount'],
                'principal_paid' => $data['principal_paid'] ?? $schedule?->principal_amount ?? $data['amount'],
                'interest_paid' => $data['interest_paid'] ?? $schedule?->interest_amount ?? 0,
                'payment_method' => $data['payment_method'] ?? 'cash',
                'receipt_number' => $data['receipt_number'] ?? null,
                'received_by' => Auth::id(),
            ]);

            // อัพเดทสถานะงวด
            if ($schedule) {
                $schedule->update(['status' => 'paid']);
            }

            // อัพเดทยอดคงเหลือ
            $loan->decrement('outstanding_balance', $payment->principal_paid);

            // ตรวจสอบว่าชำระครบหรือยัง
            if ($loan->fresh()->outstanding_balance <= 0.01) {
                $loan->update(['status' => 'completed']);
            }

            // บันทึกบัญชี: Dr.เงิ��สด Cr.ลูกหนี้(เงินต้น) + Cr.รายได้ดอกเบี้ย
            $cashCode = $payment->payment_method === 'cash' ? '11010' : '12010';
            $receivableCode = '13010';
            $interestIncomeCode = '41010';

            $lines = [];
            $lines[] = ['account_code' => $cashCode, 'debit' => $payment->amount, 'credit' => 0];
            if ($payment->principal_paid > 0) {
                $lines[] = ['account_code' => $receivableCode, 'debit' => 0, 'credit' => $payment->principal_paid];
            }
            if ($payment->interest_paid > 0) {
                $lines[] = ['account_code' => $interestIncomeCode, 'debit' => 0, 'credit' => $payment->interest_paid];
            }

            $journalEntry = $this->journalService->createEntry([
                'account_set_id' => $loan->account_set_id,
                'entry_date' => $payment->payment_date,
                'journal_type' => 'cash_receipt',
                'description' => "รับชำระสินเชื่อ {$loan->loan_code} งวดที่ ".($schedule?->installment_no ?? '-'),
                'source_type' => LoanPayment::class,
                'source_id' => $payment->id,
            ], $lines);

            $payment->update(['journal_entry_id' => $journalEntry->id]);

            return $payment->load('loan', 'loanSchedule');
        });
    }

    /**
     * เบิกจ่ายเงินกู้ (disburse loan)
     */
    public function disburseLoan(Loan $loan): void
    {
        DB::transaction(function () use ($loan) {
            $loan->update([
                'status' => 'active',
                'disbursed_date' => now()->toDateString(),
            ]);

            // Regenerate schedule from disbursement date
            $loan->schedules()->delete();
            $this->generateSchedule($loan);

            // ��ันทึกบัญชี: Dr.ลูกหนี้ Cr.เงินสด/ธนาคาร
            $this->journalService->createEntry([
                'account_set_id' => $loan->account_set_id,
                'entry_date' => now()->toDateString(),
                'journal_type' => 'cash_payment',
                'description' => "เบิกจ่ายเงินกู้ {$loan->loan_code}",
                'source_type' => Loan::class,
                'source_id' => $loan->id,
            ], [
                ['account_code' => '13010', 'debit' => $loan->principal, 'credit' => 0],
                ['account_code' => '11010', 'debit' => 0, 'credit' => $loan->principal],
            ]);
        });
    }

    /**
     * สินเชื่อที่ค้างชำระ
     */
    public function getOverdueLoans(int $tenantId): Collection
    {
        return Loan::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->whereIn('status', ['active', 'disbursed'])
            ->whereHas('schedules', fn ($q) => $q->where('status', 'pending')->where('due_date', '<', now()))
            ->with(['member', 'schedules' => fn ($q) => $q->where('status', 'pending')->where('due_date', '<', now())])
            ->get();
    }

    public function calculateOutstanding(Loan $loan): float
    {
        $totalPaid = $loan->payments()->sum('principal_paid');

        return round($loan->principal - $totalPaid, 2);
    }

    private function generateLoanCode(int $tenantId): string
    {
        $year = now()->format('Y');
        $prefix = "LN{$year}-";

        $lastLoan = Loan::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where('loan_code', 'like', "{$prefix}%")
            ->orderByDesc('loan_code')
            ->first();

        $lastNumber = $lastLoan ? (int) str_replace($prefix, '', $lastLoan->loan_code) : 0;

        return $prefix.str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
    }
}
