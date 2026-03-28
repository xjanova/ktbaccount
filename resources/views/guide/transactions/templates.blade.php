@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีใช้ "รายการที่ใช้บ่อย" (Template) ซึ่งช่วยให้บันทึกรายการที่ทำซ้ำๆ ได้เร็วขึ้น
        ไม่ต้องกรอกข้อมูลใหม่ทุกครั้ง
    </p>

    <x-guide-step :number="1" title="รายการที่ใช้บ่อย (Template) คืออะไร?">
        <p>รายการที่ใช้บ่อย คือ <strong>รูปแบบรายการที่บันทึกไว้ล่วงหน้า</strong> เพื่อใช้ซ้ำได้ง่ายในครั้งต่อไป</p>
        <p>ตัวอย่างเช่น ถ้ากองทุนจ่ายค่าไฟทุกเดือน แทนที่จะกรอกข้อมูลใหม่ทุกครั้ง ก็สร้าง Template ไว้ แล้วเรียกใช้ได้เลย แค่เปลี่ยนวันที่กับจำนวนเงิน</p>
        <x-guide-tip type="tip">
            ใช้สำหรับรายการที่ทำซ้ำๆ เช่น จ่ายค่าไฟทุกเดือน จ่ายค่าตอบแทนกรรมการทุกเดือน รับค่าธรรมเนียมสมาชิกทุกปี
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="วิธีบันทึก Template ใหม่">
        <p>เมื่อบันทึกรายรับหรือรายจ่ายตามปกติ ก่อนกดบันทึก ให้ทำดังนี้:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>กรอกข้อมูลรายการให้ครบ (ประเภท คำอธิบาย จำนวนเงิน ฯลฯ)</li>
            <li>ติ๊กเครื่องหมายถูกที่ช่อง <strong>"บันทึกเป็นรายการที่ใช้บ่อย"</strong></li>
            <li>กดปุ่ม <strong>"บันทึก"</strong> ตามปกติ</li>
        </ol>
        <x-guide-screenshot src="images/guide/transactions/save-as-template.png" alt="ติ๊กบันทึกเป็นรายการที่ใช้บ่อย" caption="ติ๊กช่อง &quot;บันทึกเป็นรายการที่ใช้บ่อย&quot; ก่อนกดบันทึก" />
        <p>ระบบจะบันทึกรายการปกติ พร้อมเก็บเป็น Template ไว้ใช้ครั้งต่อไป</p>
    </x-guide-step>

    <x-guide-step :number="3" title="วิธีเรียกใช้ Template">
        <p>เมื่อต้องการใช้ Template ที่บันทึกไว้:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>เข้าหน้า <strong>"รายรับ-รายจ่าย"</strong></li>
            <li>คลิกปุ่ม <strong>"+ เพิ่มจากรายการที่ใช้บ่อย"</strong></li>
            <li>ระบบจะแสดงรายการ Template ทั้งหมดที่เคยบันทึกไว้</li>
            <li>คลิกเลือก Template ที่ต้องการ</li>
        </ol>
        <x-guide-screenshot src="images/guide/transactions/use-template.png" alt="เลือก Template" caption="คลิก &quot;+ เพิ่มจากรายการที่ใช้บ่อย&quot; แล้วเลือก Template ที่ต้องการ" />
    </x-guide-step>

    <x-guide-step :number="4" title="แก้ไขข้อมูลให้ถูกต้อง">
        <p>หลังเลือก Template ระบบจะกรอกข้อมูลให้อัตโนมัติ แต่ท่านต้อง <strong>ตรวจสอบและแก้ไข</strong> ข้อมูลที่เปลี่ยนแปลง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>วันที่</strong> - เปลี่ยนเป็นวันที่ที่ถูกต้อง</li>
            <li><strong>จำนวนเงิน</strong> - ตรวจสอบและแก้ไขจำนวนเงินให้ตรงกับรายการจริง</li>
            <li><strong>คำอธิบาย</strong> - เพิ่มเติมรายละเอียดถ้าจำเป็น</li>
        </ul>
        <x-guide-tip type="warning">
            อย่าลืมเปลี่ยนวันที่และจำนวนเงินให้ถูกต้องทุกครั้ง เพราะ Template จะดึงข้อมูลจากครั้งที่บันทึกไว้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="กดบันทึก">
        <p>เมื่อตรวจสอบข้อมูลถูกต้องแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong> ตามปกติ ระบบจะบันทึกรายการให้เหมือนบันทึกรายการใหม่</p>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
