<?php

namespace App\Services\Accounting;

use App\Helpers\TenantContext;
use App\Models\FiscalPeriod;
use App\Models\JournalEntry;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JournalService
{
    /**
     * สร้างรายการบันทึกบัญชี พร้อมรายละเอียด (journal entry lines)
     */
    public function createEntry(array $data, array $lines): JournalEntry
    {
        if (! $this->validateBalance($lines)) {
            throw new \InvalidArgumentException('ยอดรวมเดบิตและเครดิตไม่เท่ากัน');
        }

        return DB::transaction(function () use ($data, $lines) {
            $tenantId = TenantContext::id();

            $fiscalPeriod = $this->resolveFiscalPeriod($tenantId, $data['entry_date']);

            if ($fiscalPeriod?->is_closed) {
                throw new \InvalidArgumentException('งวดบัญชีนี้ปิดแล้ว ไม่สามารถบันทึกรายการได้');
            }

            $entry = JournalEntry::create([
                'tenant_id' => $tenantId,
                'account_set_id' => $data['account_set_id'],
                'entry_number' => $this->nextEntryNumber($tenantId, $data['account_set_id']),
                'entry_date' => $data['entry_date'],
                'fiscal_period_id' => $fiscalPeriod?->id,
                'journal_type' => $data['journal_type'] ?? 'general',
                'description' => $data['description'],
                'reference_number' => $data['reference_number'] ?? null,
                'entry_type' => $data['entry_type'] ?? 'normal',
                'source_type' => $data['source_type'] ?? null,
                'source_id' => $data['source_id'] ?? null,
                'is_posted' => true,
                'created_by' => Auth::id(),
            ]);

            foreach ($lines as $index => $line) {
                $entry->lines()->create([
                    'account_code' => $line['account_code'],
                    'debit' => $line['debit'] ?? 0,
                    'credit' => $line['credit'] ?? 0,
                    'description' => $line['description'] ?? null,
                    'sort_order' => $index,
                ]);
            }

            return $entry->load('lines');
        });
    }

    /**
     * สร้าง journal entry จากรายการรายรับ-รายจ่าย อัตโนมัติ
     */
    public function createFromTransaction(Transaction $transaction): JournalEntry
    {
        $config = config('ktbaccount.accounting');

        // กำหนดรหัสบัญชีตามประเภทรายรับ/รายจ่าย
        $cashAccountCode = $transaction->payment_method === 'cash' ? '11010' : '12010';

        // หารหัสบัญชีรายได้/ค่าใช้จ่ายจาก category
        $categoryAccountCode = $this->getCategoryAccountCode(
            $transaction->type,
            $transaction->category
        );

        $lines = [];

        if ($transaction->type === 'income') {
            // รายรับ: Dr.เงินสด/ธนาคาร Cr.รายได้
            $lines[] = ['account_code' => $cashAccountCode, 'debit' => $transaction->amount, 'credit' => 0];
            $lines[] = ['account_code' => $categoryAccountCode, 'debit' => 0, 'credit' => $transaction->amount];
        } else {
            // รายจ่าย: Dr.ค่าใช้จ่าย Cr.เงินสด/ธนาคาร
            $lines[] = ['account_code' => $categoryAccountCode, 'debit' => $transaction->amount, 'credit' => 0];
            $lines[] = ['account_code' => $cashAccountCode, 'debit' => 0, 'credit' => $transaction->amount];
        }

        $journalType = $transaction->type === 'income' ? 'cash_receipt' : 'cash_payment';

        return $this->createEntry([
            'account_set_id' => $transaction->account_set_id,
            'entry_date' => $transaction->transaction_date,
            'journal_type' => $journalType,
            'description' => $transaction->description ?? ($transaction->type === 'income' ? 'รายรับ' : 'รายจ่าย'),
            'reference_number' => $transaction->receipt_number,
            'source_type' => Transaction::class,
            'source_id' => $transaction->id,
        ], $lines);
    }

    /**
     * กลับรายการบัญชี (reverse entry)
     */
    public function reverseEntry(JournalEntry $entry, string $reason): JournalEntry
    {
        $reversedLines = $entry->lines->map(fn ($line) => [
            'account_code' => $line->account_code,
            'debit' => $line->credit,
            'credit' => $line->debit,
            'description' => "กลับรายการ: {$line->description}",
        ])->toArray();

        return $this->createEntry([
            'account_set_id' => $entry->account_set_id,
            'entry_date' => now()->toDateString(),
            'journal_type' => 'general',
            'description' => "กลับรายการ #{$entry->entry_number}: {$reason}",
            'reference_number' => $entry->entry_number,
        ], $reversedLines);
    }

    /**
     * ตรวจสอบว่ายอดเดบิต = เครดิต
     */
    public function validateBalance(array $lines): bool
    {
        $totalDebit = array_sum(array_column($lines, 'debit'));
        $totalCredit = array_sum(array_column($lines, 'credit'));

        return abs($totalDebit - $totalCredit) < 0.01;
    }

    /**
     * สร้างเลขที่เอกสารลำดับถัดไป
     */
    public function nextEntryNumber(int $tenantId, int $accountSetId): string
    {
        $year = now()->format('Y');
        $prefix = "JV{$year}-";

        $lastEntry = JournalEntry::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where('account_set_id', $accountSetId)
            ->where('entry_number', 'like', "{$prefix}%")
            ->orderByDesc('entry_number')
            ->first();

        $lastNumber = 0;
        if ($lastEntry) {
            $lastNumber = (int) str_replace($prefix, '', $lastEntry->entry_number);
        }

        return $prefix.str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
    }

    private function resolveFiscalPeriod(int $tenantId, string $date): ?FiscalPeriod
    {
        $dateObj = Carbon::parse($date);

        return FiscalPeriod::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where('year', $dateObj->year)
            ->where('period', $dateObj->month)
            ->first();
    }

    private function getCategoryAccountCode(string $type, string $category): string
    {
        $map = [
            'income' => [
                'loan_interest' => '41010',
                'membership_fee' => '41020',
                'deposit_interest' => '42010',
                'government_fund' => '31030',
                'other_income' => '43010',
            ],
            'expense' => [
                'committee_compensation' => '51010',
                'travel' => '51020',
                'utilities' => '51030',
                'meeting' => '51040',
                'training' => '51050',
                'office_supplies' => '51060',
                'interest_expense' => '52010',
                'bad_debt' => '53010',
                'other_expense' => '54010',
            ],
        ];

        return $map[$type][$category] ?? ($type === 'income' ? '43010' : '54010');
    }
}
