<?php

namespace App\Services\Fund;

use App\Helpers\TenantContext;
use App\Models\Member;
use App\Models\Share;
use App\Models\ShareTransaction;
use App\Services\Accounting\JournalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShareService
{
    public function __construct(
        private JournalService $journalService,
    ) {}

    /**
     * ซื้อหุ้น
     */
    public function buyShares(Member $member, int $shares, array $data): ShareTransaction
    {
        return DB::transaction(function () use ($member, $shares, $data) {
            $sharePrice = $data['share_price'] ?? config('ktbaccount.share.default_price', 10.00);
            $amount = $shares * $sharePrice;

            $share = Share::firstOrCreate(
                ['tenant_id' => TenantContext::id(), 'member_id' => $member->id],
                [
                    'account_set_id' => $data['account_set_id'] ?? null,
                    'total_shares' => 0,
                    'total_value' => 0,
                    'share_price' => $sharePrice,
                ]
            );

            $transaction = ShareTransaction::create([
                'share_id' => $share->id,
                'type' => 'buy',
                'shares' => $shares,
                'amount' => $amount,
                'transaction_date' => $data['transaction_date'] ?? now()->toDateString(),
                'processed_by' => Auth::id(),
            ]);

            $share->increment('total_shares', $shares);
            $share->increment('total_value', $amount);

            // บันทึกบัญชี: Dr.เงินสด Cr.ทุนหุ้นสมาชิก
            $journalEntry = $this->journalService->createEntry([
                'account_set_id' => $share->account_set_id ?? 1,
                'entry_date' => $transaction->transaction_date,
                'journal_type' => 'cash_receipt',
                'description' => "รับซื้อหุ้น {$shares} หุ้น จาก {$member->first_name} {$member->last_name}",
                'source_type' => ShareTransaction::class,
                'source_id' => $transaction->id,
            ], [
                ['account_code' => '11010', 'debit' => $amount, 'credit' => 0],
                ['account_code' => '32050', 'debit' => 0, 'credit' => $amount],
            ]);

            $transaction->update(['journal_entry_id' => $journalEntry->id]);

            return $transaction;
        });
    }

    /**
     * ขาย/ถอนหุ้น
     */
    public function sellShares(Member $member, int $shares, array $data): ShareTransaction
    {
        $share = Share::where('member_id', $member->id)->first();

        if (! $share || $share->total_shares < $shares) {
            throw new \InvalidArgumentException('จำนวนหุ้นไม่เพียงพอ');
        }

        return DB::transaction(function () use ($member, $shares, $data, $share) {
            $amount = $shares * $share->share_price;

            $transaction = ShareTransaction::create([
                'share_id' => $share->id,
                'type' => 'sell',
                'shares' => $shares,
                'amount' => $amount,
                'transaction_date' => $data['transaction_date'] ?? now()->toDateString(),
                'processed_by' => Auth::id(),
            ]);

            $share->decrement('total_shares', $shares);
            $share->decrement('total_value', $amount);

            // บันทึกบัญชี: Dr.ทุนหุ้นสมาชิก Cr.เงินสด
            $journalEntry = $this->journalService->createEntry([
                'account_set_id' => $share->account_set_id ?? 1,
                'entry_date' => $transaction->transaction_date,
                'journal_type' => 'cash_payment',
                'description' => "จ่ายคืนหุ้น {$shares} หุ้น ให้ {$member->first_name} {$member->last_name}",
                'source_type' => ShareTransaction::class,
                'source_id' => $transaction->id,
            ], [
                ['account_code' => '32050', 'debit' => $amount, 'credit' => 0],
                ['account_code' => '11010', 'debit' => 0, 'credit' => $amount],
            ]);

            $transaction->update(['journal_entry_id' => $journalEntry->id]);

            return $transaction;
        });
    }

    public function getMemberShares(Member $member): ?Share
    {
        return Share::where('member_id', $member->id)->first();
    }
}
