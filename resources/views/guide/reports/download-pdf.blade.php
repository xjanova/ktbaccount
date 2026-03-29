@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        รายงานทุกชนิดในระบบสามารถดาวน์โหลดเป็นไฟล์ PDF ได้ ไฟล์ PDF เหมาะสำหรับพิมพ์ส่งผู้ตรวจสอบ
        หรือเก็บเป็นหลักฐานบัญชี ไฟล์ที่ได้จะมีรูปแบบเรียบร้อยพร้อมส่ง
    </p>

    <x-guide-step :number="1" title="รายงานที่ดาวน์โหลดได้">
        <p>รายงานที่สามารถดาวน์โหลดเป็น PDF ได้มีดังนี้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>งบทดลอง</strong> — ตรวจสอบยอดเดบิต/เครดิต</li>
            <li><strong>งบกำไรขาดทุน</strong> — ผลการดำเนินงาน (รายได้ - ค่าใช้จ่าย)</li>
            <li><strong>งบแสดงฐานะการเงิน (งบดุล)</strong> — ทรัพย์สิน หนี้สิน ทุน</li>
            <li><strong>บัญชีแยกประเภท</strong> — รายการเคลื่อนไหวของแต่ละบัญชี</li>
            <li><strong>ใบสำคัญรับ/จ่าย</strong> — เอกสารประกอบรายการรับ-จ่ายเงิน</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="2" title="เปิดรายงานที่ต้องการ">
        <p>ไปที่เมนู <strong>"รายงาน"</strong> แล้วเลือกรายงานที่ต้องการ</p>
        <p>เลือกชุดบัญชี วันที่ และเงื่อนไขอื่นๆ ตามรายงานนั้นๆ แล้วคลิก <strong>"ดูรายงาน"</strong></p>
        <x-guide-tip type="tip">
            ดูรายงานบนหน้าจอก่อนเสมอ เพื่อตรวจสอบว่าข้อมูลถูกต้อง ก่อนดาวน์โหลดเป็น PDF
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="3" title="คลิกดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> ที่มุมบนขวาของรายงาน (ปุ่มสีม่วง)</p>
        <p>ระบบจะสร้างไฟล์ PDF และดาวน์โหลดลงเครื่องคอมพิวเตอร์โดยอัตโนมัติ</p>
        <x-guide-screenshot src="images/guide/reports/download-pdf-button.png" alt="ปุ่มดาวน์โหลด PDF" caption="คลิกปุ่มดาวน์โหลด PDF ที่มุมบนขวา" />
    </x-guide-step>

    <x-guide-step :number="4" title="ข้อมูลในไฟล์ PDF">
        <p>ไฟล์ PDF ที่ได้จะมีข้อมูลครบถ้วนประกอบด้วย:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>หัวกระดาษ:</strong> ชื่อกองทุน + ชื่อรายงาน</li>
            <li><strong>ชุดบัญชี:</strong> ระบุว่าเป็นชุดบัญชีใด</li>
            <li><strong>ช่วงวันที่:</strong> ระบุช่วงเวลาที่ดูรายงาน</li>
            <li><strong>ตารางข้อมูล:</strong> ข้อมูลรายงานทั้งหมด</li>
            <li><strong>วันที่พิมพ์:</strong> วันที่สร้างเอกสาร PDF</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="5" title="เปิดและพิมพ์ไฟล์ PDF">
        <p>เปิดไฟล์ PDF ที่ดาวน์โหลดมา มีหลายวิธีใช้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ดูบนหน้าจอ:</strong> ดับเบิลคลิกที่ไฟล์เพื่อเปิดอ่าน</li>
            <li><strong>พิมพ์:</strong> กด <strong>Ctrl+P</strong> (หรือ <strong>Command+P</strong> บน Mac) เพื่อพิมพ์ออกกระดาษ</li>
            <li><strong>ส่งทางอีเมล:</strong> แนบไฟล์ PDF ในอีเมลส่งให้ผู้ตรวจสอบ</li>
            <li><strong>ส่งทาง LINE:</strong> ส่งไฟล์ PDF ในแชท LINE ได้เลย</li>
            <li><strong>เก็บเข้าแฟ้ม:</strong> บันทึกไว้ในคอมพิวเตอร์หรือ Google Drive เพื่อเก็บเป็นหลักฐาน</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="ดาวน์โหลดรายงานรวม">
        <p>ถ้าต้องการรายงานที่รวมทุกชุดบัญชี:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>เลือกชุดบัญชีเป็น <strong>"ทุกชุดบัญชี"</strong></li>
            <li>เลือกช่วงวันที่ที่ต้องการ</li>
            <li>กดดูรายงาน แล้วกดดาวน์โหลด PDF</li>
        </ol>
    </x-guide-step>

    <x-guide-tip type="tip">
        ไฟล์ PDF เหมาะสำหรับส่งให้ผู้ตรวจสอบบัญชี เพราะเปิดดูได้ง่ายและแก้ไขไม่ได้
        แนะนำให้ดาวน์โหลดรายงานสิ้นปีเก็บไว้ทุกปี เผื่อต้องย้อนดูภายหลัง
    </x-guide-tip>

    <x-guide-tip type="info">
        ถ้าไฟล์ PDF ไม่ดาวน์โหลด ให้ตรวจสอบว่าเบราว์เซอร์ไม่ได้บล็อกการดาวน์โหลด
        ลองคลิกที่แถบดาวน์โหลดด้านล่างของหน้าจอ หรือดูในโฟลเดอร์ "Downloads"
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
