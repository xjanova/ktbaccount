@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ตั้งค่าบัญชีธนาคารของกองทุน เพื่อใช้ในการบันทึกรายรับ-รายจ่ายที่ผ่านธนาคาร
        เพิ่มบัญชีธนาคารทุกบัญชีที่กองทุนใช้อยู่ เพื่อจะได้เลือกได้ถูกต้องตอนบันทึกรายการ
    </p>

    <x-guide-step :number="1" title="ทำไมต้องเพิ่มบัญชีธนาคาร?">
        <p>เมื่อบันทึกรายรับ-รายจ่ายที่ <strong>โอนผ่านธนาคาร</strong> ระบบจำเป็นต้องรู้ว่าเงินเข้า-ออกบัญชีไหน เพื่อ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>บันทึกบัญชีถูกต้อง:</strong> ระบบจะลงบัญชี "เงินฝากธนาคาร" ตามบัญชีที่เลือก</li>
            <li><strong>ตรวจสอบยอดได้:</strong> เทียบยอดเงินในระบบกับยอดจริงที่ธนาคาร</li>
            <li><strong>รายงานครบถ้วน:</strong> งบแสดงฐานะการเงินจะแสดงยอดเงินฝากแต่ละธนาคาร</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="2" title="เปิดหน้าตั้งค่าบัญชีธนาคาร">
        <p>ไปที่ <strong>ตั้งค่า > บัญชีธนาคาร</strong></p>
        <p>ระบบจะแสดงรายการบัญชีธนาคารทั้งหมดที่เพิ่มไว้แล้ว</p>
        <x-guide-screenshot src="images/guide/settings/bank-accounts-list.png" alt="รายการบัญชีธนาคาร" caption="รายการบัญชีธนาคารทั้งหมดที่เพิ่มไว้" />
    </x-guide-step>

    <x-guide-step :number="3" title="เพิ่มบัญชีธนาคาร">
        <p>คลิกปุ่ม <strong>"+ เพิ่มบัญชี"</strong> แล้วกรอกข้อมูล:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อธนาคาร:</strong> เลือกจากรายการ เช่น:
                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                    <li>ธนาคารกรุงไทย (KTB)</li>
                    <li>ธนาคารออมสิน (GSB)</li>
                    <li>ธ.ก.ส. (BAAC)</li>
                    <li>ธนาคารกรุงเทพ (BBL)</li>
                    <li>ธนาคารไทยพาณิชย์ (SCB)</li>
                    <li>ธนาคารกสิกรไทย (KBANK)</li>
                </ul>
            </li>
            <li><strong>เลขที่บัญชี:</strong> เลขบัญชีธนาคาร (10-12 หลัก)</li>
            <li><strong>ชื่อบัญชี:</strong> ชื่อกองทุนที่เปิดบัญชี เช่น "กองทุนหมู่บ้านบ้านสวนสวรรค์"</li>
            <li><strong>สาขา:</strong> สาขาที่เปิดบัญชี เช่น "สาขาอำเภอเมืองเชียงใหม่"</li>
            <li><strong>ประเภทบัญชี:</strong> ออมทรัพย์ หรือ กระแสรายวัน</li>
        </ul>
        <x-guide-screenshot src="images/guide/settings/add-bank-account.png" alt="เพิ่มบัญชีธนาคาร" caption="กรอกข้อมูลบัญชีธนาคาร" />
    </x-guide-step>

    <x-guide-step :number="4" title="บันทึก">
        <p>ตรวจสอบเลขที่บัญชีและชื่อบัญชีให้ถูกต้อง แล้วคลิกปุ่ม <strong>"บันทึก"</strong></p>
        <x-guide-tip type="warning">
            ตรวจสอบเลขที่บัญชีให้ถูกต้องทุกหลัก เพราะข้อมูลนี้จะแสดงในใบสำคัญรับ/จ่ายและรายงานต่างๆ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="แก้ไขหรือลบบัญชีธนาคาร">
        <p><strong>แก้ไข:</strong> คลิกที่บัญชีธนาคารเพื่อแก้ไขข้อมูล เช่น เปลี่ยนสาขา</p>
        <p class="mt-2"><strong>ลบ:</strong> คลิกปุ่ม "ลบ" เพื่อลบบัญชีที่ไม่ใช้แล้ว ระบบจะถามยืนยันก่อนลบ</p>
        <x-guide-tip type="info">
            ไม่สามารถลบบัญชีธนาคารที่มีรายการบันทึกอ้างอิงอยู่ได้ ให้เปลี่ยนสถานะเป็น "ไม่ใช้งาน" แทน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="วิธีใช้บัญชีธนาคารในการบันทึกรายการ">
        <p>เมื่อเพิ่มบัญชีธนาคารแล้ว ตอนบันทึกรายรับ-รายจ่ายจะมีตัวเลือกให้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เงินสด:</strong> สำหรับรายการที่รับ-จ่ายเป็นเงินสด</li>
            <li><strong>เงินฝากธนาคาร → เลือกบัญชี:</strong> สำหรับรายการที่โอนผ่านธนาคาร</li>
        </ul>
        <p>ระบบจะบันทึกบัญชีให้อัตโนมัติตามบัญชีธนาคารที่เลือก</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        เพิ่มบัญชีธนาคาร <strong>ทุกบัญชี</strong> ที่กองทุนใช้ตั้งแต่แรก กองทุนส่วนใหญ่มีบัญชีธนาคาร 1-3 บัญชี
        (เช่น ออมสิน 1 บัญชี + กรุงไทย 1 บัญชี)
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
