<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Auth หรือ Demo Mode
 *
 * ถ้า demo_mode = true → ผ่านได้เลยไม่ต้อง login
 * ถ้าไม่ใช่ demo → ต้อง login (เหมือน auth middleware)
 *
 * ทำให้ fund routes ใช้ได้ทั้ง auth user + demo mode
 * เพิ่มหน้าใหม่ใน fund อนาคต → demo ได้หมดอัตโนมัติ
 */
class AuthOrDemo
{
    public function handle(Request $request, Closure $next): Response
    {
        // Demo mode → bypass auth
        if (session('demo_mode')) {
            return $next($request);
        }

        // ไม่ใช่ demo → ต้อง login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
