@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีปิดบัญชีสิ้นปี ซึ่งเป็นขั้นตอนสำคัญที่ต้องทำทุกสิ้นปีปฏิทิน
        เพื่อสรุปผลกำไร/ขาดทุนของกองทุนประจำปี
    </p>

    <x-guide-step :number="1" title="ตรวจสอบงบการเงินประจำปี">
        <p>ก่อนปิดบัญชีสิ้นปี ต้องตรวจสอบงบการเงินให้เรียบร้อยก่อน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>งบทดลอง</strong> - ตรวจว่ายอดเดบิตรวมเท่ากับเครดิตรวม</li>
            <li><strong>งบกำไรขาดทุน</strong> - ตรวจสอบรายได้และค่าใช้จ่ายทั้งปี</li>
            <li><strong>งบดุล</strong> - ตรวจสอบสินทรัพย์ หนี้สิน และทุน</li>
        </ul>
        <x-guide-tip type="tip">
            ทำหลังจากจัดทำรายงานงบการเงินประจำปีเรียบร้อยแล้ว และตรวจสอบว่ารายการทุกอย่างถูกต้องครบถ้วน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="เข้าระบบ VFGL">
        <p>เข้าระบบบัญชี VFGL ได้ 2 ทาง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ผ่าน <strong>LINE @VF_SUPPORT</strong></li>
            <li>ผ่าน <strong>เว็บไซต์</strong> โดยตรง</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="ไปหน้าประมวลผลสิ้นงวด">
        <p>หลังเข้าสู่ระบบแล้ว ให้ไปที่:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>คลิกเมนู <strong>"รายการบัญชี"</strong></li>
            <li>เลือก <strong>"ประมวลผลสิ้นงวด"</strong></li>
        </ol>
        <x-guide-screenshot src="images/guide/accounting/menu-year-end.png" alt="เมนูประมวลผลสิ้นงวด" caption="ไปที่ &quot;รายการบัญชี&quot; > &quot;ประมวลผลสิ้นงวด&quot;" />
    </x-guide-step>

    <x-guide-step :number="4" title="เลือกชุดบัญชี">
        <p>เลือก <strong>ชุดบัญชี</strong> ที่ต้องการปิดบัญชีสิ้นปี จากรายการที่แสดง</p>
    </x-guide-step>

    <x-guide-step :number="5" title="กำหนดช่วงวันที่">
        <p>กำหนดช่วงวันที่สำหรับปิดบัญชี:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>วันที่เริ่มต้น</strong> - 1 มกราคม ของปีที่ต้องการปิด (เช่น 1 ม.ค. 2568)</li>
            <li><strong>วันที่สิ้นสุด</strong> - 31 ธันวาคม ของปีนั้น (เช่น 31 ธ.ค. 2568)</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="เลือกรหัสบัญชีกำไรสะสม">
        <p>เลือกรหัสบัญชี <strong>33010 กำไร(ขาดทุน)สะสม</strong> เพื่อให้ระบบโอนผลกำไร/ขาดทุนของปีนี้ไปรวมกับยอดสะสม</p>
    </x-guide-step>

    <x-guide-step :number="7" title="กด &quot;คำนวณ&quot;">
        <p>คลิกปุ่ม <strong>"คำนวณ"</strong> ระบบจะคำนวณ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>รายได้ทั้งหมดของปี</li>
            <li>ค่าใช้จ่ายทั้งหมดของปี</li>
            <li>กำไรสุทธิ หรือ ขาดทุนสุทธิ</li>
        </ul>
        <x-guide-screenshot src="images/guide/accounting/year-end-calculate.png" alt="คำนวณผลสิ้นปี" caption="กด &quot;คำนวณ&quot; เพื่อให้ระบบคำนวณกำไร/ขาดทุนสุทธิ" />
    </x-guide-step>

    <x-guide-step :number="8" title="ตรวจสอบรายการปิดบัญชี">
        <p>ระบบจะแสดงรายการปิดบัญชีให้ตรวจสอบ ประกอบด้วย:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>รายการปิดบัญชีรายได้ทั้งหมด</li>
            <li>รายการปิดบัญชีค่าใช้จ่ายทั้งหมด</li>
            <li>รายการโอนกำไร/ขาดทุนสุทธิเข้าบัญชี 33010</li>
        </ul>
        <p>ตรวจสอบว่าตัวเลขถูกต้องก่อนดำเนินการต่อ</p>
    </x-guide-step>

    <x-guide-step :number="9" title="กด &quot;บันทึก&quot;">
        <p>เมื่อตรวจสอบเรียบร้อยแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong> เพื่อปิดบัญชีสิ้นปี</p>
        <x-guide-tip type="important">
            ปิดบัญชีแล้ว ไม่สามารถบันทึกรายการในปีนั้นได้อีก ดังนั้นต้องแน่ใจว่ารายการทุกอย่างถูกต้องครบถ้วนก่อนกดบันทึก
        </x-guide-tip>
        <x-guide-tip type="tip">
            ควรทำการปิดบัญชีสิ้นปีหลังจากจัดทำรายงานงบการเงินประจำปีเรียบร้อยแล้ว และได้รับอนุมัติจากคณะกรรมการกองทุนแล้ว
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
