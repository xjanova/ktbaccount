@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะอธิบายเรื่อง "ผังบัญชี" ให้เข้าใจง่ายๆ ว่าคืออะไร มีโครงสร้างอย่างไร
        และรหัสบัญชีที่ใช้บ่อยในกองทุนหมู่บ้านมีอะไรบ้าง
    </p>

    <x-guide-step :number="1" title="ผังบัญชีคืออะไร?">
        <p><strong>ผังบัญชี</strong> คือระบบจัดหมวดหมู่เงินเข้า-เงินออกของกองทุน เพื่อให้รู้ว่าเงินแต่ละก้อนเป็นเงินประเภทไหน</p>
        <p>เปรียบเทียบง่ายๆ เหมือน <strong>ลิ้นชักที่แบ่งเก็บของต่างชนิด</strong>:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ลิ้นชักที่ 1 เก็บ "ทรัพย์สิน" - เงินสด เงินในบัญชีธนาคาร</li>
            <li>ลิ้นชักที่ 2 เก็บ "หนี้สิน" - เงินที่กองทุนเป็นหนี้คนอื่น</li>
            <li>ลิ้นชักที่ 3 เก็บ "ทุน" - เงินทุนของกองทุน</li>
            <li>ลิ้นชักที่ 4 เก็บ "รายได้" - เงินที่ได้เข้ามา</li>
            <li>ลิ้นชักที่ 5 เก็บ "ค่าใช้จ่าย" - เงินที่จ่ายออกไป</li>
        </ul>
        <p>ระบบจะจัดหมวดหมู่ให้อัตโนมัติเมื่อท่านบันทึกรายรับ-รายจ่าย</p>
    </x-guide-step>

    <x-guide-step :number="2" title="โครงสร้างรหัสบัญชี 5 หลัก">
        <p>รหัสบัญชีทุกตัวมี <strong>5 หลัก</strong> โดยหลักแรกบอกว่าเป็นหมวดอะไร:</p>

        <div class="overflow-x-auto my-6">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-gray-300 font-semibold">หลักที่ 1</th>
                        <th class="text-left py-3 px-4 text-gray-300 font-semibold">หมวด</th>
                        <th class="text-left py-3 px-4 text-gray-300 font-semibold">ตัวอย่าง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-bold text-blue-400">1xxxx</td>
                        <td class="py-3 px-4">สินทรัพย์</td>
                        <td class="py-3 px-4 text-gray-400">เงินสด, เงินฝากธนาคาร, ลูกหนี้เงินกู้</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-bold text-red-400">2xxxx</td>
                        <td class="py-3 px-4">หนี้สิน</td>
                        <td class="py-3 px-4 text-gray-400">เงินรับฝากจากสมาชิก, เจ้าหนี้</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-bold text-purple-400">3xxxx</td>
                        <td class="py-3 px-4">ทุน</td>
                        <td class="py-3 px-4 text-gray-400">เงินทุนกองทุนหมู่บ้าน, กำไรสะสม</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-bold text-green-400">4xxxx</td>
                        <td class="py-3 px-4">รายได้</td>
                        <td class="py-3 px-4 text-gray-400">ดอกเบี้ยเงินกู้, ค่าธรรมเนียม</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-bold text-orange-400">5xxxx</td>
                        <td class="py-3 px-4">ค่าใช้จ่าย</td>
                        <td class="py-3 px-4 text-gray-400">ค่าตอบแทน, ค่าสาธารณูปโภค</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-screenshot src="images/guide/accounting/chart-of-accounts-table.png" alt="ตารางผังบัญชี" caption="ตารางผังบัญชีในระบบ แบ่งเป็น 5 หมวดหลัก" />
    </x-guide-step>

    <x-guide-step :number="3" title="รหัสบัญชีที่ใช้บ่อย">
        <p>รหัสที่กองทุนใช้บ่อยมีดังนี้:</p>

        <div class="overflow-x-auto my-6">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-gray-300 font-semibold">รหัส</th>
                        <th class="text-left py-3 px-4 text-gray-300 font-semibold">ชื่อบัญชี</th>
                        <th class="text-left py-3 px-4 text-gray-300 font-semibold">ใช้เมื่อไหร่</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-mono text-blue-400">11010</td>
                        <td class="py-3 px-4">เงินสด</td>
                        <td class="py-3 px-4 text-gray-400">รับ/จ่ายเงินสดโดยตรง</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-mono text-blue-400">12010</td>
                        <td class="py-3 px-4">เงินฝากธนาคาร</td>
                        <td class="py-3 px-4 text-gray-400">เงินในบัญชีธนาคาร</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-mono text-blue-400">13010</td>
                        <td class="py-3 px-4">ลูกหนี้เงินกู้</td>
                        <td class="py-3 px-4 text-gray-400">เงินที่สมาชิกกู้ไปแล้วยังไม่คืน</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-mono text-red-400">21010</td>
                        <td class="py-3 px-4">เงินรับฝากจากสมาชิก</td>
                        <td class="py-3 px-4 text-gray-400">เงินที่สมาชิกฝากไว้กับกองทุน</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-mono text-purple-400">33010</td>
                        <td class="py-3 px-4">กำไร(ขาดทุน)สะสม</td>
                        <td class="py-3 px-4 text-gray-400">ผลกำไร/ขาดทุนสะสมจากปีก่อนๆ</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-3 px-4 font-mono text-green-400">41010</td>
                        <td class="py-3 px-4">รายได้ดอกเบี้ยเงินกู้</td>
                        <td class="py-3 px-4 text-gray-400">ดอกเบี้ยที่ได้รับจากสมาชิกผู้กู้</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-tip type="tip">
            ไม่จำเป็นต้องจำรหัสบัญชีทั้งหมด ระบบจะเลือกรหัสให้อัตโนมัติเมื่อท่านบันทึกรายรับ-รายจ่ายผ่านหน้ารายรับ-รายจ่าย
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="รหัสที่มีเครื่องหมาย * (รหัสบัญชีคุม)">
        <p>ในผังบัญชี ท่านจะเห็นรหัสบางตัวมีเครื่องหมาย <strong>*</strong> อยู่ข้างหน้า เช่น <strong>*10000 สินทรัพย์</strong></p>
        <p>รหัสเหล่านี้เรียกว่า <strong>"รหัสบัญชีคุม"</strong> ซึ่งเป็นหัวข้อรวม ใช้สำหรับจัดกลุ่มบัญชีย่อยเท่านั้น</p>
        <x-guide-tip type="important">
            รหัสบัญชีคุม (ที่มีเครื่องหมาย *) ไม่ใช้บันทึกบัญชีโดยตรง ใช้เพื่อรวมยอดบัญชีย่อยเท่านั้น ระบบจะไม่ให้เลือกรหัสเหล่านี้ตอนบันทึกรายการ
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
