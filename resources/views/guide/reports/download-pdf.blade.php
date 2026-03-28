@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        รายงานทุกชนิดในระบบสามารถดาวน์โหลดเป็นไฟล์ PDF ได้ ไฟล์ PDF เหมาะสำหรับพิมพ์ส่งผู้ตรวจสอบ
        หรือเก็บเป็นหลักฐานบัญชี
    </p>

    <x-guide-step :number="1" title="เปิดรายงานที่ต้องการ">
        <p>ไปที่เมนู <strong>"รายงาน"</strong> แล้วเลือกรายงานที่ต้องการ เช่น งบทดลอง งบกำไรขาดทุน งบแสดงฐานะการเงิน หรือบัญชีแยกประเภท</p>
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกเงื่อนไขแล้วกดดูรายงาน">
        <p>เลือกชุดบัญชี วันที่ และเงื่อนไขอื่นๆ ตามรายงานนั้นๆ แล้วคลิก <strong>"ดูรายงาน"</strong></p>
        <p>ตรวจสอบว่ารายงานที่แสดงถูกต้องตามที่ต้องการ</p>
    </x-guide-step>

    <x-guide-step :number="3" title="คลิกดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> ที่มุมบนขวาของรายงาน</p>
        <p>ระบบจะสร้างไฟล์ PDF และดาวน์โหลดลงเครื่องคอมพิวเตอร์โดยอัตโนมัติ</p>
        <x-guide-screenshot src="images/guide/reports/download-pdf-button.png" alt="ปุ่มดาวน์โหลด PDF" caption="คลิกปุ่มดาวน์โหลด PDF ที่มุมบนขวา" />
    </x-guide-step>

    <x-guide-step :number="4" title="เปิดไฟล์ PDF">
        <p>เปิดไฟล์ PDF ที่ดาวน์โหลดมา ตรวจสอบความถูกต้อง</p>
        <p>สามารถ <strong>พิมพ์</strong> (Print) ได้จากโปรแกรมอ่าน PDF เลย</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ไฟล์ PDF เหมาะสำหรับส่งให้ผู้ตรวจสอบบัญชี เพราะเปิดดูได้ง่ายและแก้ไขไม่ได้
    </x-guide-tip>

    <x-guide-tip type="info">
        ถ้าต้องการดาวน์โหลดรายงานรวมทุกชุดบัญชี ให้เลือกชุดบัญชีเป็น <strong>"ทุกชุดบัญชี"</strong> ก่อนกดดูรายงานและดาวน์โหลด
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
