<?php

namespace App\Services\Fund;

use App\Helpers\TenantContext;
use App\Models\SavingsAccount;
use App\Models\SavingsTransaction;
use App\Services\Accounting\JournalService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavingsService
{
    public function __construct(
        private JournalService $journalService,
    ) {}

    /**
     * เปิดบัญชีเงินฝาก
     */
    public function openAccount(array $data): SavingsAccount
    {
        $tenantId = TenantContext::id();

        return SavingsAccount::create([
            'tenant_id' => $tenantId,
            'account_set_id' => $data['account_set_id'] ?? null,
            'member_id' => $data['member_id'],
            'account_number' => $this->generateAccountNumber($tenantId),
            'account_type' => $data['account_type'] ?? 'regular',
            'balance' => 0,
            'interest_rate' => $data['interest_rate'] ?? 0,
            'opened_date' => $data['opened_date'] ?? now()->toDateString(),
            'status' => 'active',
        ]);
    }

    /**
     * ฝากเงิน
     */
    public function deposit(SavingsAccount $account, array $data): SavingsTransaction
    {
        return DB::transaction(function () use ($account, $data) {
            $amount = $data['amount'];
            $newBalance = $account->balance + $amount;

            $transaction = SavingsTransaction::create([
                'savings_account_id' => $account->id,
                'type' => 'deposit',
                'amount' => $amount,
                'balance_after' => $newBalance,
                'transaction_date' => $data['transaction_date'] ?? now()->toDateString(),
                'description' => $data['description'] ?? 'ฝากเงิน',
                'processed_by' => Auth::id(),
            ]);

            $account->update(['balance' => $newBalance]);

            // บันทึกบัญชี: Dr.เงินสด Cr.เงินรับฝาก
            $journalEntry = $this->journalService->createEntry([
                'account_set_id' => $account->account_set_id ?? 1,
                'entry_date' => $transaction->transaction_date,
                'journal_type' => 'cash_receipt',
                'description' => "รับฝากเงิน บัญชี {$account->account_number}",
                'source_type' => SavingsTransaction::class,
                'source_id' => $transaction->id,
            ], [
                ['account_code' => '11010', 'debit' => $amount, 'credit' => 0],
                ['account_code' => '21010', 'debit' => 0, 'credit' => $amount],
            ]);

            $transaction->update(['journal_entry_id' => $journalEntry->id]);

            return $transaction;
        });
    }

    /**
     * ถอนเงิน
     */
    public function withdraw(SavingsAccount $account, array $data): SavingsTransaction
    {
        $amount = $data['amount'];

        if ($amount > $account->balance) {
            throw new \InvalidArgumentException('ยอดเงินฝากไม่เพียงพอ');
        }

        return DB::transaction(function () use ($account, $data, $amount) {
            $newBalance = $account->balance - $amount;

            $transaction = SavingsTransaction::create([
                'savings_account_id' => $account->id,
                'type' => 'withdraw',
                'amount' => $amount,
                'balance_after' => $newBalance,
                'transaction_date' => $data['transaction_date'] ?? now()->toDateString(),
                'description' => $data['description'] ?? 'ถอนเงิน',
                'processed_by' => Auth::id(),
            ]);

            $account->update(['balance' => $newBalance]);

            // บันทึกบัญชี: Dr.เงินรับฝาก Cr.เงินสด
            $journalEntry = $this->journalService->createEntry([
                'account_set_id' => $account->account_set_id ?? 1,
                'entry_date' => $transaction->transaction_date,
                'journal_type' => 'cash_payment',
                'description' => "จ่ายคืนเงินฝาก บัญชี {$account->account_number}",
                'source_type' => SavingsTransaction::class,
                'source_id' => $transaction->id,
            ], [
                ['account_code' => '21010', 'debit' => $amount, 'credit' => 0],
                ['account_code' => '11010', 'debit' => 0, 'credit' => $amount],
            ]);

            $transaction->update(['journal_entry_id' => $journalEntry->id]);

            return $transaction;
        });
    }

    /**
     * คำนวณดอกเบี้ยเงินฝาก
     */
    public function calculateInterest(SavingsAccount $account, string $asOfDate): float
    {
        if ($account->interest_rate <= 0) {
            return 0;
        }

        $openedDate = Carbon::parse($account->opened_date);
        $endDate = Carbon::parse($asOfDate);
        $days = $openedDate->diffInDays($endDate);

        return round($account->balance * ($account->interest_rate / 100) * ($days / 365), 2);
    }

    private function generateAccountNumber(int $tenantId): string
    {
        $prefix = 'SAV-';
        $last = SavingsAccount::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where('account_number', 'like', "{$prefix}%")
            ->orderByDesc('account_number')
            ->first();

        $lastNum = $last ? (int) str_replace($prefix, '', $last->account_number) : 0;

        return $prefix.str_pad($lastNum + 1, 6, '0', STR_PAD_LEFT);
    }
}
