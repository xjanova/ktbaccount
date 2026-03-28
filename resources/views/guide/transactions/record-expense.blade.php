@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีบันทึกรายจ่ายเข้าสู่ระบบ เช่น ค่าตอบแทนคณะกรรมการ ค่าสาธารณูปโภค หรือค่าใช้จ่ายอื่นๆ ของกองทุน
    </p>

    <x-guide-step :number="1" title="เข้าหน้ารายรับ-รายจ่าย">
        <p>คลิกที่เมนู <strong>"รายรับ-รายจ่าย"</strong> ในแถบด้านข้างซ้ายมือ</p>
        <x-guide-screenshot src="images/guide/transactions/menu-transaction.png" alt="เมนูรายรับ-รายจ่าย" caption="คลิกเมนู &quot;รายรับ-รายจ่าย&quot; ในแถบด้านข้าง" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่ม &quot;+ เพิ่มรายการ&quot;">
        <p>คลิกปุ่ม <strong>"+ เพิ่มรายการ"</strong> ที่มุมขวาบนของหน้า</p>
        <x-guide-screenshot src="images/guide/transactions/btn-add-transaction.png" alt="ปุ่มเพิ่มรายการ" caption="คลิกปุ่ม &quot;+ เพิ่มรายการ&quot; เพื่อเริ่มบันทึก" />
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกแถบ &quot;รายจ่าย&quot;">
        <p>ที่ด้านบนของหน้าบันทึกรายการ ให้คลิกเลือกแถบ <strong>"รายจ่าย"</strong> (สีแดง)</p>
        <x-guide-screenshot src="images/guide/transactions/tab-expense.png" alt="แถบรายจ่าย" caption="เลือกแถบ &quot;รายจ่าย&quot; สีแดง" />
    </x-guide-step>

    <x-guide-step :number="4" title="เลือกลงบัญชี">
        <p>เลือกว่าจะจ่ายเงินจากบัญชีไหน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>เงินสด</strong> - เลือกเมื่อจ่ายเงินเป็นธนบัตรหรือเหรียญ</li>
            <li><strong>เงินฝากธนาคาร</strong> - เลือกเมื่อโอนเงินจากบัญชีธนาคาร แล้วเลือกบัญชีที่จ่ายออก</li>
        </ul>
        <x-guide-tip type="tip">
            เงินสด = จ่ายเงินเป็นธนบัตรหรือเหรียญ, เงินฝาก = โอนเงินออกจากบัญชีธนาคารของกองทุน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="เลือกประเภทรายจ่าย">
        <p>คลิกช่อง <strong>"ประเภทรายจ่าย"</strong> แล้วเลือกประเภทที่ตรงกับรายจ่ายที่จะบันทึก:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ค่าตอบแทนคณะกรรมการ</strong> - เงินที่จ่ายให้กรรมการกองทุน</li>
            <li><strong>ค่าเดินทาง</strong> - ค่ารถ ค่าน้ำมัน ค่าเดินทางไปติดต่อราชการ</li>
            <li><strong>ค่าสาธารณูปโภค</strong> - ค่าน้ำ ค่าไฟ ค่าโทรศัพท์ ค่าอินเทอร์เน็ต</li>
            <li><strong>ค่าใช้จ่ายในการประชุม</strong> - ค่าอาหาร ค่าเครื่องดื่ม ค่าสถานที่ประชุม</li>
            <li><strong>ค่าอบรม/สัมมนา</strong> - ค่าลงทะเบียนอบรม ค่าเดินทางไปอบรม</li>
            <li><strong>ค่าเครื่องเขียน/วัสดุสำนักงาน</strong> - ค่ากระดาษ ปากกา หมึกพิมพ์</li>
            <li><strong>ดอกเบี้ยจ่าย</strong> - ดอกเบี้ยที่กองทุนต้องจ่ายให้สมาชิกผู้ฝากเงิน</li>
            <li><strong>ค่าใช้จ่ายอื่น</strong> - รายจ่ายอื่นๆ ที่ไม่เข้าหมวดด้านบน</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/expense-type-options.png" alt="ตัวเลือกประเภทรายจ่าย" caption="เลือกประเภทรายจ่ายที่ตรงกับรายการ" />
    </x-guide-step>

    <x-guide-step :number="6" title="เลือกวันที่ที่จ่ายเงิน">
        <p>คลิกที่ช่อง <strong>"วันที่"</strong> แล้วเลือกวันที่ที่จ่ายเงินจริง จากปฏิทินที่แสดงขึ้นมา</p>
        <x-guide-screenshot src="images/guide/transactions/date-picker.png" alt="เลือกวันที่" caption="คลิกเลือกวันที่จากปฏิทิน" />
    </x-guide-step>

    <x-guide-step :number="7" title="ใส่จำนวนเงิน">
        <p>พิมพ์จำนวนเงินที่จ่ายในช่อง <strong>"จำนวนเงิน (บาท)"</strong></p>
        <x-guide-tip type="warning">
            ตรวจสอบจำนวนเงินให้ถูกต้องก่อนกดบันทึก ใส่ตัวเลขเท่านั้น เช่น 1500.00 ไม่ต้องใส่เครื่องหมายคอมมาหรือสัญลักษณ์บาท
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="8" title="ใส่รายละเอียด/คำอธิบาย">
        <p>พิมพ์รายละเอียดของรายจ่ายในช่อง <strong>"คำอธิบาย"</strong> เพื่อให้จำได้ว่าจ่ายค่าอะไร</p>
        <x-guide-tip type="tip">
            ควรเขียนให้ละเอียด เช่น "ค่าไฟฟ้าสำนักงานกองทุน ประจำเดือนมกราคม 2568" จะช่วยให้ตรวจสอบได้ง่ายในภายหลัง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="9" title="เลือกผู้รับเงิน (ถ้ามี)">
        <p>ถ้ารายจ่ายนี้จ่ายให้ใคร ให้เลือก <strong>"จ่ายเงินให้"</strong>:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>สมาชิก</strong> - ค้นหาชื่อจากรายชื่อสมาชิกของกองทุน</li>
            <li><strong>ไม่เป็นสมาชิก</strong> - พิมพ์ชื่อผู้รับเงินลงไปโดยตรง</li>
            <li><strong>อื่นๆ (นิติบุคคล)</strong> - เช่น การไฟฟ้า การประปา ร้านค้า</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="10" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลครบแล้ว ให้เลือกกดปุ่มใดปุ่มหนึ่ง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>"บันทึก"</strong> - บันทึกรายการแล้วกลับไปหน้ารายการ</li>
            <li><strong>"บันทึกและเพิ่มรายการต่อไป"</strong> - บันทึกแล้วเปิดหน้าบันทึกรายการใหม่ทันที</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/btn-save-expense.png" alt="ปุ่มบันทึก" caption="เลือกกด &quot;บันทึก&quot; หรือ &quot;บันทึกและเพิ่มรายการต่อไป&quot;" />
        <x-guide-tip type="important">
            ระบบจะบันทึกบัญชีให้อัตโนมัติ ไม่ต้องไปบันทึกซ้ำในระบบบัญชีอีก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="11" title="ตรวจสอบรายการที่บันทึกแล้ว">
        <p>หลังบันทึกเรียบร้อย ระบบจะแสดงรายการที่บันทึกสำเร็จในตารางรายรับ-รายจ่าย ให้ตรวจสอบว่าข้อมูลถูกต้อง</p>
        <x-guide-screenshot src="images/guide/transactions/expense-saved-success.png" alt="รายการที่บันทึกสำเร็จ" caption="รายการรายจ่ายที่บันทึกเรียบร้อยแล้ว" />
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
