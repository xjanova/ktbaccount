@extends('layouts.admin')

@section('page-title', 'ตั้งค่าระบบ')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-white">ตั้งค่าระบบ</h2>
        <p class="text-sm text-gray-400 mt-1">ตั้งค่าทั่วไปของระบบบริหารกองทุนหมู่บ้าน</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        {{-- System Info --}}
        <div class="bg-white/[0.03] backdrop-blur border border-white/10 rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">ข้อมูลระบบ</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">ชื่อระบบ</span>
                    <span class="text-white font-medium">KTB Account</span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">เวอร์ชัน</span>
                    <span class="text-indigo-400 font-mono">v{{ $appVersion }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">PHP</span>
                    <span class="text-white">{{ phpversion() }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">Laravel</span>
                    <span class="text-white">{{ app()->version() }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">สภาพแวดล้อม</span>
                    <span class="text-white">{{ app()->environment() }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">โดเมน</span>
                    <span class="text-white">{{ config('app.url') }}</span>
                </div>
            </div>
        </div>

        {{-- License --}}
        <div class="bg-white/[0.03] backdrop-blur border border-white/10 rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">ใบอนุญาต</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">ผู้พัฒนา</span>
                    <span class="text-white font-medium">XMAN Studio</span>
                </div>
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">เว็บไซต์</span>
                    <a href="https://xman4289.com" target="_blank" class="text-indigo-400 hover:underline">xman4289.com</a>
                </div>
                <div class="flex justify-between py-2 border-b border-white/5">
                    <span class="text-gray-400">สัญญา</span>
                    <span class="text-emerald-400">ฟรีตลอดชีพ</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">อีเมลสนับสนุน</span>
                    <a href="mailto:support@xman4289.com" class="text-indigo-400 hover:underline">support@xman4289.com</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
