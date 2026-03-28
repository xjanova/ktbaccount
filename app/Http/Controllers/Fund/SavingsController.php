<?php

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\SavingsAccount;
use App\Services\Fund\SavingsService;
use Illuminate\Http\Request;

class SavingsController extends Controller
{
    public function __construct(private SavingsService $savingsService) {}

    public function index()
    {
        $accounts = collect();
        $tenant = TenantContext::get();

        if ($tenant) {
            $accounts = SavingsAccount::where('tenant_id', $tenant->id)
                ->with('member')
                ->orderByDesc('created_at')
                ->paginate(20);
        }

        return view('fund.savings.index', compact('accounts'));
    }

    public function create()
    {
        $tenant = TenantContext::get();
        $members = $tenant
            ? Member::where('tenant_id', $tenant->id)->where('status', 'active')->get()
            : collect();

        return view('fund.savings.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer',
            'account_type' => 'required|string',
            'interest_rate' => 'required|numeric|min:0',
        ], [
            'member_id.required' => 'กรุณาเลือกสมาชิก',
            'interest_rate.required' => 'กรุณากรอกอัตราดอกเบี้ย',
        ]);

        $account = $this->savingsService->openAccount($validated);

        return redirect()->route('fund.deposits.index')
            ->with('success', "เปิดบัญชีเงินฝาก {$account->account_number} เรียบร้อยแล้ว");
    }

    public function deposit(Request $request, $id)
    {
        $account = SavingsAccount::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'nullable|date',
            'description' => 'nullable|string|max:500',
        ], [
            'amount.required' => 'กรุณากรอกจำนวนเงิน',
            'amount.min' => 'จำนวนเงินต้องมากกว่า 0',
        ]);

        $this->savingsService->deposit($account, $validated);

        return back()->with('success', 'ฝากเงิน ฿'.number_format($validated['amount'], 2).' เรียบร้อยแล้ว');
    }

    public function withdraw(Request $request, $id)
    {
        $account = SavingsAccount::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'nullable|date',
            'description' => 'nullable|string|max:500',
        ]);

        try {
            $this->savingsService->withdraw($account, $validated);

            return back()->with('success', 'ถอนเงิน ฿'.number_format($validated['amount'], 2).' เรียบร้อยแล้ว');
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
