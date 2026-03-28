<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\ChartOfAccountsSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show registration form for a new village fund.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Process fund registration.
     *
     * Creates the user (fund admin), tenant (village fund),
     * tenant_user pivot, and PDPA consent record in a single transaction.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = DB::transaction(function () use ($request) {
            // Create the user (fund admin)
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone' => $request->input('phone'),
                'pdpa_consented_at' => now(),
            ]);

            // Create the tenant (village fund)
            $tenant = Tenant::create([
                'name' => $request->input('fund_name'),
                'code' => $request->input('fund_code'),
                'address' => $request->input('fund_address'),
                'province' => $request->input('fund_province'),
                'district' => $request->input('fund_district'),
            ]);

            // Create tenant_user pivot with fund_admin role
            $tenant->users()->attach($user->id, [
                'role' => 'fund_admin',
                'is_primary' => true,
                'joined_at' => now(),
            ]);

            // Seed default chart of accounts for this tenant
            $seeder = new ChartOfAccountsSeeder;
            $seeder->seedForTenant($tenant);

            return $user;
        });

        // Login the newly registered user
        Auth::login($user);

        // Set the tenant context in the session
        $tenant = $user->tenants()->first();
        if ($tenant) {
            session()->put('tenant_id', $tenant->id);
        }

        return redirect()->route('fund.dashboard')
            ->with('success', 'ลงทะเบียนกองทุนสำเร็จ ยินดีต้อนรับ!');
    }
}
