@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        งบกำไรขาดทุน เป็นรายงานที่แสดง <strong>ผลการดำเนินงาน</strong> ของกองทุนหมู่บ้าน ว่ามี<strong>รายได้</strong>เท่าไหร่ มี<strong>ค่าใช้จ่าย</strong>เท่าไหร่ และสุทธิแล้วกองทุน<strong>กำไรหรือขาดทุน</strong>เท่าไหร่ ในช่วงเวลาที่กำหนด
    </p>

    <x-guide-tip type="info">
        พูดง่ายๆ คือ "เดือนนี้/ปีนี้ กองทุนได้เงินเข้ามาเท่าไหร่ จ่ายออกไปเท่าไหร่ เหลือกำไรหรือขาดทุนเท่าไหร่"
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้ารายงาน">
        <p>คลิกเมนู <strong>"รายงาน"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"งบกำไรขาดทุน"</strong></p>
        <x-guide-screenshot src="images/guide/reports/income-statement-menu.png" alt="เมนูงบกำไรขาดทุน" caption="เลือกเมนูงบกำไรขาดทุน" />
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกชุดบัญชี">
        <p>เลือกชุดบัญชีที่ต้องการ เช่น "บัญชีเงินล้าน" หรือเลือก <strong>"ทั้งหมด"</strong> เพื่อดูรวมทุกชุดบัญชี</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กำหนดช่วงวันที่">
        <p>เลือก <strong>"จากวันที่"</strong> และ <strong>"ถึงวันที่"</strong> ตามที่ต้องการ</p>
        <p>ตัวอย่าง: ดูผลประกอบการทั้งปี → จากวันที่ 1 ม.ค. 2567 ถึงวันที่ 31 ธ.ค. 2567</p>
    </x-guide-step>

    <x-guide-step :number="4" title="กดดูรายงาน">
        <p>คลิกปุ่ม <strong>"ดูรายงาน"</strong> ระบบจะแสดงงบกำไรขาดทุน</p>
        <x-guide-screenshot src="images/guide/reports/income-statement-report.png" alt="ตัวอย่างงบกำไรขาดทุน" caption="ตัวอย่างงบกำไรขาดทุน" />
    </x-guide-step>

    <x-guide-step :number="5" title="วิธีอ่านรายงาน">
        <p>งบกำไรขาดทุนแบ่งเป็น 3 ส่วน:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ส่วนบน - รายได้:</strong> เงินที่กองทุนได้รับ เช่น ดอกเบี้ยเงินกู้ ค่าธรรมเนียม</li>
            <li><strong>ส่วนกลาง - ค่าใช้จ่าย:</strong> เงินที่จ่ายออกไป เช่น ค่าตอบแทน ค่าเดินทาง</li>
            <li><strong>บรรทัดสุดท้าย - กำไร/ขาดทุนสุทธิ:</strong> รายได้ลบค่าใช้จ่าย = ผลลัพธ์</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="tip">
        ตัวเลข <strong>"กำไรสุทธิ"</strong> จากงบนี้ ใช้เป็นฐานในการจัดสรรกำไรประจำปีตามมติที่ประชุม
    </x-guide-tip>

    <x-guide-step :number="6" title="ดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> เพื่อบันทึกรายงานเป็นไฟล์ PDF สำหรับพิมพ์หรือส่งให้ผู้ตรวจสอบ</p>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
