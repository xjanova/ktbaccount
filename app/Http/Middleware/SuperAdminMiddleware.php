<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * เฉพาะ Super Admin เท่านั้นที่เข้าถึงได้
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->is_super_admin) {
            abort(403, 'เฉพาะ Super Admin เท่านั้น');
        }

        return $next($request);
    }
}
