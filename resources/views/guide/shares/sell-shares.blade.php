@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกต้องการขายหรือถอนหุ้นคืน ผู้ดูแลระบบจะบันทึกในระบบ
    </p>

    <x-guide-step :number="1" title="เลือกสมาชิก">
        <p>ไปที่เมนู <strong>"หุ้น"</strong> แล้วเลือกสมาชิกที่ต้องการขายหุ้น</p>
        <p>ระบบจะแสดงจำนวนหุ้นที่สมาชิกถือครองอยู่</p>
    </x-guide-step>

    <x-guide-step :number="2" title="กรอกจำนวนหุ้นที่จะขาย">
        <p>ใส่จำนวนหุ้นที่ต้องการขาย จำนวนหุ้น <strong>ต้องไม่เกินจำนวนที่ถือครอง</strong></p>
    </x-guide-step>

    <x-guide-step :number="3" title="บันทึก">
        <p>ตรวจสอบจำนวนให้ถูกต้อง แล้วคลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p>ระบบจะหักจำนวนหุ้นและบันทึกบัญชีให้อัตโนมัติ</p>
    </x-guide-step>

    <x-guide-tip type="warning">
        ถ้ากรอกจำนวนเกินจำนวนหุ้นที่ถือครอง <strong>ระบบจะไม่ให้บันทึก</strong>
        ต้องแก้ไขจำนวนให้ไม่เกินที่มีอยู่
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
