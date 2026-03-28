@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะอธิบายเรื่อง "งวดบัญชี" ว่าคืออะไร และวิธีเปิด/ปิดงวดบัญชีในระบบ
    </p>

    <x-guide-step :number="1" title="งวดบัญชีคืออะไร?">
        <p><strong>งวดบัญชี</strong> คือช่วงเวลาที่ใช้แบ่งการบันทึกบัญชี โดยปกติ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>1 ปี แบ่งเป็น <strong>12 งวด</strong> (มกราคม ถึง ธันวาคม)</li>
            <li>แต่ละงวดคือ 1 เดือน</li>
        </ul>
        <p>การแบ่งงวดบัญชีช่วยให้สามารถตรวจสอบรายรับ-รายจ่ายเป็นรายเดือนได้ และป้องกันไม่ให้มีการแก้ไขรายการย้อนหลังในเดือนที่ปิดบัญชีไปแล้ว</p>
        <x-guide-tip type="tip">
            ระบบสร้างงวดบัญชีให้อัตโนมัติ ท่านไม่ต้องสร้างเอง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="การเปิดงวดบัญชี">
        <p>งวดบัญชีที่ <strong>"เปิด"</strong> อยู่ หมายความว่าสามารถ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>เพิ่มรายการรายรับ-รายจ่ายในงวดนั้นได้</li>
            <li>แก้ไขรายการที่บันทึกไว้ในงวดนั้นได้</li>
            <li>ลบรายการในงวดนั้นได้</li>
        </ul>
        <p>โดยปกติ งวดเดือนปัจจุบันจะเปิดอยู่เสมอ</p>
    </x-guide-step>

    <x-guide-step :number="3" title="การปิดงวดบัญชี">
        <p>เมื่อตรวจสอบรายการในเดือนนั้นครบถ้วนแล้ว สามารถ <strong>"ปิด"</strong> งวดบัญชีได้ การปิดงวดจะทำให้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ไม่สามารถเพิ่ม</strong> รายการใหม่ในงวดที่ปิดแล้ว</li>
            <li><strong>ไม่สามารถแก้ไข</strong> รายการในงวดที่ปิดแล้ว</li>
            <li><strong>ไม่สามารถลบ</strong> รายการในงวดที่ปิดแล้ว</li>
        </ul>
        <x-guide-tip type="warning">
            ตรวจสอบรายการทั้งหมดให้ครบถ้วนและถูกต้องก่อนปิดงวด เพราะหลังปิดแล้วจะไม่สามารถแก้ไขได้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="วิธีปิดงวดบัญชี">
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>เข้าหน้า <strong>"ตั้งค่า"</strong> หรือ <strong>"งวดบัญชี"</strong></li>
            <li>เลือกงวดบัญชีที่ต้องการปิด</li>
            <li>คลิกปุ่ม <strong>"ปิดงวด"</strong></li>
            <li>ระบบจะถามยืนยันอีกครั้ง ให้คลิก <strong>"ยืนยัน"</strong></li>
        </ol>
        <x-guide-screenshot src="images/guide/accounting/fiscal-period-close.png" alt="ปิดงวดบัญชี" caption="คลิก &quot;ปิดงวด&quot; เพื่อปิดงวดบัญชี" />
    </x-guide-step>

    <x-guide-step :number="5" title="การเปิดงวดบัญชีที่ปิดไปแล้ว">
        <p>ในกรณีที่จำเป็นต้องแก้ไขรายการในงวดที่ปิดไปแล้ว สามารถเปิดงวดกลับมาได้:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>เข้าหน้า <strong>"งวดบัญชี"</strong></li>
            <li>เลือกงวดที่ต้องการเปิด</li>
            <li>คลิกปุ่ม <strong>"เปิดงวด"</strong></li>
        </ol>
        <x-guide-tip type="important">
            การเปิดงวดที่ปิดแล้วควรทำเฉพาะเมื่อจำเป็น และหลังแก้ไขเสร็จแล้วควรปิดงวดกลับเหมือนเดิม
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
