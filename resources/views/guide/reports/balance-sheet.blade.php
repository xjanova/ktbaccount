@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        งบแสดงฐานะการเงิน (หรือเรียกว่า "งบดุล") คือรายงานที่บอกว่า ณ วันนั้น กองทุนหมู่บ้าน
        <strong>มีทรัพย์สินอะไรบ้าง</strong> (เช่น เงินสด ลูกหนี้เงินกู้)
        <strong>มีหนี้สินอะไรบ้าง</strong> (เช่น เงินฝากสมาชิก)
        และ <strong>ส่วนที่เหลือคือทุน</strong> ของกองทุน
    </p>

    <x-guide-tip type="info">
        สูตรง่ายๆ: <strong>ทรัพย์สิน = หนี้สิน + ทุน</strong><br>
        พูดง่ายๆ คือ "ของที่กองทุนมี = ของที่เป็นหนี้คนอื่น + ของที่เป็นของกองทุนจริงๆ"<br>
        ตัวเลขทั้งสองฝั่งต้องเท่ากันเสมอ ถ้าไม่เท่ากันแสดงว่าบันทึกบัญชีผิดพลาด
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้ารายงาน">
        <p>คลิกเมนู <strong>"รายงาน"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"งบแสดงฐานะการเงิน"</strong></p>
        <x-guide-screenshot src="images/guide/reports/balance-sheet-menu.png" alt="เมนูงบแสดงฐานะการเงิน" caption="เลือกเมนูงบแสดงฐานะการเงิน" />
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกชุดบัญชี">
        <p>เลือกชุดบัญชีที่ต้องการดู เช่น "บัญชีเงินล้าน" หรือเลือก <strong>"ทั้งหมด"</strong> เพื่อดูรวมทุกชุดบัญชี</p>
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกวันที่ (ณ วันที่)">
        <p>เลือก <strong>"ณ วันที่"</strong> ที่ต้องการดูฐานะการเงิน</p>
        <p>ตัวอย่าง: ต้องการดูว่าสิ้นปี กองทุนมีทรัพย์สินเท่าไหร่ → เลือกวันที่ 31 ธันวาคม</p>
        <x-guide-tip type="tip">
            งบดุลดู "ณ วันที่" ไม่ใช่ช่วงวันที่ เพราะเป็นการถ่ายรูปฐานะการเงิน ณ จุดเวลาหนึ่ง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กดดูรายงาน">
        <p>คลิกปุ่ม <strong>"ดูรายงาน"</strong> ระบบจะแสดงงบแสดงฐานะการเงิน</p>
        <x-guide-screenshot src="images/guide/reports/balance-sheet-report.png" alt="ตัวอย่างงบแสดงฐานะการเงิน" caption="ตัวอย่างงบแสดงฐานะการเงิน (งบดุล)" />
    </x-guide-step>

    <x-guide-step :number="5" title="วิธีอ่านรายงาน">
        <p>งบแสดงฐานะการเงินแบ่งเป็น 3 ส่วน:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ส่วนบน - ทรัพย์สิน:</strong> ของที่กองทุนมี เช่น เงินสดในมือ เงินฝากธนาคาร ลูกหนี้เงินกู้</li>
            <li><strong>ส่วนกลาง - หนี้สิน:</strong> ของที่กองทุนเป็นหนี้คนอื่น เช่น เงินรับฝากจากสมาชิก</li>
            <li><strong>ส่วนล่าง - ทุน:</strong> ส่วนที่เป็นของกองทุนจริงๆ เช่น ทุนเรือนหุ้น กำไรสะสม</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="ดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> เพื่อบันทึกรายงานเป็นไฟล์ PDF สำหรับพิมพ์หรือส่งให้ผู้ตรวจสอบ</p>
    </x-guide-step>

    <x-guide-tip type="important">
        ยอดรวมทรัพย์สินต้องเท่ากับยอดรวมหนี้สินบวกทุน ถ้าไม่เท่ากัน ให้ตรวจสอบรายการบันทึกบัญชีว่ามีรายการใดผิดพลาด
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
