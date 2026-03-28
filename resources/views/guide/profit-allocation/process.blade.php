@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        การจัดสรรกำไรประจำปีเป็นขั้นตอนสำคัญของกองทุนหมู่บ้าน
        ต้องทำตามลำดับขั้นตอนให้ถูกต้อง
    </p>

    <x-guide-step :number="1" title="ตรวจสอบงบการเงิน">
        <p>ตรวจสอบรายรับ-รายจ่ายทั้งปีให้ครบถ้วน ดูว่ามีกำไรเท่าไหร่</p>
        <p>ไปที่เมนู <strong>"รายงาน"</strong> เลือกดูงบกำไรขาดทุน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ปิดบัญชีสิ้นปี">
        <p>ทำการปิดบัญชีสิ้นปี เพื่อให้ตัวเลขกำไรถูกต้อง</p>
    </x-guide-step>

    <x-guide-step :number="3" title="จัดประชุมใหญ่">
        <p>จัดประชุมใหญ่สามัญประจำปี เสนอตัวเลขกำไรให้สมาชิกทราบ</p>
    </x-guide-step>

    <x-guide-step :number="4" title="มติจัดสรรกำไร">
        <p>ที่ประชุมมีมติจัดสรรกำไรเป็นหมวดต่างๆ <strong>รวมกันต้องเท่ากับ 100%</strong>:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>เงินสำรอง:</strong> เก็บไว้เป็นทุนสำรองของกองทุน</li>
            <li><strong>เงินสมทบ:</strong> สมทบทุนเพิ่ม</li>
            <li><strong>เฉลี่ยคืน:</strong> คืนให้สมาชิกตามสัดส่วน</li>
            <li><strong>สาธารณประโยชน์:</strong> ใช้เพื่อสาธารณประโยชน์ของหมู่บ้าน</li>
            <li><strong>ค่าตอบแทนกรรมการ:</strong> ค่าตอบแทนคณะกรรมการ</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="5" title="บันทึกในระบบ">
        <p>นำมติจากที่ประชุมมาบันทึกในระบบ (ดูวิธีบันทึกในหน้า "บันทึกจัดสรรกำไร")</p>
    </x-guide-step>

    <x-guide-tip type="important">
        ร้อยละทุกหมวดรวมกัน <strong>ต้องเท่ากับ 100%</strong> พอดี
        ถ้าไม่ถึง 100% ระบบจะไม่ให้บันทึก
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
