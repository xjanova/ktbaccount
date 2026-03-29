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

    <x-guide-step :number="1" title="ทำไมต้องมีหลายชุดบัญชี?">
        <p>เหตุผลที่กองทุนต้องแยกชุดบัญชี:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>แยกเงินแต่ละก้อนชัดเจน:</strong> ดูได้ว่าเงินแต่ละก้อนมีรายรับ-รายจ่ายอย่างไร</li>
            <li><strong>ทำรายงานแยกกัน:</strong> งบกำไรขาดทุนของเงินล้านแยกจากเงินเพิ่มทุน</li>
            <li><strong>ตรวจสอบง่าย:</strong> ผู้ตรวจสอบดูแต่ละก้อนเงินได้สะดวก</li>
            <li><strong>ตาม พ.ร.บ.:</strong> กองทุนหมู่บ้านต้องรายงานแยกตามแหล่งเงินทุน</li>
        </ul>
        <p><strong>ตัวอย่างชุดบัญชีที่พบบ่อย:</strong></p>
        <div class="overflow-x-auto my-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">ชุดบัญชี</th>
                        <th class="py-2 pr-4">รหัส</th>
                        <th class="py-2">คำอธิบาย</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4 font-semibold">บัญชีเงินล้าน</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">ML</td>
                        <td class="py-2">เงินกองทุนหมู่บ้าน 1 ล้านบาทแรก</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">บัญชีเพิ่มทุน</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">AT</td>
                        <td class="py-2">เงินเพิ่มทุนระยะที่ 1-3 จากรัฐบาล</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">บัญชีออมทรัพย์</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">SV</td>
                        <td class="py-2">เงินออมของสมาชิก</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">บัญชีสวัสดิการ</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">WF</td>
                        <td class="py-2">กองทุนสวัสดิการสมาชิก</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-guide-step>

    <x-guide-step :number="2" title="เปิดหน้าตั้งค่าชุดบัญชี">
        <p>ไปที่ <strong>ตั้งค่า > ชุดบัญชี</strong></p>
        <p>ระบบจะแสดงรายการชุดบัญชีทั้งหมดที่มี พร้อมข้อมูล:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อชุดบัญชี</strong></li>
            <li><strong>รหัส</strong></li>
            <li><strong>จำนวนบัญชี</strong> ที่อยู่ในชุดนี้</li>
            <li><strong>สถานะ</strong> (ใช้งาน/ไม่ใช้งาน)</li>
        </ul>
        <x-guide-screenshot src="images/guide/settings/account-sets-list.png" alt="รายการชุดบัญชี" caption="รายการชุดบัญชีทั้งหมดของกองทุน" />
    </x-guide-step>

    <x-guide-step :number="3" title="เพิ่มชุดบัญชีใหม่">
        <p>คลิกปุ่ม <strong>"+ เพิ่มชุดบัญชี"</strong> แล้วกรอกข้อมูล:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อชุดบัญชี:</strong> เช่น "บัญชีเงินล้าน" หรือ "บัญชีออมทรัพย์"</li>
            <li><strong>รหัส:</strong> รหัสสั้นๆ 2-3 ตัวอักษร เช่น "ML" หรือ "SV"</li>
            <li><strong>คำอธิบาย:</strong> อธิบายสั้นๆ ว่าชุดบัญชีนี้ใช้ทำอะไร</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="บันทึก">
        <p>คลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p>ระบบจะทำงานอัตโนมัติ 2 อย่าง:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li><strong>สร้างผังบัญชีมาตรฐานให้อัตโนมัติ</strong> - ไม่ต้องสร้างผังบัญชีเอง ระบบจะสร้างรหัสบัญชีทั้ง 5 หมวดให้ (สินทรัพย์ หนี้สิน ทุน รายได้ ค่าใช้จ่าย)</li>
            <li><strong>สร้างงวดบัญชี 12 เดือน</strong> ของปีปัจจุบันให้อัตโนมัติ</li>
        </ol>
        <x-guide-tip type="info">
            ผังบัญชีมาตรฐานครอบคลุมรายการที่กองทุนหมู่บ้านใช้บ่อย ท่านสามารถเพิ่มหรือแก้ไขรหัสบัญชีได้ภายหลัง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="เลือกชุดบัญชีที่ใช้งาน">
        <p>เมื่อมีหลายชุดบัญชี ทุกครั้งที่บันทึกรายรับ-รายจ่ายหรือดูรายงาน จะต้องเลือกว่าจะใช้ชุดบัญชีไหน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>บันทึกรายรับ-รายจ่าย:</strong> เลือกชุดบัญชีที่ช่อง "ชุดบัญชี" ในแบบฟอร์ม</li>
            <li><strong>ดูรายงาน:</strong> เลือกชุดบัญชีที่ด้านบนของหน้ารายงาน หรือเลือก "ทุกชุดบัญชี" เพื่อดูรวม</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="แก้ไขหรือปิดใช้งานชุดบัญชี">
        <p>คลิกที่ชุดบัญชีในรายการเพื่อแก้ไขชื่อหรือคำอธิบาย</p>
        <p class="mt-2">หากไม่ต้องการใช้ชุดบัญชีใดแล้ว สามารถ <strong>"ปิดใช้งาน"</strong> ได้ ข้อมูลจะยังคงอยู่ แต่จะไม่แสดงเป็นตัวเลือกในหน้าบันทึกรายการ</p>
        <x-guide-tip type="warning">
            ไม่ควรลบชุดบัญชีที่มีรายการบันทึกอยู่แล้ว เพราะจะทำให้ข้อมูลเดิมหายไป ให้ "ปิดใช้งาน" แทน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-tip type="tip">
        กองทุนส่วนใหญ่จะมี 2-3 ชุดบัญชี ตั้งค่าครั้งเดียวตอนเริ่มใช้ระบบ หลังจากนั้นไม่ค่อยต้องแก้ไข
        ควรตั้งชื่อชุดบัญชีให้ชัดเจน เพื่อจะได้ไม่สับสนตอนบันทึกรายการหรือดูรายงาน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
