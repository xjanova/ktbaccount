<?php

declare(strict_types=1);

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\AccountSet;
use App\Models\Loan;
use App\Models\Member;
use App\Services\Fund\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(private LoanService $loanService) {}

    public function index(Request $request)
    {
        $loans = collect();
        $tenant = TenantContext::get();

        if ($tenant) {
            $query = Loan::where('tenant_id', $tenant->id)->with('member');

            if ($request->status) {
                $query->where('status', $request->status);
            }
            if ($request->member) {
                $query->whereHas('member', function ($q) use ($request) {
                    $q->where('first_name', 'like', "%{$request->member}%")
                        ->orWhere('last_name', 'like', "%{$request->member}%")
                        ->orWhere('member_code', 'like', "%{$request->member}%");
                });
            }

            $loans = $query->orderByDesc('created_at')->paginate(20);
        }

        return view('fund.loans.index', compact('loans'));
    }

    public function create()
    {
        $tenant = TenantContext::get();
        $members = $tenant
            ? Member::where('tenant_id', $tenant->id)->where('status', 'active')->get()
            : collect();
        $accountSets = $tenant
            ? AccountSet::where('tenant_id', $tenant->id)->get()
            : collect();

        return view('fund.loans.create', compact('members', 'accountSets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer',
            'account_set_id' => 'required|integer',
            'principal' => 'required|numeric|min:1000',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'term_months' => 'required|integer|min:1|max:60',
            'guarantor_1_id' => 'nullable|integer',
            'guarantor_2_id' => 'nullable|integer',
        ], [
            'member_id.required' => 'กรุณาเลือกสมาชิกผู้กู้',
            'principal.required' => 'กรุณากรอกจำนวนเงินกู้',
            'principal.min' => 'จำนวนเงินกู้ต้องไม่น้อยกว่า 1,000 บาท',
            'interest_rate.required' => 'กรุณากรอกอัตราดอกเบี้ย',
            'term_months.required' => 'กรุณากรอกจำนวนงวด',
        ]);

        $tenant = TenantContext::get();
        if (! $tenant) {
            return back()->with('error', 'ไม่พบข้อมูลกองทุน');
        }

        $loan = $this->loanService->createLoan($validated);

        return redirect()->route('fund.loans.index')
            ->with('success', "สร้างสัญญาสินเชื่อ {$loan->loan_code} เรียบร้อยแล้ว");
    }

    public function show(int $id)
    {
        $loan = Loan::with(['member', 'schedules', 'payments', 'guarantor1', 'guarantor2', 'accountSet'])
            ->findOrFail($id);

        return view('fund.loans.show', compact('loan'));
    }
}
