@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หลังจากที่ประชุมมีมติจัดสรรกำไรแล้ว ให้บันทึกข้อมูลลงในระบบ
    </p>

    <x-guide-step :number="1" title="เปิดเมนูจัดสรรกำไร">
        <p>ไปที่เมนู <strong>"รายรับ-รายจ่าย"</strong> เลือก <strong>"ชุดบัญชี"</strong> แล้วเลือก <strong>"จัดสรรกำไร"</strong></p>
    </x-guide-step>

    <x-guide-step :number="2" title="สร้างรายการใหม่">
        <p>คลิกปุ่ม <strong>"+ สร้าง"</strong></p>
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกปีและกรอกจำนวนเงิน">
        <p>เลือกปีบัญชีที่จะจัดสรร แล้วกรอกจำนวนเงินกำไรทั้งหมด</p>
    </x-guide-step>

    <x-guide-step :number="4" title="กรอกร้อยละแต่ละหมวด">
        <p>กรอกร้อยละของแต่ละหมวด เช่น:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>เงินสำรอง: 20%</li>
            <li>เงินสมทบ: 10%</li>
            <li>เฉลี่ยคืน: 50%</li>
            <li>สาธารณประโยชน์: 10%</li>
            <li>ค่าตอบแทนกรรมการ: 10%</li>
        </ul>
        <p>ระบบจะคำนวณจำนวนเงินของแต่ละหมวดให้อัตโนมัติ</p>
    </x-guide-step>

    <x-guide-step :number="5" title="บันทึก">
        <p>ตรวจสอบตัวเลขให้ถูกต้อง แล้วคลิกปุ่ม <strong>"บันทึก"</strong></p>
    </x-guide-step>

    <x-guide-tip type="warning">
        ร้อยละทุกหมวดรวมกัน <strong>ต้องเท่ากับ 100% พอดี</strong>
        ถ้าไม่ถึง 100% หรือเกิน 100% ระบบจะไม่ให้บันทึก
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
