<?php

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Share;
use App\Services\Fund\ShareService;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function __construct(private ShareService $shareService) {}

    public function index()
    {
        $shares = collect();
        $tenant = TenantContext::get();

        if ($tenant) {
            $shares = Share::where('tenant_id', $tenant->id)
                ->with('member')
                ->orderByDesc('total_value')
                ->paginate(20);
        }

        return view('fund.shares.index', compact('shares'));
    }

    public function buy(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer',
            'shares' => 'required|integer|min:1',
            'transaction_date' => 'nullable|date',
        ], [
            'member_id.required' => 'กรุณาเลือกสมาชิก',
            'shares.required' => 'กรุณากรอกจำนวนหุ้น',
            'shares.min' => 'จำนวนหุ้นต้องอย่างน้อย 1 หุ้น',
        ]);

        $member = Member::findOrFail($validated['member_id']);
        $this->shareService->buyShares($member, $validated['shares'], $validated);

        $amount = $validated['shares'] * config('ktbaccount.share.default_price', 10);

        return back()->with('success', "ซื้อหุ้น {$validated['shares']} หุ้น (฿".number_format($amount, 2).') เรียบร้อยแล้ว');
    }

    public function sell(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer',
            'shares' => 'required|integer|min:1',
            'transaction_date' => 'nullable|date',
        ]);

        $member = Member::findOrFail($validated['member_id']);

        try {
            $this->shareService->sellShares($member, $validated['shares'], $validated);

            return back()->with('success', "ขายหุ้น {$validated['shares']} หุ้น เรียบร้อยแล้ว");
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
