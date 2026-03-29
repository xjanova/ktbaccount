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
        ตัวเลขทั้งสองฝั่งต้องเท่ากันเสมอ (เรียกว่า "งบดุล" หรือ Balance) ถ้าไม่เท่ากันแสดงว่าบันทึกบัญชีผิดพลาด
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดหน้ารายงาน">
        <p>คลิกเมนู <strong>"รายงาน"</strong> ในแถบด้านข้าง แล้วเลือก <strong>"งบแสดงฐานะการเงิน"</strong></p>
        <x-guide-screenshot src="images/guide/reports/balance-sheet-menu.png" alt="เมนูงบแสดงฐานะการเงิน" caption="เลือกเมนูงบแสดงฐานะการเงิน" />
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกชุดบัญชี">
        <p>เลือกชุดบัญชีที่ต้องการดู เช่น "บัญชีเงินล้าน" หรือเลือก <strong>"ทั้งหมด"</strong> เพื่อดูรวมทุกชุดบัญชี</p>
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกวันที่ (ณ วันที่)">
        <p>เลือก <strong>"ณ วันที่"</strong> ที่ต้องการดูฐานะการเงิน ตัวอย่าง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>สิ้นปี:</strong> 31 ธันวาคม 2568 — ดูว่าสิ้นปี กองทุนมีอะไรบ้าง</li>
            <li><strong>สิ้นเดือน:</strong> 31 มีนาคม 2568 — ดูฐานะ ณ สิ้นเดือน</li>
            <li><strong>วันนี้:</strong> วันที่ปัจจุบัน — ดูฐานะล่าสุด</li>
        </ul>
        <x-guide-tip type="tip">
            งบดุลดู <strong>"ณ วันที่"</strong> ไม่ใช่ "ช่วงวันที่" เพราะเป็นการถ่ายรูปฐานะการเงิน ณ จุดเวลาหนึ่ง
            ต่างจากงบกำไรขาดทุนที่ดู "ตั้งแต่วันที่...ถึงวันที่..."
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กดดูรายงาน">
        <p>คลิกปุ่ม <strong>"ดูรายงาน"</strong> ระบบจะแสดงงบแสดงฐานะการเงิน</p>
        <x-guide-screenshot src="images/guide/reports/balance-sheet-report.png" alt="ตัวอย่างงบแสดงฐานะการเงิน" caption="ตัวอย่างงบแสดงฐานะการเงิน (งบดุล)" />
    </x-guide-step>

    <x-guide-step :number="5" title="วิธีอ่านรายงาน">
        <p>งบแสดงฐานะการเงินแบ่งเป็น 3 ส่วน:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ส่วนที่ 1: ทรัพย์สิน (ฝั่งซ้าย/ส่วนบน)</h4>
        <p>ของที่กองทุนมี ตัวอย่าง:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li><strong>เงินสดในมือ:</strong> เงินสดที่เก็บอยู่ที่กองทุน</li>
            <li><strong>เงินฝากธนาคาร:</strong> ยอดเงินที่ฝากอยู่ในบัญชีธนาคาร</li>
            <li><strong>ลูกหนี้เงินกู้:</strong> เงินกู้ที่สมาชิกยังไม่ชำระคืน (เป็นสิทธิ์ที่กองทุนจะได้รับเงินคืน)</li>
            <li><strong>ดอกเบี้ยค้างรับ:</strong> ดอกเบี้ยที่ยังไม่ได้รับแต่มีสิทธิ์</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ส่วนที่ 2: หนี้สิน (ฝั่งขวา/ส่วนกลาง)</h4>
        <p>สิ่งที่กองทุนเป็นหนี้คนอื่น ตัวอย่าง:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li><strong>เงินรับฝากจากสมาชิก:</strong> เงินที่สมาชิกฝากไว้กับกองทุน (ต้องคืนเมื่อสมาชิกถอน)</li>
            <li><strong>ดอกเบี้ยค้างจ่าย:</strong> ดอกเบี้ยเงินฝากที่ยังไม่ได้จ่ายให้สมาชิก</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ส่วนที่ 3: ทุน (ส่วนล่าง)</h4>
        <p>ส่วนที่เป็นของกองทุนจริงๆ ตัวอย่าง:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li><strong>ทุนจากรัฐบาล:</strong> เงินล้านที่ได้รับจากรัฐบาล</li>
            <li><strong>ทุนเรือนหุ้น:</strong> หุ้นที่สมาชิกซื้อ</li>
            <li><strong>กำไรสะสม:</strong> กำไรที่สะสมมาจากปีก่อนๆ</li>
            <li><strong>กำไรสุทธิปีปัจจุบัน:</strong> กำไรของปีนี้ (ยอดเดียวกับงบกำไรขาดทุน)</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="ตรวจสอบความถูกต้อง">
        <p>ดูบรรทัดสรุปด้านล่าง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ยอดรวมทรัพย์สิน</strong> ต้องเท่ากับ <strong>ยอดรวมหนี้สิน + ทุน</strong></li>
            <li>ถ้าเท่ากัน = บัญชีถูกต้อง ✅</li>
            <li>ถ้าไม่เท่ากัน = มีรายการบันทึกผิด ต้องตรวจสอบ ❌</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="7" title="ดาวน์โหลด PDF">
        <p>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> เพื่อบันทึกรายงานเป็นไฟล์ PDF สำหรับพิมพ์หรือส่งให้ผู้ตรวจสอบ</p>
    </x-guide-step>

    <x-guide-tip type="important">
        งบดุลเป็นรายงานที่ผู้ตรวจสอบบัญชีดูเป็นอันดับแรก ควรตรวจสอบว่ายอดทั้งสองฝั่งเท่ากัน
        ก่อนนำส่งรายงานทุกครั้ง
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
