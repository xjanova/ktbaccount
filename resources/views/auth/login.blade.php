@extends('layouts.guest')

@section('content')
    <h2 class="text-xl font-bold text-white text-center mb-6">เข้าสู่ระบบ</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <x-form.input
            name="email"
            label="อีเมล"
            type="email"
            :required="true"
            placeholder="example@email.com"
            tooltip="กรอกอีเมลที่ใช้ลงทะเบียน"
        />

        {{-- Password --}}
        <x-form.input
            name="password"
            label="รหัสผ่าน"
            type="password"
            :required="true"
            placeholder="กรอกรหัสผ่าน"
        />

        {{-- Remember me --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-gray-800 border-gray-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-0">
                <span class="text-sm text-gray-400">จดจำฉัน</span>
            </label>
            <a href="#" class="text-sm text-primary-400 hover:text-primary-300 transition-colors">ลืมรหัสผ่าน?</a>
        </div>

        {{-- Submit --}}
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25 hover:shadow-primary-500/40" title="เข้าสู่ระบบ">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            เข้าสู่ระบบ
        </button>
    </form>

    {{-- Divider --}}
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-700"></div></div>
        <div class="relative flex justify-center text-xs"><span class="bg-gray-900 px-3 text-gray-500">หรือ</span></div>
    </div>

    {{-- LINE Login --}}
    <button type="button" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-[#06C755] hover:bg-[#05b04d] text-white font-semibold rounded-xl transition-all duration-300" title="เข้าสู่ระบบด้วย LINE">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314" />
        </svg>
        เข้าสู่ระบบด้วย LINE
    </button>

    {{-- Register link --}}
    <p class="text-center text-sm text-gray-400 mt-6">
        ยังไม่มีบัญชี?
        <a href="{{ route('register') }}" class="text-primary-400 hover:text-primary-300 font-medium transition-colors">ลงทะเบียนกองทุนใหม่</a>
    </p>
@endsection
