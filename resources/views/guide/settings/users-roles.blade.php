@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ผู้ดูแลระบบสามารถเพิ่มผู้ใช้งานและกำหนดสิทธิ์การใช้งานได้ แต่ละคนจะเห็นเมนูตามสิทธิ์ที่ได้รับ
    </p>

    <x-guide-step :number="1" title="เปิดหน้าจัดการผู้ใช้">
        <p>ไปที่ <strong>ตั้งค่า > ผู้ใช้งาน</strong></p>
        <p>ระบบจะแสดงรายชื่อผู้ใช้งานทั้งหมดในระบบ</p>
        <x-guide-screenshot src="images/guide/settings/users-list.png" alt="รายชื่อผู้ใช้งาน" caption="รายชื่อผู้ใช้งานทั้งหมดในระบบ" />
    </x-guide-step>

    <x-guide-step :number="2" title="เพิ่มผู้ใช้ใหม่">
        <p>คลิกปุ่ม <strong>"+ เพิ่มผู้ใช้"</strong> แล้วกรอกข้อมูล:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อ-นามสกุล:</strong> ชื่อจริงของผู้ใช้</li>
            <li><strong>อีเมล:</strong> อีเมลสำหรับเข้าสู่ระบบ</li>
            <li><strong>บทบาท (Role):</strong> เลือกสิทธิ์การใช้งาน</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="ทำความเข้าใจบทบาท (Role)">
        <p>แต่ละบทบาทมีสิทธิ์ต่างกัน:</p>
        <ul class="list-disc pl-5 space-y-3 mt-2">
            <li><strong>ผู้ดูแลระบบ (Admin):</strong> ทำได้ทุกอย่าง ตั้งค่าระบบ จัดการผู้ใช้ ดูรายงานทั้งหมด</li>
            <li><strong>เจ้าหน้าที่ (Staff):</strong> บันทึกรายการบัญชี รับชำระสินเชื่อ ฝาก-ถอนเงิน ดูรายงาน</li>
            <li><strong>คณะกรรมการ (Committee):</strong> อนุมัติสินเชื่อ ดูรายงาน แต่ไม่แก้ไขข้อมูล</li>
            <li><strong>ผู้ตรวจสอบ (Auditor):</strong> ดูรายงานและข้อมูลทั้งหมดได้ แต่แก้ไขอะไรไม่ได้</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="แก้ไขบทบาท">
        <p>คลิกที่ชื่อผู้ใช้แล้วเปลี่ยนบทบาทได้ หรือแก้ไขข้อมูลอื่นๆ</p>
    </x-guide-step>

    <x-guide-step :number="5" title="ลบผู้ใช้">
        <p>คลิกปุ่ม <strong>"ลบ"</strong> ที่ผู้ใช้ที่ต้องการลบ ระบบจะถามยืนยันก่อนลบ</p>
    </x-guide-step>

    <x-guide-tip type="warning">
        <strong>ระวังเรื่องสิทธิ์ Admin</strong> คนที่เป็น Admin ทำได้ทุกอย่าง รวมถึงลบข้อมูล
        ควรให้เฉพาะคนที่ไว้ใจได้เท่านั้น
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
