@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีเปิดบัญชีเงินฝากให้สมาชิก
        ทำตามขั้นตอนด้านล่างได้เลย ง่ายมาก
    </p>

    <x-guide-step :number="1" title="เข้าเมนูเงินฝาก">
        <p>คลิกที่เมนู <strong>"เงินฝาก"</strong> ในแถบด้านข้างซ้ายมือ ระบบจะแสดงรายการบัญชีเงินฝากทั้งหมด</p>
        <x-guide-screenshot src="images/guide/savings/menu-savings.png" alt="เมนูเงินฝาก" caption="คลิกเมนู &quot;เงินฝาก&quot; ในแถบด้านข้าง" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่ม &quot;+ เปิดบัญชี&quot;">
        <p>ที่มุมขวาบนของหน้า ให้คลิกปุ่ม <strong>"+ เปิดบัญชี"</strong> เพื่อเริ่มเปิดบัญชีเงินฝากใหม่</p>
        <x-guide-screenshot src="images/guide/savings/btn-open-account.png" alt="ปุ่มเปิดบัญชี" caption="คลิกปุ่ม &quot;+ เปิดบัญชี&quot; เพื่อเริ่มต้น" />
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกสมาชิก">
        <p>พิมพ์ชื่อหรือเลขบัตรประชาชนของสมาชิกที่ต้องการเปิดบัญชี ระบบจะค้นหาให้ แล้วคลิกเลือกชื่อที่ถูกต้อง</p>
        <x-guide-screenshot src="images/guide/savings/select-member-savings.png" alt="เลือกสมาชิก" caption="พิมพ์ชื่อแล้วเลือกสมาชิกจากรายการ" />
    </x-guide-step>

    <x-guide-step :number="4" title="เลือกประเภทบัญชี">
        <p>เลือกประเภทบัญชีเงินฝากที่ต้องการเปิด:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ออมทรัพย์</strong> - ฝากถอนได้ตลอด ดอกเบี้ยต่ำ</li>
            <li><strong>ประจำ</strong> - ฝากเป็นระยะเวลา ดอกเบี้ยสูงกว่า</li>
        </ul>
        <x-guide-screenshot src="images/guide/savings/account-type.png" alt="ประเภทบัญชี" caption="เลือกประเภทบัญชีที่ต้องการเปิด" />
    </x-guide-step>

    <x-guide-step :number="5" title="กำหนดอัตราดอกเบี้ย">
        <p>ใส่อัตราดอกเบี้ยของบัญชีนี้ในช่อง <strong>"อัตราดอกเบี้ย (% ต่อปี)"</strong> ตามระเบียบกองทุน</p>
        <x-guide-tip type="tip">
            อัตราดอกเบี้ยจะถูกกำหนดตามประเภทบัญชี ถ้ากองทุนตั้งค่าไว้แล้ว ระบบจะใส่ให้อัตโนมัติ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="บันทึกเปิดบัญชี">
        <p>ตรวจสอบข้อมูลให้ถูกต้อง แล้วกดปุ่ม <strong>"บันทึก"</strong></p>
        <x-guide-screenshot src="images/guide/savings/btn-save-account.png" alt="ปุ่มบันทึก" caption="ตรวจสอบแล้วกดบันทึกเพื่อเปิดบัญชี" />
        <x-guide-tip type="important">
            เมื่อเปิดบัญชีสำเร็จ สมาชิกจะได้เลขที่บัญชีเงินฝาก และสามารถเริ่มฝากเงินได้ทันที
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
