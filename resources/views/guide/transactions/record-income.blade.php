@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีบันทึกรายรับเข้าสู่ระบบ เช่น ดอกเบี้ยเงินกู้ ค่าธรรมเนียม หรือเงินสนับสนุนต่างๆ
        ทำตามขั้นตอนด้านล่างได้เลย
    </p>

    <x-guide-step :number="1" title="เข้าหน้ารายรับ-รายจ่าย">
        <p>คลิกที่เมนู <strong>"รายรับ-รายจ่าย"</strong> ในแถบด้านข้างซ้ายมือ ระบบจะพาท่านเข้าสู่หน้ารายการรายรับ-รายจ่ายทั้งหมด</p>
        <x-guide-screenshot src="images/guide/transactions/menu-transaction.png" alt="เมนูรายรับ-รายจ่าย" caption="คลิกเมนู &quot;รายรับ-รายจ่าย&quot; ในแถบด้านข้าง" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่ม &quot;+ เพิ่มรายการ&quot;">
        <p>ที่มุมขวาบนของหน้า จะเห็นปุ่ม <strong>"+ เพิ่มรายการ"</strong> ให้คลิกที่ปุ่มนี้เพื่อเริ่มบันทึกรายการใหม่</p>
        <x-guide-screenshot src="images/guide/transactions/btn-add-transaction.png" alt="ปุ่มเพิ่มรายการ" caption="คลิกปุ่ม &quot;+ เพิ่มรายการ&quot; เพื่อเริ่มบันทึก" />
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกแถบ &quot;รายรับ&quot;">
        <p>ระบบจะเปิดหน้าบันทึกรายการขึ้นมา ที่ด้านบนจะมี 2 แถบ ให้เลือกแถบ <strong>"รายรับ"</strong> (สีเขียว)</p>
        <x-guide-screenshot src="images/guide/transactions/tab-income.png" alt="แถบรายรับ" caption="เลือกแถบ &quot;รายรับ&quot; สีเขียว" />
    </x-guide-step>

    <x-guide-step :number="4" title="เลือกลงบัญชี">
        <p>เลือกว่าจะลงบัญชีเป็น <strong>"เงินสด"</strong> หรือ <strong>"เงินฝากธนาคาร"</strong></p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เงินสด</strong> - เลือกเมื่อได้รับเงินเป็นธนบัตรหรือเหรียญ</li>
            <li><strong>เงินฝากธนาคาร</strong> - เลือกเมื่อเงินโอนเข้าบัญชีธนาคาร แล้วเลือกบัญชีธนาคารที่รับเงินเข้า</li>
        </ul>
        <x-guide-tip type="tip">
            เงินสด = รับเงินเป็นธนบัตรหรือเหรียญโดยตรง, เงินฝาก = มีคนโอนเงินเข้าบัญชีธนาคารของกองทุน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="เลือกประเภทรายรับ">
        <p>คลิกช่อง <strong>"ประเภทรายรับ"</strong> แล้วเลือกประเภทที่ตรงกับรายรับที่จะบันทึก:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>รายได้ดอกเบี้ยเงินกู้</strong> - ดอกเบี้ยที่สมาชิกจ่ายเมื่อกู้เงิน</li>
            <li><strong>ค่าธรรมเนียมสมาชิก</strong> - ค่าธรรมเนียมแรกเข้าหรือรายปี</li>
            <li><strong>รายได้ดอกเบี้ยเงินฝาก/เงินลงทุน</strong> - ดอกเบี้ยที่กองทุนได้รับจากธนาคาร</li>
            <li><strong>เงินทุนสนับสนุนจากรัฐบาล</strong> - เงินที่รัฐบาลจัดสรรให้</li>
            <li><strong>รายได้อื่น</strong> - รายรับอื่นๆ ที่ไม่เข้าหมวดด้านบน</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/income-type-options.png" alt="ตัวเลือกประเภทรายรับ" caption="เลือกประเภทรายรับที่ตรงกับรายการ" />
    </x-guide-step>

    <x-guide-step :number="6" title="เลือกวันที่ที่ได้รับเงิน">
        <p>คลิกที่ช่อง <strong>"วันที่"</strong> แล้วเลือกวันที่ที่ได้รับเงินจริง จากปฏิทินที่แสดงขึ้นมา</p>
        <x-guide-screenshot src="images/guide/transactions/date-picker.png" alt="เลือกวันที่" caption="คลิกเลือกวันที่จากปฏิทิน" />
    </x-guide-step>

    <x-guide-step :number="7" title="ใส่จำนวนเงิน">
        <p>พิมพ์จำนวนเงินที่ได้รับในช่อง <strong>"จำนวนเงิน (บาท)"</strong></p>
        <x-guide-tip type="warning">
            ใส่ตัวเลขเท่านั้น เช่น 5000.00 ไม่ต้องใส่เครื่องหมายคอมมาหรือสัญลักษณ์บาท
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="8" title="ใส่รายละเอียด/คำอธิบาย">
        <p>พิมพ์รายละเอียดของรายรับในช่อง <strong>"คำอธิบาย"</strong> เพื่อให้จำได้ว่ารายการนี้คืออะไร</p>
        <x-guide-tip type="tip">
            ควรเขียนให้ละเอียด เช่น "ดอกเบี้ยเงินฝากจากธนาคารออมสิน สิ้นปี 2567" จะช่วยให้ค้นหาและตรวจสอบได้ง่ายในภายหลัง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="9" title="เลือกผู้จ่ายเงิน (ถ้ามี)">
        <p>ถ้ารายรับนี้มีคนจ่ายเงินให้ ให้เลือกว่าผู้จ่ายเป็นใคร:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>สมาชิก</strong> - ค้นหาชื่อจากรายชื่อสมาชิกของกองทุน</li>
            <li><strong>ไม่เป็นสมาชิก</strong> - พิมพ์ชื่อผู้จ่ายเงินลงไปโดยตรง</li>
            <li><strong>อื่นๆ (นิติบุคคล)</strong> - เช่น หน่วยงานราชการ ธนาคาร บริษัท</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="10" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลครบแล้ว ให้เลือกกดปุ่มใดปุ่มหนึ่ง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>"บันทึก"</strong> - บันทึกรายการแล้วกลับไปหน้ารายการ</li>
            <li><strong>"บันทึกและเพิ่มรายการต่อไป"</strong> - บันทึกแล้วเปิดหน้าบันทึกรายการใหม่ทันที (สำหรับกรณีที่ต้องบันทึกหลายรายการ)</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/btn-save-income.png" alt="ปุ่มบันทึก" caption="เลือกกด &quot;บันทึก&quot; หรือ &quot;บันทึกและเพิ่มรายการต่อไป&quot;" />
        <x-guide-tip type="important">
            ระบบจะบันทึกบัญชีให้อัตโนมัติ ไม่ต้องไปบันทึกซ้ำในระบบบัญชีอีก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="11" title="ตรวจสอบรายการที่บันทึกแล้ว">
        <p>หลังบันทึกเรียบร้อย ระบบจะแสดงรายการที่บันทึกสำเร็จในตารางรายรับ-รายจ่าย ให้ตรวจสอบว่าข้อมูลถูกต้อง</p>
        <x-guide-screenshot src="images/guide/transactions/income-saved-success.png" alt="รายการที่บันทึกสำเร็จ" caption="รายการรายรับที่บันทึกเรียบร้อยแล้ว" />
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
