<?php

use App\Http\Controllers\Api\LineWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Health Check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'version' => trim(file_get_contents(base_path('VERSION'))),
        'timestamp' => now()->toIso8601String(),
    ]);
});

// App Version Check (Flutter auto-update)
Route::get('/version/check', function () {
    $version = trim(file_get_contents(base_path('VERSION')));

    return response()->json([
        'version' => $version,
        'force_update' => false,
        'download_url' => 'https://github.com/xjanova/ktbaccount/releases/latest',
        'release_notes' => '',
    ]);
});

// LINE Webhook (per tenant - public, no auth)
Route::post('/line/webhook/{tenantCode}', [LineWebhookController::class, 'handle']);

// Auth API (public)
Route::post('/auth/login', function () {
    // TODO: implement
    return response()->json(['message' => 'Coming soon'], 501);
});

Route::post('/auth/register', function () {
    return response()->json(['message' => 'Coming soon'], 501);
});

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/auth/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'ออกจากระบบสำเร็จ']);
    });
});
