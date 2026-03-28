@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกนำเงินมาฝาก ผู้ดูแลระบบจะบันทึกการฝากเงินในระบบ
        ยอดเงินฝากจะเพิ่มขึ้นอัตโนมัติ พร้อมบันทึกบัญชีและแจ้งเตือน LINE
    </p>

    <x-guide-step :number="1" title="เลือกบัญชีเงินฝาก">
        <p>ไปที่เมนู <strong>"เงินฝาก"</strong> แล้วคลิกเลือกบัญชีของสมาชิกที่ต้องการฝากเงิน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกฝากเงิน">
        <p>คลิกปุ่ม <strong>"ฝากเงิน"</strong> ระบบจะแสดงแบบฟอร์มฝากเงิน</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกข้อมูล">
        <p>กรอกข้อมูลการฝากเงิน:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>จำนวนเงิน:</strong> ใส่จำนวนเงินที่ต้องการฝาก</li>
            <li><strong>วันที่:</strong> วันที่ฝากเงิน (ระบบจะใส่วันนี้ให้อัตโนมัติ)</li>
            <li><strong>คำอธิบาย:</strong> ระบุรายละเอียดเพิ่มเติม (ถ้ามี)</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="บันทึก">
        <p>คลิกปุ่ม <strong>"บันทึก"</strong> ระบบจะทำทุกอย่างให้อัตโนมัติ:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>เพิ่มยอดเงินฝากในบัญชี</li>
            <li>บันทึกบัญชีอัตโนมัติ</li>
            <li>ส่งแจ้งเตือน LINE ให้สมาชิก</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="important">
        ระบบจะ <strong>บันทึกบัญชีให้อัตโนมัติ</strong> ไม่ต้องไปบันทึกรายการบัญชีเอง
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
