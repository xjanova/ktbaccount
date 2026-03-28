<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotSetup
{
    /**
     * ถ้ายังไม่มี Super Admin ในระบบ → redirect ไป /setup
     * ยกเว้นหน้า /setup เอง, /api, /guide, assets
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ไม่ต้องเช็คสำหรับ routes เหล่านี้
        $excludedPaths = ['setup', 'api/', 'guide', 'demo', 'privacy-policy', 'build/', 'images/'];
        foreach ($excludedPaths as $path) {
            if ($request->is($path) || $request->is($path.'*')) {
                return $next($request);
            }
        }

        // ถ้ายังไม่มี Super Admin → redirect ไปหน้า setup
        if (! User::where('is_super_admin', true)->exists()) {
            return redirect('/setup');
        }

        return $next($request);
    }
}
