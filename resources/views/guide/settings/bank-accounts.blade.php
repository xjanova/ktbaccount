@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ตั้งค่าบัญชีธนาคารของกองทุน เพื่อใช้ในการบันทึกรายรับ-รายจ่ายที่ผ่านธนาคาร
        เพิ่มบัญชีธนาคารทุกบัญชีที่กองทุนใช้อยู่
    </p>

    <x-guide-step :number="1" title="เปิดหน้าตั้งค่าบัญชีธนาคาร">
        <p>ไปที่ <strong>ตั้งค่า > บัญชีธนาคาร</strong></p>
        <p>ระบบจะแสดงรายการบัญชีธนาคารทั้งหมดที่เพิ่มไว้แล้ว</p>
    </x-guide-step>

    <x-guide-step :number="2" title="เพิ่มบัญชีธนาคาร">
        <p>คลิกปุ่ม <strong>"+ เพิ่มบัญชี"</strong> แล้วกรอกข้อมูล:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อธนาคาร:</strong> เช่น ธนาคารกรุงไทย, ธนาคารออมสิน, ธ.ก.ส.</li>
            <li><strong>เลขที่บัญชี:</strong> เลขบัญชีธนาคาร</li>
            <li><strong>ชื่อบัญชี:</strong> ชื่อกองทุนที่เปิดบัญชี</li>
            <li><strong>สาขา:</strong> สาขาที่เปิดบัญชี</li>
        </ul>
        <x-guide-screenshot src="images/guide/settings/add-bank-account.png" alt="เพิ่มบัญชีธนาคาร" caption="กรอกข้อมูลบัญชีธนาคาร" />
    </x-guide-step>

    <x-guide-step :number="3" title="บันทึก">
        <p>ตรวจสอบข้อมูลให้ถูกต้อง แล้วคลิกปุ่ม <strong>"บันทึก"</strong></p>
    </x-guide-step>

    <x-guide-step :number="4" title="แก้ไขหรือลบ">
        <p>คลิกที่บัญชีธนาคารเพื่อแก้ไขข้อมูล หรือคลิกปุ่ม "ลบ" เพื่อลบออก</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        เพิ่มบัญชีธนาคาร <strong>ทุกบัญชี</strong> ที่กองทุนใช้ เพื่อจะได้เลือกได้ถูกต้องตอนบันทึกรายรับ-รายจ่าย
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
