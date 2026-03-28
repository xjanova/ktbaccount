@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ดูยอดเงินคงเหลือและประวัติการฝาก-ถอนของบัญชีเงินฝากแต่ละบัญชี
    </p>

    <x-guide-step :number="1" title="เปิดบัญชีเงินฝาก">
        <p>ไปที่เมนู <strong>"เงินฝาก"</strong> แล้วคลิกเลือกบัญชีที่ต้องการดู</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ดูยอดคงเหลือ">
        <p>ด้านบนจะแสดง <strong>ยอดเงินคงเหลือ</strong> ปัจจุบันของบัญชี</p>
    </x-guide-step>

    <x-guide-step :number="3" title="ดูตารางประวัติ">
        <p>ด้านล่างจะแสดงตารางประวัติการทำรายการ:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>วันที่:</strong> วันที่ทำรายการ</li>
            <li><strong>ประเภท:</strong> ฝากเงิน หรือ ถอนเงิน</li>
            <li><strong>จำนวนเงิน:</strong> จำนวนเงินที่ฝากหรือถอน</li>
            <li><strong>ยอดคงเหลือ:</strong> ยอดเงินหลังทำรายการ</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="tip">
        สามารถใช้ข้อมูลนี้ตรวจสอบความถูกต้องของยอดเงินฝากได้ทุกเมื่อ
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
