<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Fund\DashboardController as FundDashboardController;
use App\Http\Controllers\Fund\LineSettingsController;
use App\Http\Controllers\Fund\LoanController;
use App\Http\Controllers\Fund\MemberController;
use App\Http\Controllers\Fund\ReportController;
use App\Http\Controllers\Fund\SavingsController;
use App\Http\Controllers\Fund\ShareController;
use App\Http\Controllers\Fund\TransactionController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SetupController;
use App\Http\Middleware\AuthOrDemo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Initial Setup (เฉพาะครั้งแรก - ยังไม่มี Super Admin)
Route::get('/setup', [SetupController::class, 'index'])->name('setup');
Route::post('/setup', [SetupController::class, 'store']);

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Privacy Policy
Route::get('/privacy-policy', fn () => view('privacy-policy'))->name('privacy-policy');

// Knowledge Base / คู่มือการใช้งาน (public - ไม่ต้อง login)
Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');
Route::get('/guide/search', [GuideController::class, 'search'])->name('guide.search');
Route::get('/guide/{category}/{slug}', [GuideController::class, 'show'])->name('guide.show');

// Demo Village (public - ทุกคนเข้าดูได้เพื่อทดสอบระบบ ไม่ต้อง login)
Route::prefix('demo')->group(function () {
    Route::get('/', [DemoController::class, 'dashboard'])->name('demo.dashboard');
    Route::get('/transactions', [DemoController::class, 'transactions'])->name('demo.transactions.index');
    Route::get('/transactions/create', [DemoController::class, 'transactionsCreate'])->name('demo.transactions.create');
    Route::post('/transactions', fn () => back()->with('success', 'บันทึกสำเร็จ (โหมดทดลอง - ไม่ได้บันทึกจริง)'))->name('demo.transactions.store');
    Route::get('/loans', [DemoController::class, 'loans'])->name('demo.loans.index');
    Route::get('/deposits', [DemoController::class, 'deposits'])->name('demo.deposits.index');
    Route::get('/shares', [DemoController::class, 'shares'])->name('demo.shares.index');
    Route::get('/members', [DemoController::class, 'members'])->name('demo.members.index');
    Route::get('/reports', [DemoController::class, 'reports'])->name('demo.reports.index');
    Route::get('/approvals', [DemoController::class, 'approvals'])->name('demo.approvals.index');
    Route::get('/settings', [DemoController::class, 'settings'])->name('demo.settings');
    Route::get('/account-sets', [DemoController::class, 'accountSets'])->name('demo.account-sets.index');
});

// Super Admin
Route::prefix('admin')->middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/tenants', fn () => view('admin.tenants'))->name('admin.tenants');
    Route::get('/users', fn () => view('admin.users'))->name('admin.users');
    Route::get('/settings', fn () => view('admin.settings'))->name('admin.settings');

    // Impersonate - เข้าจัดการในนามกองทุน/ผู้ใช้
    Route::post('/impersonate/fund/{tenantId}', [ImpersonateController::class, 'enterFund'])->name('admin.impersonate.fund');
    Route::post('/impersonate/user/{userId}', [ImpersonateController::class, 'enterUser'])->name('admin.impersonate.user');
    Route::post('/impersonate/leave', [ImpersonateController::class, 'leaveFund'])->name('admin.impersonate.leave');
    Route::post('/impersonate/leave-user', [ImpersonateController::class, 'leaveUser'])->name('admin.impersonate.leave-user');
});

// Fund Management (tenant-scoped)
Route::prefix('fund')->middleware([AuthOrDemo::class, 'demo'])->group(function () {
    Route::get('/', [FundDashboardController::class, 'index'])->name('fund.dashboard');

    // Transactions (รายรับ-รายจ่าย) - real controller
    Route::get('/transactions', [TransactionController::class, 'index'])->name('fund.transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('fund.transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('fund.transactions.store');

    // Loans (สินเชื่อ) - real controller
    Route::get('/loans', [LoanController::class, 'index'])->name('fund.loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('fund.loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('fund.loans.store');
    Route::get('/loans/{id}', [LoanController::class, 'show'])->name('fund.loans.show');

    // Reports (รายงาน) - real controller
    Route::get('/reports', [ReportController::class, 'index'])->name('fund.reports.index');
    Route::get('/reports/trial-balance', [ReportController::class, 'trialBalance'])->name('fund.reports.trial-balance');
    Route::get('/reports/income-statement', [ReportController::class, 'incomeStatement'])->name('fund.reports.income-statement');
    Route::get('/reports/balance-sheet', [ReportController::class, 'balanceSheet'])->name('fund.reports.balance-sheet');

    // Deposits (เงินฝาก) - real controller
    Route::get('/deposits', [SavingsController::class, 'index'])->name('fund.deposits.index');
    Route::get('/deposits/create', [SavingsController::class, 'create'])->name('fund.deposits.create');
    Route::post('/deposits', [SavingsController::class, 'store'])->name('fund.deposits.store');
    Route::post('/deposits/{id}/deposit', [SavingsController::class, 'deposit'])->name('fund.deposits.deposit');
    Route::post('/deposits/{id}/withdraw', [SavingsController::class, 'withdraw'])->name('fund.deposits.withdraw');

    // Shares (หุ้น) - real controller
    Route::get('/shares', [ShareController::class, 'index'])->name('fund.shares.index');
    Route::post('/shares/buy', [ShareController::class, 'buy'])->name('fund.shares.buy');
    Route::post('/shares/sell', [ShareController::class, 'sell'])->name('fund.shares.sell');

    // Members (สมาชิก) - real controller
    Route::get('/members', [MemberController::class, 'index'])->name('fund.members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('fund.members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('fund.members.store');
    Route::get('/members/{id}', [MemberController::class, 'show'])->name('fund.members.show');
    Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('fund.members.edit');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('fund.members.update');

    // Approvals (อนุมัติ) - placeholder for now
    Route::get('/approvals', fn () => view('fund.transactions.index'))->name('fund.approvals.index');

    // Account Sets (ชุดบัญชี) - placeholder
    Route::get('/account-sets', fn () => view('fund.transactions.index'))->name('fund.account-sets.index');

    // Settings (ตั้งค่า)
    Route::get('/settings', function () {
        if (session('demo_mode')) {
            return view('fund.settings.line', [
                'config' => new stdClass,
                'webhookUrl' => 'https://ktbaccount.xman4289.com/api/line/webhook/demo',
                'tenant' => (object) ['code' => 'demo', 'name' => 'กองทุนตัวอย่าง'],
            ]);
        }

        return app(LineSettingsController::class)->index();
    })->name('fund.settings');
    Route::get('/settings/line', [LineSettingsController::class, 'index'])->name('fund.settings.line');
    Route::put('/settings/line', [LineSettingsController::class, 'update'])->name('fund.settings.line.update');
});
