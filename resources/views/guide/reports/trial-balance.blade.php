@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        งบทดลองคือตารางที่แสดงยอดรวมของทุกบัญชีในกองทุน โดยแบ่งเป็นฝั่ง "เดบิต" และ "เครดิต"
        ถ้าตัวเลขทั้งสองฝั่งเท่ากัน แสดงว่าการบันทึกบัญชีถูกต้อง
    </p>

    <x-guide-tip type="info">
        งบทดลองเป็นเหมือน "การตรวจสุขภาพ" ของบัญชี ใช้เพื่อตรวจสอบว่าตัวเลขในระบบถูกต้อง ก่อนจะทำรายงานอื่นๆ เช่น งบกำไรขาดทุน หรืองบดุล
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้างบทดลอง">
        <p>ไปที่เมนู <strong>"รายงาน"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"งบทดลอง"</strong></p>
        <x-guide-screenshot src="images/guide/reports/trial-balance-menu.png" alt="เมนูงบทดลอง" caption="เลือกเมนูงบทดลองจากหน้ารายงาน" />
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกชุดบัญชี">
        <p>เลือกชุดบัญชีที่ต้องการดูรายงาน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เลือกชุดใดชุดหนึ่ง:</strong> เช่น "บัญชีเงินล้าน" เพื่อดูเฉพาะก้อนเงินนั้น</li>
            <li><strong>เลือก "ทั้งหมด":</strong> เพื่อดูรวมทุกชุดบัญชี</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="กำหนดช่วงวันที่">
        <p>เลือกวันที่เริ่มต้นและวันที่สิ้นสุดที่ต้องการดูรายงาน เช่น:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ดูทั้งปี:</strong> 1 มกราคม ถึง 31 ธันวาคม</li>
            <li><strong>ดูเฉพาะเดือน:</strong> 1 มีนาคม ถึง 31 มีนาคม</li>
            <li><strong>ดูไตรมาส:</strong> 1 มกราคม ถึง 31 มีนาคม</li>
        </ul>
        <p>นอกจากนี้จะมีช่อง <strong>"รวมรายการปิดบัญชี"</strong> ให้เลือก:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ไม่ติ๊ก</strong> - แสดงเฉพาะรายการระหว่างปี (ใช้ดูระหว่างปี)</li>
            <li><strong>ติ๊ก</strong> - รวมรายการปิดบัญชีสิ้นปีด้วย (ใช้ดูตอนสิ้นปี)</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="กดดูรายงาน">
        <p>คลิกปุ่ม <strong>"ดูรายงาน"</strong> ระบบจะแสดงงบทดลองที่มีรายชื่อบัญชีทั้งหมด พร้อมยอดเดบิตและเครดิต</p>
        <x-guide-screenshot src="images/guide/reports/trial-balance.png" alt="ตัวอย่างงบทดลอง" caption="ตัวอย่างงบทดลอง แสดงยอดเดบิตและเครดิตของทุกบัญชี" />
    </x-guide-step>

    <x-guide-step :number="5" title="วิธีอ่านงบทดลอง">
        <p>งบทดลองมีคอลัมน์หลักๆ ดังนี้:</p>
        <div class="overflow-x-auto my-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">คอลัมน์</th>
                        <th class="py-2">ความหมาย</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4 font-semibold">รหัสบัญชี</td>
                        <td class="py-2">รหัส 5 หลัก เช่น 11000 = เงินสด</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">ชื่อบัญชี</td>
                        <td class="py-2">ชื่อของบัญชีนั้นๆ</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">เดบิต</td>
                        <td class="py-2">ยอดรวมฝั่งเดบิต (สินทรัพย์ + ค่าใช้จ่าย)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">เครดิต</td>
                        <td class="py-2">ยอดรวมฝั่งเครดิต (หนี้สิน + ทุน + รายได้)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <x-guide-tip type="tip">
            <strong>จุดสำคัญที่ต้องดู:</strong> ดูบรรทัดสุดท้าย "ยอดรวม" — ถ้ายอดรวมเดบิตเท่ากับยอดรวมเครดิต แสดงว่าการบันทึกบัญชีถูกต้อง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="ถ้ายอดไม่เท่ากัน ทำอย่างไร?">
        <p>ถ้ายอดรวมเดบิตไม่เท่ากับยอดรวมเครดิต แสดงว่ามีรายการบันทึกผิด ให้ทำดังนี้:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li><strong>ตรวจสอบรายการล่าสุด:</strong> ดูว่ารายการที่บันทึกล่าสุดถูกต้องหรือไม่</li>
            <li><strong>ตรวจดูรายการบัญชี (Journal Entry):</strong> ดูว่ามีรายการไหนที่เดบิตกับเครดิตไม่เท่ากัน</li>
            <li><strong>ลองเปลี่ยนช่วงวันที่:</strong> ย่อช่วงวันที่ให้แคบลง เพื่อหาว่าเดือนไหนที่เริ่มผิด</li>
        </ol>
        <x-guide-tip type="warning">
            ในการใช้งานปกติ ยอดจะเท่ากันเสมอ เพราะระบบบันทึกบัญชีให้อัตโนมัติ ปัญหามักเกิดจากการบันทึกรายการบัญชีแบบ Manual (Journal Entry) ที่ตัวเลขไม่ตรงกัน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="7" title="ดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> เพื่อบันทึกเป็นไฟล์ PDF สำหรับพิมพ์หรือส่งให้ผู้ตรวจสอบ</p>
        <p>ไฟล์ PDF จะมีหัวกระดาษแสดงชื่อกองทุน ชุดบัญชี และช่วงวันที่ที่เลือก</p>
    </x-guide-step>

    <x-guide-tip type="info">
        "รวมรายการปิดบัญชี" คือรายการที่ระบบบันทึกตอนสิ้นปี เพื่อโอนยอดรายได้และค่าใช้จ่ายไปยังบัญชีทุน
        ถ้าดูรายงานระหว่างปี ไม่ต้องติ๊กช่องนี้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
