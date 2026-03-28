@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ระบบจะแจ้งเตือนอัตโนมัติเมื่อสมาชิกค้างชำระ ช่วยให้ติดตามหนี้ได้ง่ายและทันเวลา
    </p>

    <x-guide-step :number="1" title="ดู Dashboard แจ้งเตือน">
        <p>เมื่อเข้าระบบ หน้าแรกจะแสดง <strong>กล่องแจ้งเตือนสีแดง</strong> ถ้ามีสมาชิกค้างชำระ</p>
        <p>คลิกที่กล่องแจ้งเตือนเพื่อดูรายละเอียด</p>
    </x-guide-step>

    <x-guide-step :number="2" title="กรองรายการเลยกำหนด">
        <p>ที่หน้าสินเชื่อ เลือกกรอง <strong>"เลยกำหนด"</strong> จะแสดงเฉพาะสัญญาที่มีงวดค้างชำระ</p>
        <p>เรียงตามจำนวนวันที่เลยกำหนด จากมากไปน้อย</p>
    </x-guide-step>

    <x-guide-step :number="3" title="ระบบแจ้งเตือน LINE อัตโนมัติ">
        <p>ระบบจะส่ง LINE แจ้งเตือนสมาชิกอัตโนมัติตามกำหนด:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ก่อนครบกำหนด:</strong> 7 วัน, 3 วัน, 1 วัน, และวันครบกำหนด</li>
            <li><strong>หลังเลยกำหนด:</strong> 7 วัน, 14 วัน, และ 30 วัน</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="important">
        การแจ้งเตือน LINE จะทำงานอัตโนมัติ ไม่ต้องทำอะไรเพิ่ม
        แต่สมาชิกต้องเพิ่มเพื่อน LINE OA ของกองทุนก่อนจึงจะได้รับแจ้งเตือน
    </x-guide-tip>

    <x-guide-tip type="tip">
        ตรวจสอบรายการค้างชำระเป็นประจำ เพื่อติดตามและช่วยเหลือสมาชิกได้ทันเวลา
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
