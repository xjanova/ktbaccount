@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีบันทึกรายการบัญชี (Journal Entry) สำหรับกรณีที่ต้องการบันทึกรายการบัญชีที่ซับซ้อนกว่ารายรับ-รายจ่ายปกติ
    </p>

    <x-guide-tip type="info">
        <strong>ผู้ใช้ส่วนใหญ่ไม่ต้องใช้หน้านี้!</strong> รายรับ-รายจ่ายทั่วไป ระบบจะบันทึกบัญชีให้อัตโนมัติ
        เมื่อบันทึกรายรับ-รายจ่ายผ่านหน้าปกติ หน้านี้สำหรับกรณีพิเศษเท่านั้น
    </x-guide-tip>

    <x-guide-step :number="1" title="ใช้เมื่อไหร่?">
        <p>หน้านี้ใช้เมื่อต้องการ <strong>บันทึกรายการบัญชีที่ซับซ้อน</strong> กว่าการรับ-จ่ายเงินปกติ เช่น:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ปรับปรุงรายการบัญชี:</strong> แก้ไขยอดบัญชีที่ผิดพลาด</li>
            <li><strong>โอนเงินระหว่างบัญชี:</strong> ย้ายเงินจากบัญชีหนึ่งไปอีกบัญชี</li>
            <li><strong>บันทึกค่าเสื่อมราคา:</strong> บันทึกค่าเสื่อมของทรัพย์สิน</li>
            <li><strong>แก้ไขรายการที่บันทึกผิด:</strong> กลับรายการแล้วบันทึกใหม่ให้ถูกต้อง</li>
            <li><strong>บันทึกรายการปิดบัญชีสิ้นปี:</strong> โอนรายได้/ค่าใช้จ่ายไปกำไรสะสม</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="2" title="เข้าหน้าบันทึกรายการบัญชี">
        <p>คลิกเมนู <strong>"บัญชี"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"บันทึกรายการบัญชี"</strong></p>
        <x-guide-screenshot src="images/guide/accounting/menu-journal-entry.png" alt="เมนูบันทึกรายการบัญชี" caption="คลิกเมนู &quot;บันทึกรายการบัญชี&quot;" />
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกข้อมูลหัวเอกสาร">
        <p>กรอกข้อมูลด้านบนของหน้าก่อน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>วันที่เอกสาร:</strong> เลือกวันที่ที่ต้องการบันทึก</li>
            <li><strong>ชุดบัญชี:</strong> เลือกชุดบัญชีที่ต้องการบันทึก เช่น "บัญชีเงินล้าน"</li>
            <li><strong>สมุดรายวัน:</strong> เลือกประเภทสมุดรายวัน
                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                    <li><strong>ทั่วไป:</strong> สำหรับรายการปรับปรุงทั่วไป</li>
                    <li><strong>เงินสดรับ:</strong> สำหรับรายการที่เกี่ยวกับเงินสดรับ</li>
                    <li><strong>เงินสดจ่าย:</strong> สำหรับรายการที่เกี่ยวกับเงินสดจ่าย</li>
                </ul>
            </li>
            <li><strong>คำอธิบาย:</strong> อธิบายว่าบันทึกรายการนี้เพื่ออะไร เช่น "ปรับปรุงยอดเงินสด"</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="เพิ่มรายการเดบิต/เครดิต">
        <p>ส่วนสำคัญที่สุดคือการเพิ่มรายการเดบิตและเครดิต:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li><strong>เลือกรหัสบัญชี:</strong> ค้นหาและเลือกรหัสบัญชีที่ต้องการ (เช่น 11000 = เงินสด)</li>
            <li><strong>ใส่จำนวนเงินด้านเดบิต:</strong> ถ้าเป็นรายการเดบิต</li>
            <li><strong>ใส่จำนวนเงินด้านเครดิต:</strong> ถ้าเป็นรายการเครดิต</li>
            <li>คลิก <strong>"+ เพิ่มรายการ"</strong> เพื่อเพิ่มบรรทัดใหม่ (ถ้ามีหลายรายการ)</li>
        </ol>
        <x-guide-screenshot src="images/guide/accounting/journal-debit-credit.png" alt="รายการเดบิตเครดิต" caption="เพิ่มรายการเดบิตและเครดิต โดยยอดรวมต้องเท่ากัน" />
        <x-guide-tip type="important">
            <strong>ยอดรวมเดบิตต้องเท่ากับยอดรวมเครดิตเสมอ</strong> ถ้าไม่เท่ากัน ระบบจะไม่อนุญาตให้บันทึก
            ด้านล่างของตารางจะแสดงยอดรวมทั้งสองฝั่งให้ตรวจสอบ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="ตัวอย่างการบันทึก">
        <p>ตัวอย่างที่พบบ่อย:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ตัวอย่าง 1: โอนเงินจากเงินสดไปฝากธนาคาร</h4>
        <div class="overflow-x-auto my-2">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">บัญชี</th>
                        <th class="py-2 pr-4 text-right">เดบิต</th>
                        <th class="py-2 text-right">เครดิต</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4">เงินฝากธนาคาร</td>
                        <td class="py-2 pr-4 text-right text-emerald-400">10,000</td>
                        <td class="py-2 text-right">-</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4">เงินสด</td>
                        <td class="py-2 pr-4 text-right">-</td>
                        <td class="py-2 text-right text-red-400">10,000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 class="text-white font-semibold mt-4 mb-2">ตัวอย่าง 2: ปรับปรุงดอกเบี้ยค้างรับ</h4>
        <div class="overflow-x-auto my-2">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">บัญชี</th>
                        <th class="py-2 pr-4 text-right">เดบิต</th>
                        <th class="py-2 text-right">เครดิต</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4">ดอกเบี้ยค้างรับ</td>
                        <td class="py-2 pr-4 text-right text-emerald-400">5,000</td>
                        <td class="py-2 text-right">-</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4">ดอกเบี้ยรับ</td>
                        <td class="py-2 pr-4 text-right">-</td>
                        <td class="py-2 text-right text-red-400">5,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-guide-step>

    <x-guide-step :number="6" title="กดบันทึก">
        <p>เมื่อตรวจสอบว่ายอดเดบิตเท่ากับเครดิตแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong></p>
        <p>ระบบจะบันทึกรายการและแสดงข้อความ "บันทึกเรียบร้อย"</p>
        <x-guide-tip type="warning">
            ถ้ายอดรวมเดบิตไม่เท่ากับยอดรวมเครดิต ระบบจะแสดงข้อความเตือนและไม่สามารถบันทึกได้
            ให้ตรวจสอบตัวเลขอีกครั้ง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="7" title="ดูรายการที่บันทึกแล้ว">
        <p>หลังบันทึก สามารถดูรายการ Journal Entry ทั้งหมดได้ที่หน้า <strong>"รายการบัญชี"</strong></p>
        <p>แต่ละรายการจะแสดงเลขที่เอกสาร วันที่ คำอธิบาย และยอดเงิน</p>
        <p>คลิกที่รายการเพื่อดูรายละเอียดเดบิต/เครดิตทั้งหมด</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ถ้าไม่แน่ใจว่าต้องลงบัญชีอย่างไร ให้ปรึกษาผู้จัดทำบัญชีหรือผู้ตรวจสอบของกองทุน
        การบันทึก Journal Entry ที่ผิดจะทำให้งบการเงินผิดเพี้ยน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
