@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกต้องการถอนเงินจากบัญชีเงินฝาก ผู้ดูแลระบบจะบันทึกการถอนเงินในระบบ
    </p>

    <x-guide-step :number="1" title="เลือกบัญชีเงินฝาก">
        <p>ไปที่เมนู <strong>"เงินฝาก"</strong> แล้วคลิกเลือกบัญชีของสมาชิกที่ต้องการถอนเงิน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกถอนเงิน">
        <p>คลิกปุ่ม <strong>"ถอนเงิน"</strong> ระบบจะแสดงแบบฟอร์มถอนเงิน พร้อมยอดเงินคงเหลือ</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกจำนวนเงิน">
        <p>ใส่จำนวนเงินที่ต้องการถอน</p>
        <p>จำนวนเงินที่ถอน <strong>ต้องไม่เกินยอดเงินคงเหลือ</strong> ในบัญชี</p>
    </x-guide-step>

    <x-guide-step :number="4" title="บันทึก">
        <p>ตรวจสอบจำนวนเงินให้ถูกต้อง แล้วคลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p>ระบบจะหักยอดเงินฝากและบันทึกบัญชีให้อัตโนมัติ</p>
    </x-guide-step>

    <x-guide-tip type="warning">
        ถ้ากรอกจำนวนเงินเกินยอดคงเหลือ <strong>ระบบจะแจ้งเตือนและไม่ให้บันทึก</strong>
        ต้องแก้ไขจำนวนเงินให้ไม่เกินยอดคงเหลือ
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
