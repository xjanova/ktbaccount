@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีรับชำระเงินผ่อนสินเชื่อจากสมาชิก
        ทำตามขั้นตอนด้านล่างได้เลย
    </p>

    <x-guide-step :number="1" title="เปิดสัญญาสินเชื่อ">
        <p>เข้าเมนู <strong>"สินเชื่อ"</strong> แล้วคลิกเลือกสัญญาที่ต้องการรับชำระเงิน</p>
        <x-guide-screenshot src="images/guide/loans/select-loan-contract.png" alt="เลือกสัญญาสินเชื่อ" caption="คลิกเลือกสัญญาที่ต้องการรับชำระ" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่ม &quot;รับชำระ&quot;">
        <p>ในหน้ารายละเอียดสัญญา ให้คลิกปุ่ม <strong>"รับชำระ"</strong> เพื่อเริ่มบันทึกการชำระเงิน</p>
        <x-guide-screenshot src="images/guide/loans/btn-receive-payment.png" alt="ปุ่มรับชำระ" caption="คลิกปุ่ม &quot;รับชำระ&quot; เพื่อเริ่มบันทึก" />
    </x-guide-step>

    <x-guide-step :number="3" title="ระบบแสดงงวดที่ค้างชำระ">
        <p>ระบบจะแสดงรายการงวดที่ค้างชำระทั้งหมดให้โดยอัตโนมัติ พร้อมรายละเอียด:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>งวดที่</strong> - ลำดับงวดที่ต้องชำระ</li>
            <li><strong>เงินต้น</strong> - จำนวนเงินต้นของงวดนั้น</li>
            <li><strong>ดอกเบี้ย</strong> - จำนวนดอกเบี้ยของงวดนั้น</li>
            <li><strong>รวมต้องชำระ</strong> - ยอดรวมที่ต้องจ่ายในงวดนั้น</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/overdue-installments.png" alt="งวดค้างชำระ" caption="ระบบแสดงงวดที่ค้างชำระพร้อมยอดเงิน" />
    </x-guide-step>

    <x-guide-step :number="4" title="ใส่จำนวนเงินที่รับชำระ">
        <p>ใส่จำนวนเงินที่สมาชิกจ่ายมาจริงในช่อง <strong>"จำนวนเงิน"</strong></p>
        <x-guide-tip type="tip">
            สมาชิกสามารถจ่ายมากกว่า 1 งวดในครั้งเดียวได้ ระบบจะตัดยอดให้อัตโนมัติ
            เช่น ค้าง 3 งวด จ่ายมาทีเดียว 3 งวดก็ได้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="เลือกช่องทางรับเงิน">
        <p>เลือกว่ารับเงินจากสมาชิกด้วยช่องทางไหน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เงินสด</strong> - สมาชิกจ่ายเป็นเงินสดโดยตรง</li>
            <li><strong>เงินฝากธนาคาร</strong> - สมาชิกโอนเข้าบัญชีธนาคารของกองทุน แล้วเลือกบัญชีที่รับโอน</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/payment-channel.png" alt="เลือกช่องทางรับเงิน" caption="เลือกรับเป็นเงินสดหรือผ่านธนาคาร" />
    </x-guide-step>

    <x-guide-step :number="6" title="บันทึกการรับชำระ">
        <p>ตรวจสอบข้อมูลให้ถูกต้อง แล้วกดปุ่ม <strong>"บันทึก"</strong></p>
        <x-guide-screenshot src="images/guide/loans/btn-save-payment.png" alt="ปุ่มบันทึก" caption="ตรวจสอบแล้วกดบันทึก" />
        <x-guide-tip type="important">
            เมื่อบันทึกแล้ว ระบบจะอัพเดทสถานะงวดเป็น "ชำระแล้ว" และบันทึกบัญชีให้อัตโนมัติ
            ไม่ต้องไปลงบัญชีเพิ่มเอง
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
