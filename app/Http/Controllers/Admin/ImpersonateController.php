<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    /**
     * เข้าใช้งานในนามกองทุน (Super Admin เท่านั้น)
     * สลับ session ไปเป็น fund_admin ของกองทุนที่เลือก
     */
    public function enterFund(Request $request, $tenantId)
    {
        $user = Auth::user();

        if (! $user || ! $user->is_super_admin) {
            abort(403, 'เฉพาะ Super Admin เท่านั้น');
        }

        $tenant = Tenant::findOrFail($tenantId);

        // เก็บ session ว่ากำลัง impersonate อยู่
        $request->session()->put('impersonating_tenant_id', $tenant->id);
        $request->session()->put('impersonating_tenant_name', $tenant->name);
        $request->session()->put('original_admin_id', $user->id);
        $request->session()->put('tenant_id', $tenant->id);

        return redirect()->route('fund.dashboard')
            ->with('success', "เข้าจัดการกองทุน: {$tenant->name}");
    }

    /**
     * ออกจากโหมด Impersonate กลับไปหน้า Admin
     */
    public function leaveFund(Request $request)
    {
        $request->session()->forget('impersonating_tenant_id');
        $request->session()->forget('impersonating_tenant_name');
        $request->session()->forget('tenant_id');

        return redirect()->route('admin.dashboard')
            ->with('success', 'กลับสู่หน้า Super Admin แล้ว');
    }

    /**
     * เข้าใช้งานในนามผู้ใช้คนอื่น (Super Admin เท่านั้น)
     */
    public function enterUser(Request $request, $userId)
    {
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->is_super_admin) {
            abort(403, 'เฉพาะ Super Admin เท่านั้น');
        }

        $targetUser = User::findOrFail($userId);

        // เก็บ original admin ID ก่อน login as
        $request->session()->put('impersonating_user_id', $targetUser->id);
        $request->session()->put('impersonating_user_name', $targetUser->name);
        $request->session()->put('original_admin_id', $currentUser->id);

        // Login เป็นผู้ใช้เป้าหมาย
        Auth::login($targetUser);

        // ตั้ง tenant ถ้ามี
        $firstTenant = $targetUser->tenants()->first();
        if ($firstTenant) {
            $request->session()->put('tenant_id', $firstTenant->id);
            $request->session()->put('impersonating_tenant_name', $firstTenant->name);
        }

        return redirect()->route('fund.dashboard')
            ->with('success', "เข้าใช้งานในนาม: {$targetUser->name}");
    }

    /**
     * ออกจากโหมด Impersonate User กลับเป็น Super Admin
     */
    public function leaveUser(Request $request)
    {
        $originalAdminId = $request->session()->get('original_admin_id');

        if ($originalAdminId) {
            $admin = User::find($originalAdminId);
            if ($admin && $admin->is_super_admin) {
                Auth::login($admin);
            }
        }

        $request->session()->forget('impersonating_user_id');
        $request->session()->forget('impersonating_user_name');
        $request->session()->forget('impersonating_tenant_id');
        $request->session()->forget('impersonating_tenant_name');
        $request->session()->forget('tenant_id');
        $request->session()->forget('original_admin_id');

        return redirect()->route('admin.dashboard')
            ->with('success', 'กลับสู่ Super Admin แล้ว');
    }
}
