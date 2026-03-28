@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        บัญชีแยกประเภท คือรายงานที่แสดง <strong>ความเคลื่อนไหว</strong> ของแต่ละบัญชี ว่ามีเงินเข้า-ออกเท่าไหร่
        ในช่วงเวลาที่กำหนด ใช้สำหรับตรวจสอบรายละเอียดว่าในแต่ละบัญชีมีรายการอะไรบ้าง
    </p>

    <x-guide-tip type="info">
        พูดง่ายๆ คือ "สมุดบันทึกรายการของแต่ละบัญชี" เหมือนสมุดบัญชีธนาคารที่แสดงรายการฝาก-ถอนทุกรายการ
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้ารายงาน">
        <p>คลิกเมนู <strong>"รายงาน"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"บัญชีแยกประเภท"</strong></p>
        <x-guide-screenshot src="images/guide/reports/general-ledger-menu.png" alt="เมนูบัญชีแยกประเภท" caption="เลือกเมนูบัญชีแยกประเภท" />
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกชุดบัญชี">
        <p>เลือกชุดบัญชีที่ต้องการดู เช่น "บัญชีเงินล้าน" หรือ "บัญชีเงินออมทรัพย์"</p>
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกช่วงรหัสบัญชี">
        <p>เลือก <strong>"รหัสบัญชีเริ่มต้น"</strong> และ <strong>"รหัสบัญชีสิ้นสุด"</strong></p>
        <p>ตัวอย่าง: ต้องการดูเฉพาะบัญชีทรัพย์สิน → เลือกรหัส 1000 ถึง 1999</p>
        <p>หรือถ้าต้องการดูทั้งหมด ก็ปล่อยค่าเริ่มต้นได้เลย</p>
    </x-guide-step>

    <x-guide-step :number="4" title="กำหนดช่วงวันที่">
        <p>เลือก <strong>"จากวันที่"</strong> และ <strong>"ถึงวันที่"</strong> ที่ต้องการดูรายการ</p>
        <p>ตัวอย่าง: ดูรายการทั้งเดือนมกราคม → จากวันที่ 1 ม.ค. ถึง 31 ม.ค.</p>
    </x-guide-step>

    <x-guide-step :number="5" title="กดดูรายงาน">
        <p>คลิกปุ่ม <strong>"ดูรายงาน"</strong> ระบบจะแสดงรายการเคลื่อนไหวของแต่ละบัญชี</p>
        <p>แต่ละบัญชีจะแสดง: ยอดยกมา → รายการเดบิต/เครดิต → ยอดคงเหลือ</p>
        <x-guide-screenshot src="images/guide/reports/general-ledger-report.png" alt="ตัวอย่างบัญชีแยกประเภท" caption="ตัวอย่างบัญชีแยกประเภท แสดงรายการเคลื่อนไหวของแต่ละบัญชี" />
    </x-guide-step>

    <x-guide-step :number="6" title="ดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> เพื่อบันทึกรายงานเป็นไฟล์ PDF</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        บัญชีแยกประเภทเหมาะสำหรับตรวจสอบรายการในบัญชีใดบัญชีหนึ่ง เช่น ต้องการดูว่าบัญชี "ดอกเบี้ยรับ" มีรายการอะไรบ้างในเดือนนี้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
