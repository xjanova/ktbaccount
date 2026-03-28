@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดาวน์โหลดใบสำคัญรับหรือใบสำคัญจ่าย เป็นไฟล์ PDF เพื่อเก็บเป็นหลักฐานหรือพิมพ์ออกมา
    </p>

    <x-guide-step :number="1" title="เปิดรายการที่ต้องการ">
        <p>เข้าหน้า <strong>"รายรับ-รายจ่าย"</strong> แล้วคลิกที่รายการที่ต้องการดาวน์โหลดใบสำคัญ</p>
        <x-guide-screenshot src="images/guide/transactions/history-table.png" alt="เลือกรายการ" caption="คลิกเลือกรายการที่ต้องการดาวน์โหลดใบสำคัญ" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกไอคอน &quot;ดาวน์โหลด&quot;">
        <p>ในหน้ารายละเอียดของรายการ ให้คลิกที่ไอคอน <strong>"ดาวน์โหลด"</strong> (รูป PDF) เพื่อสร้างใบสำคัญ</p>
        <x-guide-screenshot src="images/guide/transactions/btn-download-receipt.png" alt="ปุ่มดาวน์โหลด" caption="คลิกไอคอนดาวน์โหลดเพื่อสร้างใบสำคัญ PDF" />
    </x-guide-step>

    <x-guide-step :number="3" title="ระบบสร้างใบสำคัญ PDF">
        <p>ระบบจะสร้างเอกสาร PDF ให้อัตโนมัติ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ถ้าเป็น <strong>รายรับ</strong> จะได้ <strong>"ใบสำคัญรับ"</strong></li>
            <li>ถ้าเป็น <strong>รายจ่าย</strong> จะได้ <strong>"ใบสำคัญจ่าย"</strong></li>
        </ul>
        <p>ใบสำคัญจะมีข้อมูลครบถ้วน ได้แก่ เลขที่เอกสาร วันที่ ประเภท จำนวนเงิน คำอธิบาย และชื่อผู้จ่าย/ผู้รับ</p>
        <x-guide-screenshot src="images/guide/transactions/receipt-example.png" alt="ตัวอย่างใบสำคัญรับ" caption="ตัวอย่างใบสำคัญรับที่ระบบสร้างให้" />
    </x-guide-step>

    <x-guide-step :number="4" title="เปิดหรือพิมพ์ใบสำคัญ">
        <p>ไฟล์ PDF จะถูกดาวน์โหลดลงเครื่องคอมพิวเตอร์ของท่าน สามารถ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เปิดดู</strong> - ดับเบิลคลิกที่ไฟล์เพื่อเปิดอ่าน</li>
            <li><strong>พิมพ์</strong> - กด Ctrl+P (หรือ Command+P บน Mac) เพื่อพิมพ์ออกกระดาษ</li>
            <li><strong>ส่งต่อ</strong> - ส่งไฟล์ PDF ทางอีเมลหรือ LINE ได้</li>
        </ul>
        <x-guide-tip type="tip">
            ควรเก็บใบสำคัญไว้เป็นหลักฐานทางการเงิน ทั้งในรูปแบบไฟล์และพิมพ์เก็บไว้ เผื่อต้องใช้ในการตรวจสอบบัญชี
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
