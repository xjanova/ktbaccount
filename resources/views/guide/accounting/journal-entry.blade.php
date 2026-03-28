@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีบันทึกรายการบัญชี (Journal Entry) สำหรับกรณีที่ต้องการบันทึกรายการบัญชีที่ซับซ้อนกว่ารายรับ-รายจ่ายปกติ
    </p>

    <x-guide-step :number="1" title="ใช้เมื่อไหร่?">
        <p>หน้านี้ใช้เมื่อต้องการ <strong>บันทึกรายการบัญชีที่ซับซ้อน</strong> กว่าการรับ-จ่ายเงินปกติ เช่น:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ปรับปรุงรายการบัญชี</li>
            <li>โอนเงินระหว่างบัญชี</li>
            <li>บันทึกค่าเสื่อมราคา</li>
            <li>แก้ไขรายการที่บันทึกผิด</li>
        </ul>
        <x-guide-tip type="info">
            รายรับ-รายจ่ายทั่วไป ไม่ต้องใช้หน้านี้ ระบบจะบันทึกบัญชีให้อัตโนมัติเมื่อบันทึกรายรับ-รายจ่ายผ่านหน้าปกติ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="เข้าระบบบัญชี">
        <p>เข้าระบบบัญชี VFGL ได้ 2 ทาง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ผ่าน <strong>LINE @VF_SUPPORT</strong></li>
            <li>ผ่าน <strong>เว็บไซต์</strong> โดยตรง</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="เลือก &quot;บันทึกรายการบัญชี&quot;">
        <p>หลังเข้าสู่ระบบแล้ว ให้คลิกเมนู <strong>"บันทึกรายการบัญชี"</strong></p>
        <x-guide-screenshot src="images/guide/accounting/menu-journal-entry.png" alt="เมนูบันทึกรายการบัญชี" caption="คลิกเมนู &quot;บันทึกรายการบัญชี&quot;" />
    </x-guide-step>

    <x-guide-step :number="4" title="กรอกข้อมูลหัวเอกสาร">
        <p>กรอกข้อมูลด้านบนของหน้าก่อน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>วันที่เอกสาร</strong> - เลือกวันที่ที่ต้องการบันทึก</li>
            <li><strong>ชุดบัญชี</strong> - เลือกชุดบัญชีที่ต้องการบันทึก</li>
            <li><strong>สมุดรายวัน</strong> - เลือกประเภทสมุดรายวัน:
                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                    <li><strong>ทั่วไป</strong> - สำหรับรายการปรับปรุง</li>
                    <li><strong>เงินสดรับ</strong> - สำหรับรายการรับเงินสด</li>
                    <li><strong>เงินสดจ่าย</strong> - สำหรับรายการจ่ายเงินสด</li>
                    <li><strong>ขาย</strong> - สำหรับรายการขาย</li>
                    <li><strong>ซื้อ</strong> - สำหรับรายการซื้อ</li>
                </ul>
            </li>
            <li><strong>คำอธิบาย</strong> - อธิบายว่าบันทึกรายการนี้เพื่ออะไร</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="5" title="เพิ่มรายการเดบิต/เครดิต">
        <p>ส่วนสำคัญที่สุดคือการเพิ่มรายการเดบิตและเครดิต:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li><strong>เลือกรหัสบัญชี</strong> - ค้นหาและเลือกรหัสบัญชีที่ต้องการ</li>
            <li><strong>ใส่จำนวนเงินด้านเดบิต</strong> - ถ้าเป็นรายการเดบิต</li>
            <li><strong>ใส่จำนวนเงินด้านเครดิต</strong> - ถ้าเป็นรายการเครดิต</li>
            <li>คลิก <strong>"+ เพิ่มรายการ"</strong> เพื่อเพิ่มบรรทัดใหม่ (ถ้ามีหลายรายการ)</li>
        </ol>
        <x-guide-screenshot src="images/guide/accounting/journal-debit-credit.png" alt="รายการเดบิตเครดิต" caption="เพิ่มรายการเดบิตและเครดิต โดยยอดรวมต้องเท่ากัน" />
        <x-guide-tip type="important">
            ยอดรวมเดบิตต้องเท่ากับยอดรวมเครดิตเสมอ ถ้าไม่เท่ากัน ระบบจะไม่อนุญาตให้บันทึก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="กดบันทึก">
        <p>เมื่อตรวจสอบว่ายอดเดบิตเท่ากับเครดิตแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong></p>
        <x-guide-tip type="warning">
            ถ้ายอดรวมเดบิตไม่เท่ากับยอดรวมเครดิต ระบบจะแสดงข้อความเตือนและไม่สามารถบันทึกได้ ให้ตรวจสอบตัวเลขอีกครั้ง
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
