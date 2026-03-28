@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ชุดบัญชีคือการแบ่งบัญชีของกองทุนออกเป็นหลายชุด เช่น "บัญชีเงินล้าน" "บัญชีเพิ่มทุน" "บัญชีออมทรัพย์"
        แต่ละชุดมีผังบัญชีและงบการเงินแยกกัน
    </p>

    <x-guide-tip type="info">
        พูดง่ายๆ คือ กองทุนอาจมีเงินหลายก้อน แต่ละก้อนเป็นคนละชุดบัญชี
        เช่น เงินล้านก้อนหนึ่ง เงินเพิ่มทุนอีกก้อนหนึ่ง กองทุนส่วนใหญ่มี 2-3 ชุดบัญชี
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้าตั้งค่าชุดบัญชี">
        <p>ไปที่ <strong>ตั้งค่า > ชุดบัญชี</strong></p>
        <p>ระบบจะแสดงรายการชุดบัญชีทั้งหมดที่มี</p>
        <x-guide-screenshot src="images/guide/settings/account-sets-list.png" alt="รายการชุดบัญชี" caption="รายการชุดบัญชีทั้งหมดของกองทุน" />
    </x-guide-step>

    <x-guide-step :number="2" title="เพิ่มชุดบัญชีใหม่">
        <p>คลิกปุ่ม <strong>"+ เพิ่มชุดบัญชี"</strong> แล้วกรอกข้อมูล:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อชุดบัญชี:</strong> เช่น "บัญชีเงินล้าน" หรือ "บัญชีออมทรัพย์"</li>
            <li><strong>รหัส:</strong> รหัสสั้นๆ เช่น "ML" หรือ "SV"</li>
            <li><strong>คำอธิบาย:</strong> อธิบายสั้นๆ ว่าชุดบัญชีนี้ใช้ทำอะไร</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="บันทึก">
        <p>คลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p>ระบบจะ <strong>สร้างผังบัญชีมาตรฐานให้อัตโนมัติ</strong> ไม่ต้องสร้างผังบัญชีเอง</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        กองทุนส่วนใหญ่จะมี 2-3 ชุดบัญชี ตั้งค่าครั้งเดียวตอนเริ่มใช้ระบบ หลังจากนั้นไม่ค่อยต้องแก้ไข
    </x-guide-tip>

    <x-guide-tip type="warning">
        ควรตั้งชื่อชุดบัญชีให้ชัดเจน เพื่อจะได้ไม่สับสนตอนบันทึกรายการหรือดูรายงาน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
