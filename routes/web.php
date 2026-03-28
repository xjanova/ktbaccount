<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Super Admin Dashboard
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
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

    // Settings (ตั้งค่า)
    Route::get('/settings', fn () => view('fund.settings.line'))->name('fund.settings');
    Route::get('/settings/line', [LineSettingsController::class, 'index'])->name('fund.settings.line');
    Route::put('/settings/line', [LineSettingsController::class, 'update'])->name('fund.settings.line.update');
});
