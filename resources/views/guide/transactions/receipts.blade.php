@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดาวน์โหลดใบสำคัญรับหรือใบสำคัญจ่าย เป็นไฟล์ PDF เพื่อเก็บเป็นหลักฐานหรือพิมพ์ออกมา
        ใบสำคัญเป็นเอกสารสำคัญที่กองทุนต้องเก็บไว้ตาม พ.ร.บ. กองทุนหมู่บ้าน
    </p>

    <x-guide-tip type="info">
        <strong>ใบสำคัญรับ</strong> = เอกสารยืนยันว่ากองทุนได้รับเงิน (เช่น รับชำระค่าหุ้น รับชำระสินเชื่อ)<br>
        <strong>ใบสำคัญจ่าย</strong> = เอกสารยืนยันว่ากองทุนจ่ายเงินออกไป (เช่น จ่ายค่าตอบแทน ค่าเช่า)
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดรายการที่ต้องการ">
        <p>เข้าหน้า <strong>"รายรับ-รายจ่าย"</strong> แล้วคลิกที่รายการที่ต้องการดาวน์โหลดใบสำคัญ</p>
        <x-guide-screenshot src="images/guide/transactions/history-table.png" alt="เลือกรายการ" caption="คลิกเลือกรายการที่ต้องการดาวน์โหลดใบสำคัญ" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกไอคอน &quot;ดาวน์โหลด&quot;">
        <p>ในหน้ารายละเอียดของรายการ ให้คลิกที่ปุ่ม <strong>"ดาวน์โหลดใบสำคัญ"</strong> (ไอคอนรูป PDF) เพื่อสร้างใบสำคัญ</p>
        <x-guide-screenshot src="images/guide/transactions/btn-download-receipt.png" alt="ปุ่มดาวน์โหลด" caption="คลิกไอคอนดาวน์โหลดเพื่อสร้างใบสำคัญ PDF" />
    </x-guide-step>

    <x-guide-step :number="3" title="ระบบสร้างใบสำคัญ PDF">
        <p>ระบบจะสร้างเอกสาร PDF ให้อัตโนมัติ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ถ้าเป็น <strong>รายรับ</strong> จะได้ <strong>"ใบสำคัญรับ"</strong></li>
            <li>ถ้าเป็น <strong>รายจ่าย</strong> จะได้ <strong>"ใบสำคัญจ่าย"</strong></li>
        </ul>

        <p class="mt-4"><strong>ข้อมูลที่แสดงในใบสำคัญ:</strong></p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อกองทุนหมู่บ้าน</strong> - แสดงด้านบนของเอกสาร</li>
            <li><strong>เลขที่เอกสาร</strong> - เลขที่อ้างอิงสำหรับตรวจสอบ</li>
            <li><strong>วันที่</strong> - วันที่เกิดรายการ</li>
            <li><strong>ประเภทรายรับ/รายจ่าย</strong> - หมวดหมู่ของรายการ</li>
            <li><strong>จำนวนเงิน</strong> - ทั้งตัวเลขและตัวอักษร</li>
            <li><strong>คำอธิบาย</strong> - รายละเอียดของรายการ</li>
            <li><strong>ผู้จ่าย/ผู้รับเงิน</strong> - ชื่อบุคคลที่เกี่ยวข้อง</li>
            <li><strong>ลงบัญชี</strong> - เงินสดหรือเงินฝากธนาคาร</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/receipt-example.png" alt="ตัวอย่างใบสำคัญรับ" caption="ตัวอย่างใบสำคัญรับที่ระบบสร้างให้" />
    </x-guide-step>

    <x-guide-step :number="4" title="เปิดหรือพิมพ์ใบสำคัญ">
        <p>ไฟล์ PDF จะถูกดาวน์โหลดลงเครื่องคอมพิวเตอร์ของท่าน สามารถ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เปิดดู</strong> - ดับเบิลคลิกที่ไฟล์เพื่อเปิดอ่าน</li>
            <li><strong>พิมพ์</strong> - กด Ctrl+P (หรือ Command+P บน Mac) เพื่อพิมพ์ออกกระดาษ</li>
            <li><strong>ส่งต่อ</strong> - ส่งไฟล์ PDF ทางอีเมลหรือ LINE ได้</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="5" title="เก็บรักษาใบสำคัญ">
        <p>ตาม พ.ร.บ. กองทุนหมู่บ้าน กองทุนต้องเก็บหลักฐานทางการเงินไว้อย่างน้อย 5 ปี แนะนำให้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>พิมพ์เก็บในแฟ้ม:</strong> จัดเรียงตามวันที่และเลขที่เอกสาร</li>
            <li><strong>เก็บไฟล์ดิจิทัล:</strong> สร้างโฟลเดอร์แยกตามเดือนในคอมพิวเตอร์หรือ Google Drive</li>
            <li><strong>สำรองข้อมูล:</strong> เก็บสำเนาไว้มากกว่า 1 ที่ เผื่อข้อมูลสูญหาย</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="tip">
        ควรเก็บใบสำคัญไว้เป็นหลักฐานทางการเงิน ทั้งในรูปแบบไฟล์และพิมพ์เก็บไว้ เผื่อต้องใช้ในการตรวจสอบบัญชี
        จัดเรียงเอกสารตามลำดับวันที่จะช่วยให้ค้นหาได้ง่ายเมื่อต้องการ
    </x-guide-tip>

    <x-guide-tip type="warning">
        ใบสำคัญที่ดาวน์โหลดจะแสดงข้อมูล ณ เวลาที่ดาวน์โหลด ถ้ามีการแก้ไขรายการภายหลัง
        ต้องดาวน์โหลดใบสำคัญใหม่อีกครั้ง
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
