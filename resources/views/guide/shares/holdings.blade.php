@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ดูยอดหุ้นที่สมาชิกแต่ละคนถือครอง พร้อมมูลค่ารวมและประวัติการซื้อขาย
    </p>

    <x-guide-step :number="1" title="เปิดเมนูหุ้น">
        <p>คลิกเมนู <strong>"หุ้น"</strong> ในแถบด้านข้าง</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ดูตารางถือครอง">
        <p>ระบบจะแสดงตารางรายชื่อสมาชิกทั้งหมด:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อสมาชิก:</strong> ชื่อ-นามสกุลของสมาชิก</li>
            <li><strong>จำนวนหุ้น:</strong> จำนวนหุ้นที่ถือครอง</li>
            <li><strong>มูลค่ารวม:</strong> มูลค่าหุ้นทั้งหมด (จำนวนหุ้น x ราคาหุ้นละ 10 บาท)</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="ดูประวัติ">
        <p>คลิกที่ชื่อสมาชิกเพื่อดูประวัติการซื้อ-ขายหุ้นทั้งหมด</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ใช้ตารางนี้ตรวจสอบยอดหุ้นรวมของกองทุน และยอดของสมาชิกแต่ละคนได้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
