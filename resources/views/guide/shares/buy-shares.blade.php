@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกต้องการซื้อหุ้นกองทุนหมู่บ้าน ผู้ดูแลระบบจะบันทึกการซื้อหุ้นในระบบ
    </p>

    <x-guide-step :number="1" title="เปิดเมนูหุ้น">
        <p>คลิกเมนู <strong>"หุ้น"</strong> ในแถบด้านข้าง</p>
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกสมาชิก">
        <p>ค้นหาและเลือกสมาชิกที่ต้องการซื้อหุ้น</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกจำนวนหุ้น">
        <p>ใส่จำนวนหุ้นที่ต้องการซื้อ</p>
        <p>ราคาหุ้นละ <strong>10 บาท</strong> ระบบจะคำนวณยอดเงินรวมให้อัตโนมัติ</p>
        <p>เช่น ซื้อ 100 หุ้น = 1,000 บาท</p>
    </x-guide-step>

    <x-guide-step :number="4" title="บันทึก">
        <p>ตรวจสอบจำนวนหุ้นและยอดเงิน แล้วคลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p>ระบบจะเพิ่มจำนวนหุ้นให้สมาชิกและบันทึกบัญชีอัตโนมัติ</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ราคาหุ้นละ 10 บาท เป็นค่าเริ่มต้น สามารถปรับได้ในการตั้งค่ากองทุน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
