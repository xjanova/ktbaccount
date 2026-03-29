@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        งบกำไรขาดทุน เป็นรายงานที่แสดง <strong>ผลการดำเนินงาน</strong> ของกองทุนหมู่บ้าน ว่ามี<strong>รายได้</strong>เท่าไหร่ มี<strong>ค่าใช้จ่าย</strong>เท่าไหร่ และสุทธิแล้วกองทุน<strong>กำไรหรือขาดทุน</strong>เท่าไหร่ ในช่วงเวลาที่กำหนด
    </p>

    <x-guide-tip type="info">
        พูดง่ายๆ คือ "เดือนนี้/ปีนี้ กองทุนได้เงินเข้ามาเท่าไหร่ จ่ายออกไปเท่าไหร่ เหลือกำไรหรือขาดทุนเท่าไหร่"
        เป็นรายงานที่ใช้บ่อยที่สุดในการประชุมคณะกรรมการ
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้ารายงาน">
        <p>คลิกเมนู <strong>"รายงาน"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"งบกำไรขาดทุน"</strong></p>
        <x-guide-screenshot src="images/guide/reports/income-statement-menu.png" alt="เมนูงบกำไรขาดทุน" caption="เลือกเมนูงบกำไรขาดทุน" />
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกชุดบัญชี">
        <p>เลือกชุดบัญชีที่ต้องการ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เลือกชุดเดียว:</strong> เช่น "บัญชีเงินล้าน" เพื่อดูผลการดำเนินงานเฉพาะก้อนเงินนั้น</li>
            <li><strong>เลือก "ทั้งหมด":</strong> เพื่อดูผลการดำเนินงานรวมทุกชุดบัญชี</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="กำหนดช่วงวันที่">
        <p>เลือก <strong>"จากวันที่"</strong> และ <strong>"ถึงวันที่"</strong> ตามที่ต้องการ ตัวอย่าง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ดูทั้งปี:</strong> 1 ม.ค. 2568 ถึง 31 ธ.ค. 2568</li>
            <li><strong>ดูรายเดือน:</strong> 1 มี.ค. 2568 ถึง 31 มี.ค. 2568</li>
            <li><strong>ดูครึ่งปีแรก:</strong> 1 ม.ค. 2568 ถึง 30 มิ.ย. 2568</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="กดดูรายงาน">
        <p>คลิกปุ่ม <strong>"ดูรายงาน"</strong> ระบบจะแสดงงบกำไรขาดทุน</p>
        <x-guide-screenshot src="images/guide/reports/income-statement-report.png" alt="ตัวอย่างงบกำไรขาดทุน" caption="ตัวอย่างงบกำไรขาดทุน แสดงรายได้ ค่าใช้จ่าย และกำไรสุทธิ" />
    </x-guide-step>

    <x-guide-step :number="5" title="วิธีอ่านรายงาน">
        <p>งบกำไรขาดทุนแบ่งเป็น 3 ส่วน:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ส่วนที่ 1: รายได้ (ส่วนบน)</h4>
        <p>เงินที่กองทุนได้รับเข้ามา ได้แก่:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>ดอกเบี้ยรับจากเงินให้กู้</li>
            <li>ค่าธรรมเนียมสมาชิก</li>
            <li>ดอกเบี้ยรับจากเงินฝากธนาคาร</li>
            <li>รายได้อื่นๆ</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ส่วนที่ 2: ค่าใช้จ่าย (ส่วนกลาง)</h4>
        <p>เงินที่กองทุนจ่ายออกไป ได้แก่:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>ค่าตอบแทนคณะกรรมการ</li>
            <li>ค่าเดินทาง</li>
            <li>ค่าสาธารณูปโภค</li>
            <li>ดอกเบี้ยจ่ายเงินฝากสมาชิก</li>
            <li>ค่าใช้จ่ายอื่นๆ</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ส่วนที่ 3: กำไร/ขาดทุนสุทธิ (บรรทัดสุดท้าย)</h4>
        <p><strong>กำไรสุทธิ = รายได้รวม - ค่าใช้จ่ายรวม</strong></p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ตัวเลขเป็นบวก (สีเขียว):</strong> กองทุนมีกำไร 👍</li>
            <li><strong>ตัวเลขเป็นลบ (สีแดง):</strong> กองทุนขาดทุน ต้องตรวจสอบ</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="ใช้ข้อมูลงบกำไรขาดทุนอย่างไร?">
        <p>ข้อมูลจากรายงานนี้ใช้ได้หลายอย่าง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ประชุมคณะกรรมการ:</strong> แสดงผลการดำเนินงานให้ที่ประชุมทราบ</li>
            <li><strong>จัดสรรกำไรประจำปี:</strong> ตัวเลข "กำไรสุทธิ" ใช้เป็นฐานในการจัดสรรกำไรตามมติที่ประชุม</li>
            <li><strong>วางแผน:</strong> วิเคราะห์ว่ารายได้หลักมาจากไหน ค่าใช้จ่ายตัวไหนสูง</li>
            <li><strong>รายงาน สทบ.:</strong> ส่งรายงานให้สำนักงานกองทุนหมู่บ้านฯ</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="7" title="ดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> เพื่อบันทึกรายงานเป็นไฟล์ PDF</p>
        <p>ไฟล์ PDF จะมีหัวกระดาษแสดงชื่อกองทุน ชุดบัญชี และช่วงวันที่ เหมาะสำหรับพิมพ์หรือส่งให้ผู้ตรวจสอบ</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        แนะนำให้ดูงบกำไรขาดทุน <strong>ทุกเดือน</strong> เพื่อติดตามผลการดำเนินงานอย่างต่อเนื่อง
        ไม่ต้องรอสิ้นปีถึงจะดู จะได้เห็นแนวโน้มและแก้ไขได้ทัน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
