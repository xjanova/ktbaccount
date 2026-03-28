@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีสร้างสัญญาสินเชื่อใหม่ให้สมาชิก
        ทำตามขั้นตอนด้านล่างได้เลย ไม่ยุ่งยาก
    </p>

    <x-guide-step :number="1" title="เข้าเมนูสินเชื่อ">
        <p>คลิกที่เมนู <strong>"สินเชื่อ"</strong> ในแถบด้านข้างซ้ายมือ ระบบจะแสดงรายการสัญญาสินเชื่อทั้งหมด</p>
        <x-guide-screenshot src="images/guide/loans/menu-loan.png" alt="เมนูสินเชื่อ" caption="คลิกเมนู &quot;สินเชื่อ&quot; ในแถบด้านข้าง" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่ม &quot;+ สร้างสัญญา&quot;">
        <p>ที่มุมขวาบนของหน้า ให้คลิกปุ่ม <strong>"+ สร้างสัญญา"</strong> เพื่อเริ่มสร้างสัญญาสินเชื่อใหม่</p>
        <x-guide-screenshot src="images/guide/loans/btn-create-loan.png" alt="ปุ่มสร้างสัญญา" caption="คลิกปุ่ม &quot;+ สร้างสัญญา&quot; เพื่อเริ่มต้น" />
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกสมาชิกผู้กู้">
        <p>พิมพ์ชื่อหรือเลขบัตรประชาชนของสมาชิกที่ต้องการกู้เงิน ระบบจะค้นหาให้อัตโนมัติ แล้วคลิกเลือกชื่อที่ถูกต้อง</p>
        <x-guide-screenshot src="images/guide/loans/select-member.png" alt="เลือกสมาชิกผู้กู้" caption="พิมพ์ชื่อแล้วเลือกสมาชิกจากรายการ" />
        <x-guide-tip type="tip">
            สมาชิกต้องลงทะเบียนในระบบก่อนถึงจะกู้เงินได้ ถ้ายังไม่มีชื่อ ให้ไปเพิ่มสมาชิกก่อน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กรอกรายละเอียดสินเชื่อ">
        <p>กรอกข้อมูลสินเชื่อให้ครบ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>จำนวนเงินกู้ (บาท)</strong> - ใส่จำนวนเงินที่สมาชิกต้องการกู้</li>
            <li><strong>อัตราดอกเบี้ย (% ต่อปี)</strong> - ใส่ดอกเบี้ยตามระเบียบกองทุน</li>
            <li><strong>จำนวนงวด</strong> - กำหนดจำนวนงวดที่จะผ่อนชำระ</li>
            <li><strong>วันที่ทำสัญญา</strong> - เลือกวันที่เริ่มสัญญา</li>
            <li><strong>วันที่เริ่มผ่อน</strong> - เลือกวันที่เริ่มผ่อนงวดแรก</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/loan-details-form.png" alt="แบบฟอร์มรายละเอียดสินเชื่อ" caption="กรอกจำนวนเงิน ดอกเบี้ย และจำนวนงวดให้ครบ" />
    </x-guide-step>

    <x-guide-step :number="5" title="เลือกผู้ค้ำประกัน">
        <p>เลือกสมาชิกที่จะเป็นผู้ค้ำประกันให้กับผู้กู้ โดยพิมพ์ชื่อค้นหาแล้วเลือกจากรายการ</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>สามารถเลือกผู้ค้ำได้มากกว่า 1 คน ตามระเบียบกองทุน</li>
            <li>ผู้ค้ำต้องเป็นสมาชิกของกองทุน</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/select-guarantor.png" alt="เลือกผู้ค้ำประกัน" caption="เลือกผู้ค้ำประกันจากรายชื่อสมาชิก" />
        <x-guide-tip type="warning">
            ตรวจสอบให้แน่ใจว่าผู้ค้ำยินยอมค้ำประกันแล้ว เพราะเมื่อบันทึกแล้วจะเปลี่ยนแปลงได้ยาก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="ตรวจสอบและบันทึก">
        <p>ตรวจสอบข้อมูลทั้งหมดให้ถูกต้อง แล้วกดปุ่ม <strong>"บันทึก"</strong></p>
        <x-guide-screenshot src="images/guide/loans/btn-save-loan.png" alt="ปุ่มบันทึกสัญญา" caption="ตรวจสอบข้อมูลแล้วกดบันทึก" />
        <x-guide-tip type="important">
            เมื่อบันทึกแล้ว ระบบจะสร้างตารางผ่อนชำระให้อัตโนมัติ โดยคำนวณเงินต้นและดอกเบี้ยแต่ละงวดให้เรียบร้อย
            ไม่ต้องคำนวณเอง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="7" title="ดูสัญญาที่สร้างสำเร็จ">
        <p>หลังบันทึกเรียบร้อย ระบบจะแสดงรายละเอียดสัญญาที่สร้างสำเร็จ พร้อมตารางผ่อนชำระที่ระบบคำนวณให้</p>
        <p>สัญญาที่สร้างใหม่จะมีสถานะ <strong>"รออนุมัติ"</strong> ต้องรอผู้มีอำนาจอนุมัติก่อนถึงจะเริ่มรับชำระได้</p>
        <x-guide-screenshot src="images/guide/loans/loan-created-success.png" alt="สัญญาที่สร้างสำเร็จ" caption="สัญญาสินเชื่อที่สร้างสำเร็จพร้อมตารางผ่อน" />
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
