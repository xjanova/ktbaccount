<?php

namespace App\Services\Accounting;

use App\Helpers\TenantContext;
use App\Models\FiscalPeriod;
use App\Models\JournalEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ClosingService
{
    public function __construct(
        private JournalService $journalService,
        private ReportService $reportService,
    ) {}

    /**
     * ปิดงวดบัญชี - ป้องกันการบันทึกรายการเพิ่มเติม
     */
    public function closePeriod(FiscalPeriod $period): void
    {
        if ($period->is_closed) {
            throw new \InvalidArgumentException('งวดบัญชีนี้ปิดแล้ว');
        }

        $period->update([
            'is_closed' => true,
            'closed_by' => Auth::id(),
            'closed_at' => now(),
        ]);
    }

    /**
     * ปิดบัญชีสิ้นปี - โอนกำไร/ขาดทุนเข้าบัญชีกำไรสะสม (33010)
     */
    public function yearEndClosing(int $accountSetId, int $year): JournalEntry
    {
        $tenantId = TenantContext::id();
        $fromDate = Carbon::createFromDate($year, 1, 1)->toDateString();
        $toDate = Carbon::createFromDate($year, 12, 31)->toDateString();
        $retainedEarningsCode = config('ktbaccount.accounting.retained_earnings_code', '33010');

        // คำนวณงบกำไรขาดทุน
        $pl = $this->reportService->incomeStatement($accountSetId, $fromDate, $toDate);
        $netIncome = $pl['net_income'];

        if (abs($netIncome) < 0.01) {
            throw new \InvalidArgumentException('ไม่มีกำไรหรือขาดทุนสำหรับปีนี้');
        }

        // สร้าง closing entries: ปิดบัญชีรายได้และค่าใช้จ่าย → กำไรสะสม
        $lines = [];

        // ปิดรายได้ (Dr.รายได้ Cr.กำไรสะสม)
        foreach ($pl['revenues'] as $revenue) {
            $lines[] = [
                'account_code' => $revenue['code'],
                'debit' => $revenue['amount'],
                'credit' => 0,
            ];
        }

        // ปิดค่าใช้จ่าย (Dr.กำไรสะสม Cr.ค่าใช้จ่าย)
        foreach ($pl['expenses'] as $expense) {
            $lines[] = [
                'account_code' => $expense['code'],
                'debit' => 0,
                'credit' => $expense['amount'],
            ];
        }

        // กำไร/ขาดทุนสุทธิเข้ากำไรสะสม
        if ($netIncome > 0) {
            $lines[] = ['account_code' => $retainedEarningsCode, 'debit' => 0, 'credit' => $netIncome];
        } else {
            $lines[] = ['account_code' => $retainedEarningsCode, 'debit' => abs($netIncome), 'credit' => 0];
        }

        return $this->journalService->createEntry([
            'account_set_id' => $accountSetId,
            'entry_date' => $toDate,
            'journal_type' => 'general',
            'description' => "รายการบันทึกปิดบัญชี สิ้นงวดปี {$year}",
            'entry_type' => 'closing',
        ], $lines);
    }

    /**
     * สร้างงวดบัญชี 12 เดือนสำหรับปีที่ระบุ
     */
    public function generatePeriods(int $tenantId, int $year): Collection
    {
        $periods = collect();

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::createFromDate($year, $month, 1);
            $endDate = $startDate->copy()->endOfMonth();

            $period = FiscalPeriod::withoutGlobalScopes()->firstOrCreate(
                ['tenant_id' => $tenantId, 'year' => $year, 'period' => $month],
                [
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $endDate->toDateString(),
                    'is_closed' => false,
                ]
            );

            $periods->push($period);
        }

        return $periods;
    }
}
