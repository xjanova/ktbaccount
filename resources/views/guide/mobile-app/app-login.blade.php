@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เข้าสู่ระบบบนแอปมือถือ ใช้อีเมลและรหัสผ่านเดียวกับเว็บ
    </p>

    <x-guide-step :number="1" title="เปิดแอป">
        <p>เปิดแอปกองทุนหมู่บ้าน จะเห็นหน้าจอต้อนรับ (splash screen) สักครู่</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/splash-screen.png" alt="หน้าจอต้อนรับ" caption="หน้าจอต้อนรับเมื่อเปิดแอป" />
    </x-guide-step>

    <x-guide-step :number="2" title="กรอกอีเมลและรหัสผ่าน">
        <p>กรอก <strong>อีเมล</strong> และ <strong>รหัสผ่าน</strong> เดียวกับที่ใช้เข้าเว็บ</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/login-screen.png" alt="หน้าเข้าสู่ระบบ" caption="กรอกอีเมลและรหัสผ่าน" />
    </x-guide-step>

    <x-guide-step :number="3" title="เข้าสู่ระบบ">
        <p>คลิกปุ่ม <strong>"เข้าสู่ระบบ"</strong></p>
    </x-guide-step>

    <x-guide-step :number="4" title="เลือกกองทุน">
        <p>ถ้าสมาชิกอยู่หลายกองทุน ให้เลือกกองทุนที่ต้องการดูข้อมูล</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ใช้อีเมลและรหัสผ่าน <strong>เดียวกับเว็บ</strong> ไม่ต้องสมัครใหม่
        ถ้าลืมรหัสผ่าน ให้ติดต่อผู้ดูแลระบบ
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
