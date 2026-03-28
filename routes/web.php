<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Fund\DashboardController as FundDashboardController;
use App\Http\Controllers\Fund\LineSettingsController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SetupController;
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

// Demo Village (public - ทุกคนเข้าดูได้เพื่อทดสอบระบบ)
Route::prefix('demo')->group(function () {
    Route::get('/', [DemoController::class, 'dashboard'])->name('demo.dashboard');
    Route::get('/loans', [DemoController::class, 'loans'])->name('demo.loans');
    Route::get('/members', [DemoController::class, 'members'])->name('demo.members');
    Route::get('/reports', [DemoController::class, 'reports'])->name('demo.reports');
});

// Super Admin
Route::prefix('admin')->middleware(['auth'])->group(function () {
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
Route::prefix('fund')->middleware(['auth'])->group(function () {
    Route::get('/', [FundDashboardController::class, 'index'])->name('fund.dashboard');

    // Transactions (รายรับ-รายจ่าย)
    Route::get('/transactions', fn () => view('fund.transactions.index'))->name('fund.transactions.index');
    Route::get('/transactions/create', fn () => view('fund.transactions.create'))->name('fund.transactions.create');
    Route::post('/transactions', fn () => back()->with('info', 'เร็วๆ นี้'))->name('fund.transactions.store');

    // Loans (สินเชื่อ)
    Route::get('/loans', fn () => view('fund.loans.index'))->name('fund.loans.index');

    // Reports (รายงาน)
    Route::get('/reports', fn () => view('fund.reports.index'))->name('fund.reports.index');

    // Deposits (เงินฝาก)
    Route::get('/deposits', fn () => view('fund.transactions.index'))->name('fund.deposits.index');

    // Shares (หุ้น)
    Route::get('/shares', fn () => view('fund.transactions.index'))->name('fund.shares.index');

    // Members (สมาชิก)
    Route::get('/members', fn () => view('fund.transactions.index'))->name('fund.members.index');

    // Approvals (อนุมัติ)
    Route::get('/approvals', fn () => view('fund.transactions.index'))->name('fund.approvals.index');

    // Account Sets (ชุดบัญชี)
    Route::get('/account-sets', fn () => view('fund.transactions.index'))->name('fund.account-sets.index');

    // Settings (ตั้งค่า)
    Route::get('/settings', fn () => view('fund.settings.line'))->name('fund.settings');
    Route::get('/settings/line', [LineSettingsController::class, 'index'])->name('fund.settings.line');
    Route::put('/settings/line', [LineSettingsController::class, 'update'])->name('fund.settings.line.update');
});
