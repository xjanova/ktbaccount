<?php

namespace App\Services\Fund;

use App\Helpers\TenantContext;
use App\Models\ProfitAllocation;
use App\Services\Accounting\JournalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfitAllocationService
{
    public function __construct(
        private JournalService $journalService,
    ) {}

    /**
     * สร้างรายการจัดสรรกำไร
     */
    public function create(array $data, array $items): ProfitAllocation
    {
        if (! $this->validatePercentages($items)) {
            throw new \InvalidArgumentException('ผลรวมร้อยละต้องเท่ากับ 100.00%');
        }

        return DB::transaction(function () use ($data, $items) {
            $allocation = ProfitAllocation::create([
                'tenant_id' => TenantContext::id(),
                'account_set_id' => $data['account_set_id'],
                'fiscal_year' => $data['fiscal_year'],
                'total_amount' => $data['total_amount'],
                'meeting_date' => $data['meeting_date'] ?? null,
                'meeting_resolution' => $data['meeting_resolution'] ?? null,
                'status' => 'draft',
                'created_by' => Auth::id(),
            ]);

            foreach ($items as $item) {
                $amount = round($data['total_amount'] * ($item['percentage'] / 100), 2);
                $allocation->items()->create([
                    'category' => $item['category'],
                    'percentage' => $item['percentage'],
                    'amount' => $amount,
                ]);
            }

            return $allocation->load('items');
        });
    }

    /**
     * ตรวจสอบร้อยละรวม = 100%
     */
    public function validatePercentages(array $items): bool
    {
        $total = array_sum(array_column($items, 'percentage'));

        return abs($total - 100.00) < 0.01;
    }

    /**
     * อนุมัติและบันทึกบัญชีจัดสรรกำไร
     */
    public function processAllocation(ProfitAllocation $allocation): void
    {
        DB::transaction(function () use ($allocation) {
            $allocation->load('items');
            $retainedEarningsCode = config('ktbaccount.accounting.retained_earnings_code', '33010');

            $lines = [];

            // Dr.กำไรสะสม (หักจากกำไรสะสม)
            $lines[] = [
                'account_code' => $retainedEarningsCode,
                'debit' => $allocation->total_amount,
                'credit' => 0,
            ];

            // Cr.แต่ละหมวดจัดสรร
            $categoryAccountMap = [
                'reserve' => '32010',
                'fund_contribution' => '32020',
                'dividend' => '32030',
                'public_benefit' => '32040',
                'committee_compensation' => '51010',
                'other' => '32020',
            ];

            foreach ($allocation->items as $item) {
                $accountCode = $categoryAccountMap[$item->category] ?? '32020';
                $lines[] = [
                    'account_code' => $accountCode,
                    'debit' => 0,
                    'credit' => $item->amount,
                ];
            }

            $journalEntry = $this->journalService->createEntry([
                'account_set_id' => $allocation->account_set_id,
                'entry_date' => $allocation->meeting_date ?? now()->toDateString(),
                'journal_type' => 'general',
                'description' => "จัดสรรกำไรประจำปี {$allocation->fiscal_year}",
                'source_type' => ProfitAllocation::class,
                'source_id' => $allocation->id,
            ], $lines);

            $allocation->update([
                'status' => 'approved',
                'journal_entry_id' => $journalEntry->id,
            ]);
        });
    }
}
