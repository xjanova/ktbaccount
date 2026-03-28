@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดูประวัติรายการรายรับ-รายจ่ายทั้งหมดที่เคยบันทึกไว้ รวมถึงวิธีค้นหาและกรองรายการ
    </p>

    <x-guide-step :number="1" title="เข้าหน้ารายรับ-รายจ่าย">
        <p>คลิกที่เมนู <strong>"รายรับ-รายจ่าย"</strong> ในแถบด้านข้างซ้ายมือ ระบบจะแสดงรายการล่าสุดในตาราง</p>
        <x-guide-screenshot src="images/guide/transactions/menu-transaction.png" alt="เมนูรายรับ-รายจ่าย" caption="คลิกเมนู &quot;รายรับ-รายจ่าย&quot; ในแถบด้านข้าง" />
    </x-guide-step>

    <x-guide-step :number="2" title="ดูรายการล่าสุดในตาราง">
        <p>หน้ารายรับ-รายจ่ายจะแสดงรายการล่าสุดในตาราง แต่ละรายการจะแสดงข้อมูล:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>วันที่</strong> - วันที่บันทึกรายการ</li>
            <li><strong>ประเภท</strong> - รายรับหรือรายจ่าย</li>
            <li><strong>คำอธิบาย</strong> - รายละเอียดของรายการ</li>
            <li><strong>จำนวนเงิน</strong> - จำนวนเงินของรายการ</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/history-table.png" alt="ตารางรายการ" caption="ตารางแสดงรายการรายรับ-รายจ่ายล่าสุด" />
    </x-guide-step>

    <x-guide-step :number="3" title="คัดกรองรายการ">
        <p>ถ้าต้องการค้นหารายการเฉพาะ ใช้ตัวกรองด้านบนของตาราง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชุดบัญชี</strong> - เลือกชุดบัญชีที่ต้องการดู</li>
            <li><strong>ประเภท (รายรับ/รายจ่าย)</strong> - เลือกดูเฉพาะรายรับ หรือเฉพาะรายจ่าย หรือทั้งหมด</li>
            <li><strong>ช่วงวันที่</strong> - เลือกวันที่เริ่มต้นและวันที่สิ้นสุด เพื่อดูรายการเฉพาะช่วงเวลา</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/history-filters.png" alt="ตัวกรองรายการ" caption="ใช้ตัวกรองเพื่อค้นหารายการที่ต้องการ" />
        <x-guide-tip type="tip">
            การกรองตามช่วงวันที่มีประโยชน์มากเมื่อต้องการตรวจสอบรายการของเดือนใดเดือนหนึ่ง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="คลิก &quot;ดูทั้งหมด&quot;">
        <p>ถ้าต้องการดูรายการทั้งหมดโดยไม่จำกัดจำนวน ให้คลิกปุ่ม <strong>"ดูทั้งหมด"</strong> ที่ด้านล่างของตาราง</p>
    </x-guide-step>

    <x-guide-step :number="5" title="ดูรายละเอียดของรายการ">
        <p>คลิกที่รายการใดก็ได้ในตาราง เพื่อดูรายละเอียดทั้งหมดของรายการนั้น เช่น ประเภท คำอธิบาย ผู้จ่าย/ผู้รับ และข้อมูลบัญชี</p>
        <x-guide-screenshot src="images/guide/transactions/history-detail.png" alt="รายละเอียดรายการ" caption="คลิกรายการเพื่อดูรายละเอียดทั้งหมด" />
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
