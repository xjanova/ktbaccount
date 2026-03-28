<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    /**
     * แสดงหน้าตั้งค่า Super Admin ครั้งแรก
     * จะใช้ได้เฉพาะเมื่อยังไม่มี Super Admin ในระบบ
     */
    public function index()
    {
        // ถ้ามี Super Admin แล้ว ไม่ให้เข้าหน้านี้
        if (User::where('is_super_admin', true)->exists()) {
            return redirect('/login')->with('info', 'ระบบตั้งค่าแล้ว กรุณาเข้าสู่ระบบ');
        }

        return view('setup.index');
    }

    /**
     * สร้าง Super Admin คนแรก
     */
    public function store(Request $request)
    {
        // ป้องกันเรียกซ้ำ
        if (User::where('is_super_admin', true)->exists()) {
            return redirect('/login')->with('info', 'ระบบตั้งค่าแล้ว');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'กรุณากรอกชื่อ-นามสกุล',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'is_super_admin' => true,
            'is_active' => true,
            'email_verified_at' => now(),
            'pdpa_consented_at' => now(),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'ตั้งค่า Super Admin เรียบร้อย! ยินดีต้อนรับสู่ระบบบริหารกองทุนหมู่บ้าน');
    }
}
