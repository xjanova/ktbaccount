<?php

use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\RedirectIfNotSetup;
use App\Http\Middleware\SetTenantMiddleware;
use App\Http\Middleware\VerifyPdpaConsentMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ถ้ายังไม่มี Super Admin → redirect ไปหน้า /setup
        $middleware->web(append: [
            RedirectIfNotSetup::class,
        ]);

        // Middleware aliases
        $middleware->alias([
            'tenant' => SetTenantMiddleware::class,
            'tenant.api' => SetTenantMiddleware::class,
            'role' => CheckRoleMiddleware::class,
            'pdpa' => VerifyPdpaConsentMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
