<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
