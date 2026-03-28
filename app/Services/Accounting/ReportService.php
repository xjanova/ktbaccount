<?php

namespace App\Services\Accounting;

use App\Helpers\TenantContext;
use App\Models\ChartOfAccount;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * งบทดลอง (Trial Balance)
     */
    public function trialBalance(int $accountSetId, string $fromDate, string $toDate, bool $includeClosing = false): array
    {
        $tenantId = TenantContext::id();

        $query = DB::table('journal_entry_lines as jel')
            ->join('journal_entries as je', 'jel.journal_entry_id', '=', 'je.id')
            ->where('je.tenant_id', $tenantId)
            ->where('je.account_set_id', $accountSetId)
            ->whereBetween('je.entry_date', [$fromDate, $toDate])
            ->where('je.is_posted', true);

        if (! $includeClosing) {
            $query->where('je.entry_type', '!=', 'closing');
        }

        $balances = $query
            ->select('jel.account_code', DB::raw('SUM(jel.debit) as total_debit'), DB::raw('SUM(jel.credit) as total_credit'))
            ->groupBy('jel.account_code')
            ->orderBy('jel.account_code')
            ->get();

        $accounts = ChartOfAccount::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where(function ($q) use ($accountSetId) {
                $q->where('account_set_id', $accountSetId)->orWhereNull('account_set_id');
            })
            ->where('is_active', true)
            ->orderBy('code')
            ->get()
            ->keyBy('code');

        $rows = [];
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($balances as $balance) {
            $account = $accounts->get($balance->account_code);
            $rows[] = [
                'code' => $balance->account_code,
                'name' => $account?->name ?? 'ไม่พบรหัสบัญชี',
                'debit' => round($balance->total_debit, 2),
                'credit' => round($balance->total_credit, 2),
            ];
            $totalDebit += $balance->total_debit;
            $totalCredit += $balance->total_credit;
        }

        return [
            'rows' => $rows,
            'total_debit' => round($totalDebit, 2),
            'total_credit' => round($totalCredit, 2),
            'is_balanced' => abs($totalDebit - $totalCredit) < 0.01,
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ];
    }

    /**
     * งบกำไรขาดทุน (Income Statement / P&L)
     */
    public function incomeStatement(int $accountSetId, string $fromDate, string $toDate): array
    {
        $tenantId = TenantContext::id();

        $balances = DB::table('journal_entry_lines as jel')
            ->join('journal_entries as je', 'jel.journal_entry_id', '=', 'je.id')
            ->where('je.tenant_id', $tenantId)
            ->where('je.account_set_id', $accountSetId)
            ->whereBetween('je.entry_date', [$fromDate, $toDate])
            ->where('je.is_posted', true)
            ->where('je.entry_type', '!=', 'closing')
            ->select('jel.account_code', DB::raw('SUM(jel.debit) as total_debit'), DB::raw('SUM(jel.credit) as total_credit'))
            ->groupBy('jel.account_code')
            ->get()
            ->keyBy('account_code');

        $accounts = ChartOfAccount::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where(function ($q) use ($accountSetId) {
                $q->where('account_set_id', $accountSetId)->orWhereNull('account_set_id');
            })
            ->whereIn('category', ['revenue', 'expense'])
            ->where('is_control_account', false)
            ->where('is_active', true)
            ->orderBy('code')
            ->get();

        $revenues = [];
        $expenses = [];
        $totalRevenue = 0;
        $totalExpense = 0;

        foreach ($accounts as $account) {
            $balance = $balances->get($account->code);
            if (! $balance) {
                continue;
            }

            $amount = $account->category === 'revenue'
                ? $balance->total_credit - $balance->total_debit
                : $balance->total_debit - $balance->total_credit;

            if (abs($amount) < 0.01) {
                continue;
            }

            $row = ['code' => $account->code, 'name' => $account->name, 'amount' => round($amount, 2)];

            if ($account->category === 'revenue') {
                $revenues[] = $row;
                $totalRevenue += $amount;
            } else {
                $expenses[] = $row;
                $totalExpense += $amount;
            }
        }

        return [
            'revenues' => $revenues,
            'expenses' => $expenses,
            'total_revenue' => round($totalRevenue, 2),
            'total_expense' => round($totalExpense, 2),
            'net_income' => round($totalRevenue - $totalExpense, 2),
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ];
    }

    /**
     * งบแสดงฐานะการเงิน / งบดุล (Balance Sheet)
     */
    public function balanceSheet(int $accountSetId, string $asOfDate, bool $includeClosing = false): array
    {
        $tenantId = TenantContext::id();

        $query = DB::table('journal_entry_lines as jel')
            ->join('journal_entries as je', 'jel.journal_entry_id', '=', 'je.id')
            ->where('je.tenant_id', $tenantId)
            ->where('je.account_set_id', $accountSetId)
            ->where('je.entry_date', '<=', $asOfDate)
            ->where('je.is_posted', true);

        if (! $includeClosing) {
            $query->where('je.entry_type', '!=', 'closing');
        }

        $balances = $query
            ->select('jel.account_code', DB::raw('SUM(jel.debit) as total_debit'), DB::raw('SUM(jel.credit) as total_credit'))
            ->groupBy('jel.account_code')
            ->get()
            ->keyBy('account_code');

        $accounts = ChartOfAccount::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->where(function ($q) use ($accountSetId) {
                $q->where('account_set_id', $accountSetId)->orWhereNull('account_set_id');
            })
            ->whereIn('category', ['asset', 'liability', 'equity'])
            ->where('is_control_account', false)
            ->where('is_active', true)
            ->orderBy('code')
            ->get();

        $assets = [];
        $liabilities = [];
        $equity = [];
        $totalAssets = 0;
        $totalLiabilities = 0;
        $totalEquity = 0;

        foreach ($accounts as $account) {
            $balance = $balances->get($account->code);
            if (! $balance) {
                continue;
            }

            $amount = $account->normal_balance === 'debit'
                ? $balance->total_debit - $balance->total_credit
                : $balance->total_credit - $balance->total_debit;

            if (abs($amount) < 0.01) {
                continue;
            }

            $row = ['code' => $account->code, 'name' => $account->name, 'amount' => round($amount, 2)];

            match ($account->category) {
                'asset' => ($assets[] = $row) && ($totalAssets += $amount),
                'liability' => ($liabilities[] = $row) && ($totalLiabilities += $amount),
                'equity' => ($equity[] = $row) && ($totalEquity += $amount),
            };
        }

        return [
            'assets' => $assets,
            'liabilities' => $liabilities,
            'equity' => $equity,
            'total_assets' => round($totalAssets, 2),
            'total_liabilities' => round($totalLiabilities, 2),
            'total_equity' => round($totalEquity, 2),
            'total_liabilities_and_equity' => round($totalLiabilities + $totalEquity, 2),
            'is_balanced' => abs($totalAssets - ($totalLiabilities + $totalEquity)) < 0.01,
            'as_of_date' => $asOfDate,
        ];
    }

    /**
     * รายงานบัญชีแยกประเภท (General Ledger)
     */
    public function generalLedger(int $accountSetId, string $fromDate, string $toDate, ?string $fromAccount = null, ?string $toAccount = null): array
    {
        $tenantId = TenantContext::id();

        $query = DB::table('journal_entry_lines as jel')
            ->join('journal_entries as je', 'jel.journal_entry_id', '=', 'je.id')
            ->where('je.tenant_id', $tenantId)
            ->where('je.account_set_id', $accountSetId)
            ->whereBetween('je.entry_date', [$fromDate, $toDate])
            ->where('je.is_posted', true);

        if ($fromAccount) {
            $query->where('jel.account_code', '>=', $fromAccount);
        }
        if ($toAccount) {
            $query->where('jel.account_code', '<=', $toAccount);
        }

        $entries = $query
            ->select('jel.account_code', 'je.entry_number', 'je.entry_date', 'je.description', 'jel.debit', 'jel.credit', 'jel.description as line_description')
            ->orderBy('jel.account_code')
            ->orderBy('je.entry_date')
            ->orderBy('je.entry_number')
            ->get();

        $accounts = ChartOfAccount::withoutGlobalScopes()
            ->where('tenant_id', $tenantId)
            ->get()
            ->keyBy('code');

        $grouped = $entries->groupBy('account_code')->map(function ($items, $code) use ($accounts) {
            $account = $accounts->get($code);
            $runningBalance = 0;
            $movements = $items->map(function ($item) use ($account, &$runningBalance) {
                $movement = $account?->normal_balance === 'debit'
                    ? $item->debit - $item->credit
                    : $item->credit - $item->debit;
                $runningBalance += $movement;

                return [
                    'date' => $item->entry_date,
                    'entry_number' => $item->entry_number,
                    'description' => $item->line_description ?? $item->description,
                    'debit' => round($item->debit, 2),
                    'credit' => round($item->credit, 2),
                    'balance' => round($runningBalance, 2),
                ];
            });

            return [
                'code' => $code,
                'name' => $account?->name ?? 'ไม่พบรหัสบัญชี',
                'movements' => $movements->toArray(),
                'total_debit' => round($items->sum('debit'), 2),
                'total_credit' => round($items->sum('credit'), 2),
                'closing_balance' => round($runningBalance, 2),
            ];
        });

        return [
            'accounts' => $grouped->values()->toArray(),
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ];
    }
}
