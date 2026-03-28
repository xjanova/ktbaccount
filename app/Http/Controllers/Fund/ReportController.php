<?php

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\AccountSet;
use App\Services\Accounting\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private ReportService $reportService) {}

    public function index()
    {
        $tenant = TenantContext::get();
        $accountSets = $tenant
            ? AccountSet::where('tenant_id', $tenant->id)->get()
            : collect();

        return view('fund.reports.index', compact('accountSets'));
    }

    public function trialBalance(Request $request)
    {
        $tenant = TenantContext::get();
        if (! $tenant) {
            return back()->with('error', 'ไม่พบข้อมูลกองทุน');
        }

        $data = $this->reportService->trialBalance(
            $request->account_set_id,
            $request->from_date,
            $request->to_date,
            $request->boolean('include_closing')
        );

        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('reports.trial-balance-pdf', compact('data', 'tenant'));

            return $pdf->download("งบทดลอง_{$request->from_date}_{$request->to_date}.pdf");
        }

        return view('fund.reports.trial-balance', compact('data', 'tenant'));
    }

    public function incomeStatement(Request $request)
    {
        $tenant = TenantContext::get();
        if (! $tenant) {
            return back()->with('error', 'ไม่พบข้อมูลกองทุน');
        }

        $data = $this->reportService->incomeStatement(
            $request->account_set_id,
            $request->from_date,
            $request->to_date
        );

        return view('fund.reports.income-statement', compact('data', 'tenant'));
    }

    public function balanceSheet(Request $request)
    {
        $tenant = TenantContext::get();
        if (! $tenant) {
            return back()->with('error', 'ไม่พบข้อมูลกองทุน');
        }

        $data = $this->reportService->balanceSheet(
            $request->account_set_id,
            $request->as_of_date,
            $request->boolean('include_closing')
        );

        return view('fund.reports.balance-sheet', compact('data', 'tenant'));
    }
}
