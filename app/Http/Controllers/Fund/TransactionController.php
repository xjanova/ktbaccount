<?php

declare(strict_types=1);

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\AccountSet;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Services\Accounting\JournalService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct(private JournalService $journalService) {}

    public function index(Request $request)
    {
        $transactions = collect();
        $tenant = TenantContext::get();

        if ($tenant) {
            $query = Transaction::where('tenant_id', $tenant->id);

            if ($request->type) {
                $query->where('type', $request->type);
            }
            if ($request->from_date) {
                $query->whereDate('transaction_date', '>=', $request->from_date);
            }
            if ($request->to_date) {
                $query->whereDate('transaction_date', '<=', $request->to_date);
            }
            if ($request->account_set) {
                $query->where('account_set_id', $request->account_set);
            }

            $transactions = $query->orderByDesc('transaction_date')->paginate(20);
        }

        $accountSets = $tenant ? AccountSet::where('tenant_id', $tenant->id)->get() : collect();

        return view('fund.transactions.index', compact('transactions', 'accountSets'));
    }

    public function create()
    {
        $tenant = TenantContext::get();
        $accountSets = $tenant ? AccountSet::where('tenant_id', $tenant->id)->get() : collect();
        $bankAccounts = $tenant ? BankAccount::where('tenant_id', $tenant->id)->where('is_active', true)->get() : collect();

        return view('fund.transactions.create', compact('accountSets', 'bankAccounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'account_set_id' => 'required|integer',
            'account_type' => 'required|in:cash,bank',
            'bank_account_id' => 'nullable|integer',
            'income_category_id' => 'required_if:type,income|nullable|string',
            'expense_category_id' => 'required_if:type,expense|nullable|string',
            'date' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:1000',
            'person_name' => 'nullable|string|max:255',
            'person_type' => 'nullable|string',
        ], [
            'type.required' => 'กรุณาเลือกประเภทรายการ',
            'amount.required' => 'กรุณากรอกจำนวนเงิน',
            'amount.min' => 'จำนวนเงินต้องมากกว่า 0',
            'date.required' => 'กรุณาเลือกวันที่',
            'income_category_id.required_if' => 'กรุณาเลือกประเภทรายรับ',
            'expense_category_id.required_if' => 'กรุณาเลือกประเภทรายจ่าย',
        ]);

        $tenant = TenantContext::get();
        if (! $tenant) {
            return back()->with('error', 'ไม่พบข้อมูลกองทุน');
        }

        // Parse date from dd/mm/yyyy format
        $transactionDate = Carbon::createFromFormat('d/m/Y', $validated['date'])->toDateString();

        // Determine category from the active tab
        $category = $validated['type'] === 'income'
            ? ($validated['income_category_id'] ?? 'other_income')
            : ($validated['expense_category_id'] ?? 'other_expense');

        $transaction = Transaction::create([
            'tenant_id' => $tenant->id,
            'account_set_id' => $validated['account_set_id'],
            'type' => $validated['type'],
            'payment_method' => $validated['account_type'],
            'bank_account_id' => $validated['bank_account_id'],
            'category' => $category,
            'transaction_date' => $transactionDate,
            'amount' => $validated['amount'],
            'description' => $validated['description'],
            'counterparty_type' => $validated['person_type'],
            'counterparty_name' => $validated['person_name'],
            'created_by' => Auth::id(),
        ]);

        // Auto journal entry
        try {
            $journalEntry = $this->journalService->createFromTransaction($transaction);
            $transaction->update(['journal_entry_id' => $journalEntry->id]);
        } catch (\Exception $e) {
            // Journal entry failed but transaction saved
            report($e);
        }

        $typeLabel = $validated['type'] === 'income' ? 'รายรับ' : 'รายจ่าย';
        $successMessage = "บันทึก{$typeLabel} ฿".number_format((float) $validated['amount'], 2).' เรียบร้อยแล้ว';

        if ($request->input('action') === 'save_and_new') {
            return redirect()->route('fund.transactions.create', ['type' => $validated['type']])
                ->with('success', $successMessage);
        }

        return redirect()->route('fund.transactions.index')
            ->with('success', $successMessage);
    }
}
