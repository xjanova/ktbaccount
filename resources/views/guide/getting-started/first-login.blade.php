@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีเข้าสู่ระบบ KTB Account เป็นครั้งแรก
        หลังจากที่ท่านลงทะเบียนกองทุนเรียบร้อยแล้ว สามารถเข้าสู่ระบบได้ทันที
    </p>

    <x-guide-step :number="1" title="เปิดเว็บไซต์">
        <p>เปิดเว็บเบราว์เซอร์ แล้วพิมพ์ที่อยู่เว็บไซต์:</p>
        <p class="font-semibold text-white text-lg my-4">https://ktbaccount.xman4289.com</p>
    </x-guide-step>

    <x-guide-step :number="2" title="คลิก &quot;เข้าสู่ระบบ&quot;">
        <p>ที่หน้าแรกของเว็บไซต์ ให้คลิกปุ่ม <strong>"เข้าสู่ระบบ"</strong> ที่มุมขวาบนของหน้าจอ</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกอีเมลและรหัสผ่าน">
        <p>กรอกข้อมูลเข้าสู่ระบบ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>อีเมล</strong> - อีเมลที่ใช้ตอนลงทะเบียน</li>
            <li><strong>รหัสผ่าน</strong> - รหัสผ่านที่ตั้งไว้ตอนลงทะเบียน</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/login-form.png" alt="หน้าเข้าสู่ระบบ" caption="กรอกอีเมลและรหัสผ่านที่ใช้ตอนลงทะเบียน" />
        <x-guide-tip type="tip">
            ติ๊กเครื่องหมายถูกที่ช่อง "จดจำฉัน" เพื่อให้ระบบจำข้อมูลไว้
            จะได้ไม่ต้องกรอกอีเมลใหม่ทุกครั้งที่เข้าสู่ระบบ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กดปุ่ม &quot;เข้าสู่ระบบ&quot;">
        <p>เมื่อกรอกข้อมูลเรียบร้อยแล้ว ให้กดปุ่ม <strong>"เข้าสู่ระบบ"</strong> (ปุ่มสีม่วง)
        เพื่อเข้าสู่ระบบ</p>
    </x-guide-step>

    <x-guide-step :number="5" title="เข้าสู่หน้าหลัก (Dashboard)">
        <p>เมื่อเข้าสู่ระบบสำเร็จ ระบบจะพาท่านเข้าสู่หน้าหลัก (Dashboard) ของกองทุน
        ซึ่งจะแสดงข้อมูลสรุปต่างๆ ของกองทุน</p>
        <x-guide-screenshot src="images/guide/getting-started/dashboard-after-login.png" alt="หน้าหลักหลังเข้าสู่ระบบ" caption="หน้าหลักของระบบ แสดงข้อมูลสรุปกองทุน" />
        <x-guide-tip type="info">
            หากลืมรหัสผ่าน สามารถกดลิงก์ "ลืมรหัสผ่าน" ที่หน้าเข้าสู่ระบบได้
            ระบบจะส่งลิงก์ตั้งรหัสผ่านใหม่ไปที่อีเมลของท่าน
        </x-guide-tip>
        <x-guide-tip type="tip">
            กองทุนที่เปิดใช้งาน LINE สามารถเข้าสู่ระบบด้วย LINE ได้เลย
            โดยกดปุ่ม "เข้าสู่ระบบด้วย LINE" ที่หน้าเข้าสู่ระบบ
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
