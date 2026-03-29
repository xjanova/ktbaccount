@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะอธิบายเรื่อง "งวดบัญชี" ว่าคืออะไร และวิธีเปิด/ปิดงวดบัญชีในระบบ
        งวดบัญชีเป็นสิ่งสำคัญที่ช่วยจัดระเบียบการบันทึกบัญชีและป้องกันการแก้ไขข้อมูลย้อนหลัง
    </p>

    <x-guide-step :number="1" title="งวดบัญชีคืออะไร?">
        <p><strong>งวดบัญชี</strong> คือช่วงเวลาที่ใช้แบ่งการบันทึกบัญชี โดยปกติ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>1 ปี (ปีปฏิทิน: มกราคม - ธันวาคม) แบ่งเป็น <strong>12 งวด</strong></li>
            <li>แต่ละงวดคือ 1 เดือน (งวดที่ 1 = มกราคม, งวดที่ 2 = กุมภาพันธ์, ...)</li>
        </ul>

        <x-guide-tip type="info">
            ระบบสร้างงวดบัญชี 12 เดือนให้อัตโนมัติเมื่อเพิ่มชุดบัญชี ท่านไม่ต้องสร้างเอง
        </x-guide-tip>

        <p class="mt-4"><strong>ทำไมต้องมีงวดบัญชี?</strong></p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>จัดระเบียบ:</strong> แบ่งรายการตามเดือน ตรวจสอบง่าย</li>
            <li><strong>ป้องกัน:</strong> เมื่อปิดงวดแล้ว ไม่มีใครแก้ไขข้อมูลในเดือนนั้นได้</li>
            <li><strong>รายงาน:</strong> ดูรายงานแยกตามเดือนได้ง่าย</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="2" title="ดูสถานะงวดบัญชี">
        <p>เข้าหน้า <strong>"ตั้งค่า"</strong> หรือ <strong>"บัญชี > งวดบัญชี"</strong></p>
        <p>ระบบจะแสดงรายการงวดบัญชี 12 เดือน พร้อมสถานะ:</p>
        <div class="overflow-x-auto my-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">สถานะ</th>
                        <th class="py-2 pr-4">สี</th>
                        <th class="py-2">ความหมาย</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4 font-semibold text-emerald-400">เปิด</td>
                        <td class="py-2 pr-4">เขียว</td>
                        <td class="py-2">สามารถบันทึก/แก้ไข/ลบรายการในงวดนี้ได้</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold text-red-400">ปิด</td>
                        <td class="py-2 pr-4">แดง</td>
                        <td class="py-2">ไม่สามารถบันทึก/แก้ไข/ลบรายการในงวดนี้ได้</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <x-guide-screenshot src="images/guide/accounting/fiscal-period-list.png" alt="รายการงวดบัญชี" caption="รายการงวดบัญชี 12 เดือน พร้อมสถานะ" />
    </x-guide-step>

    <x-guide-step :number="3" title="การปิดงวดบัญชี">
        <p>เมื่อตรวจสอบรายการในเดือนนั้นครบถ้วนแล้ว ให้ปิดงวดเพื่อป้องกันการแก้ไข:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>เข้าหน้า <strong>"งวดบัญชี"</strong></li>
            <li>เลือกงวดบัญชีที่ต้องการปิด (เช่น "มกราคม 2568")</li>
            <li>คลิกปุ่ม <strong>"ปิดงวด"</strong></li>
            <li>ระบบจะถามยืนยัน ให้คลิก <strong>"ยืนยัน"</strong></li>
        </ol>
        <x-guide-screenshot src="images/guide/accounting/fiscal-period-close.png" alt="ปิดงวดบัญชี" caption="คลิก &quot;ปิดงวด&quot; เพื่อปิดงวดบัญชี" />

        <p class="mt-4"><strong>เมื่อปิดงวดแล้ว:</strong></p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>❌ <strong>ไม่สามารถเพิ่ม</strong> รายการใหม่ในงวดที่ปิดแล้ว</li>
            <li>❌ <strong>ไม่สามารถแก้ไข</strong> รายการในงวดที่ปิดแล้ว</li>
            <li>❌ <strong>ไม่สามารถลบ</strong> รายการในงวดที่ปิดแล้ว</li>
            <li>✅ <strong>ดูรายงาน</strong> ย้อนหลังได้ตามปกติ</li>
        </ul>

        <x-guide-tip type="warning">
            ตรวจสอบรายการทั้งหมดให้ครบถ้วนและถูกต้อง <strong>ก่อน</strong> ปิดงวด
            แนะนำให้ดูงบทดลองของเดือนนั้นว่ายอดเดบิต=เครดิตก่อนปิด
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="การเปิดงวดบัญชีที่ปิดไปแล้ว">
        <p>ในกรณีที่จำเป็นต้องแก้ไขรายการในงวดที่ปิดไปแล้ว สามารถเปิดงวดกลับมาได้:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>เข้าหน้า <strong>"งวดบัญชี"</strong></li>
            <li>เลือกงวดที่ต้องการเปิด</li>
            <li>คลิกปุ่ม <strong>"เปิดงวด"</strong></li>
            <li>ระบบจะถามยืนยัน ให้คลิก <strong>"ยืนยัน"</strong></li>
        </ol>
        <x-guide-tip type="important">
            การเปิดงวดที่ปิดแล้วควรทำ <strong>เฉพาะเมื่อจำเป็น</strong> เท่านั้น
            และหลังแก้ไขเสร็จแล้วควรปิดงวดกลับเหมือนเดิม เพื่อป้องกันการแก้ไขโดยไม่ตั้งใจ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="แนะนำการปิดงวด">
        <p>แนวทางปฏิบัติที่ดี:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ปิดงวดทุกเดือน:</strong> หลังจากตรวจสอบรายการเดือนก่อนหน้าเรียบร้อยแล้ว เช่น พอขึ้นเดือนกุมภาพันธ์ ให้ปิดงวดมกราคม</li>
            <li><strong>ปิดงวดสิ้นปี:</strong> หลังจัดสรรกำไรและบันทึกปิดบัญชีสิ้นปีเรียบร้อย ให้ปิดงวดทั้ง 12 เดือนของปีนั้น</li>
            <li><strong>ปิดทีละเดือน:</strong> ควรปิดเรียงลำดับ ม.ค. → ก.พ. → มี.ค. ไม่ควรข้ามเดือน</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="งวดบัญชีกับรายงาน">
        <p>การปิดงวดไม่มีผลกับการดูรายงาน ท่านสามารถ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ดูรายงานของงวดที่ปิดแล้วได้ตามปกติ</li>
            <li>ดาวน์โหลด PDF ของงวดที่ปิดแล้วได้</li>
            <li>ดูรายงานข้ามงวดได้ (เช่น ดูทั้งปี)</li>
        </ul>
        <p>การปิดงวดเป็นแค่การ "ล็อค" ไม่ให้แก้ไขข้อมูล ไม่ได้ซ่อนข้อมูล</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ถ้ากองทุนมีผู้ใช้หลายคน การปิดงวดจะช่วยป้องกันการแก้ไขข้อมูลเดือนเก่าๆ โดยไม่ตั้งใจ
        ทำให้ข้อมูลบัญชีน่าเชื่อถือมากขึ้น
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
