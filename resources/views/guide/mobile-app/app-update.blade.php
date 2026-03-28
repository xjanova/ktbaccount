@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อมีเวอร์ชันใหม่ของแอป ระบบจะแจ้งเตือนให้อัพเดทอัตโนมัติเมื่อเปิดแอป
        ควรอัพเดทเสมอเพื่อให้ได้ฟีเจอร์ใหม่และแก้ไขข้อผิดพลาด
    </p>

    <x-guide-step :number="1" title="ระบบแจ้งเตือนอัตโนมัติ">
        <p>เมื่อเปิดแอป ถ้ามีเวอร์ชันใหม่ ระบบจะแสดง <strong>กล่องแจ้งเตือน</strong> ว่ามีอัพเดทใหม่</p>
        <x-guide-screenshot caption="กล่องแจ้งเตือนว่ามีเวอร์ชันใหม่" type="app" />
    </x-guide-step>

    <x-guide-step :number="2" title="กดอัพเดท">
        <p>กดปุ่ม <strong>"อัพเดท"</strong> ในกล่องแจ้งเตือน</p>
        <p>ระบบจะดาวน์โหลดไฟล์เวอร์ชันใหม่อัตโนมัติ</p>
    </x-guide-step>

    <x-guide-step :number="3" title="ติดตั้งเวอร์ชันใหม่">
        <p>เมื่อดาวน์โหลดเสร็จ จะแสดงหน้าจอติดตั้ง ให้กด <strong>"ติดตั้ง"</strong></p>
        <p>รอสักครู่จนติดตั้งเสร็จ แล้วเปิดแอปใหม่</p>
        <x-guide-screenshot caption="กดติดตั้งเวอร์ชันใหม่" type="app" />
    </x-guide-step>

    <x-guide-step :number="4" title="ตรวจสอบเวอร์ชัน">
        <p>ถ้าต้องการตรวจสอบว่าใช้เวอร์ชันอะไรอยู่:</p>
        <p>กดแท็บ <strong>"เพิ่มเติม"</strong> แล้วเลือก <strong>"เกี่ยวกับ"</strong> จะแสดงเลขเวอร์ชันปัจจุบัน</p>
        <x-guide-screenshot caption="ดูเวอร์ชันแอปในเมนู เพิ่มเติม > เกี่ยวกับ" type="app" />
    </x-guide-step>

    <x-guide-tip type="tip">
        ควรอัพเดทแอปทุกครั้งที่มีแจ้งเตือน เพื่อให้ใช้งานได้ราบรื่นและปลอดภัย
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
