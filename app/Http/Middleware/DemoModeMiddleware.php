<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Demo Mode Middleware
 *
 * เมื่อ session มี demo_mode = true:
 * - Bypass auth (ไม่ต้อง login)
 * - POST/PUT/DELETE requests จะไม่ทำงานจริง แค่ flash success message
 * - ทุกหน้า fund ทำงานปกติ ใช้ demo data
 *
 * วิธีนี้ทำให้เพิ่มหน้าใหม่ใน fund อนาคต demo ก็ได้หมดอัตโนมัติ
 */
class DemoModeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจว่าอยู่ใน demo mode
        if (! session('demo_mode')) {
            return $next($request);
        }

        // Demo mode: POST/PUT/DELETE → ไม่ทำจริง แค่ flash message
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return back()->with('success', '✅ บันทึกสำเร็จ (โหมดทดลอง - ไม่ได้บันทึกจริง)');
        }

        return $next($request);
    }
}
