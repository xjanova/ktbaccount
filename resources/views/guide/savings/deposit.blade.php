@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกนำเงินมาฝากที่กองทุน ผู้ดูแลระบบต้องบันทึกการฝากเงินในระบบ
        ยอดเงินในบัญชีจะเพิ่มขึ้นอัตโนมัติ ระบบจะบันทึกบัญชีให้เสร็จ และส่งแจ้งเตือน LINE ให้สมาชิกด้วย
        ทำตามขั้นตอนด้านล่างได้เลย
    </p>

    <x-guide-step :number="1" title="เข้าเมนู &quot;เงินฝาก&quot;">
        <p>คลิกที่เมนู <strong>"เงินฝาก"</strong> ในแถบด้านซ้ายมือ (อยู่ในหมวด "บริการการเงิน")</p>
        <p>ระบบจะแสดงรายการบัญชีเงินฝากทั้งหมดของกองทุน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ค้นหาบัญชีของสมาชิก">
        <p>ที่หน้ารายการบัญชี ให้ค้นหาบัญชีของสมาชิกที่ต้องการฝากเงิน</p>
        <p>วิธีค้นหา:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>พิมพ์ชื่อสมาชิก</strong> ในช่องค้นหา เช่น "สมศรี"</li>
            <li><strong>พิมพ์เลขบัญชี</strong> เช่น "SAV-000001"</li>
        </ul>
        <p class="mt-2">ระบบจะกรองแสดงเฉพาะบัญชีที่ตรงกับที่ค้นหา</p>
    </x-guide-step>

    <x-guide-step :number="3" title="คลิกเข้าดูบัญชี">
        <p>คลิกที่แถวของบัญชีที่ต้องการ ระบบจะเปิดหน้ารายละเอียดบัญชี</p>
        <p>ที่หน้านี้จะแสดงข้อมูลสำคัญ:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>เลขบัญชี</strong> - เช่น SAV-000001</li>
            <li><strong>ชื่อเจ้าของบัญชี</strong> - ชื่อสมาชิก</li>
            <li><strong>ยอดคงเหลือ</strong> - จำนวนเงินที่มีในบัญชีตอนนี้ (ตัวเลขใหญ่ อ่านง่าย)</li>
        </ul>
        <p class="mt-2">ตรวจสอบว่าเป็นบัญชีของสมาชิกที่ถูกต้อง</p>
    </x-guide-step>

    <x-guide-step :number="4" title="คลิกปุ่ม &quot;ฝากเงิน&quot;">
        <p>ที่หน้ารายละเอียดบัญชี ให้คลิกปุ่ม <strong>"ฝากเงิน"</strong> (ปุ่มสีเขียว)</p>
        <p>ระบบจะเปิดแบบฟอร์มฝากเงินขึ้นมา</p>
        <x-guide-screenshot src="images/guide/savings/btn-deposit.png" alt="ปุ่มฝากเงิน" caption="คลิกปุ่ม &quot;ฝากเงิน&quot; สีเขียว" />
    </x-guide-step>

    <x-guide-step :number="5" title="กรอกข้อมูลการฝากเงิน">
        <p>กรอกข้อมูลในแบบฟอร์มให้ครบทุกช่อง:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ช่อง "จำนวนเงิน"</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>ใส่จำนวนเงินที่สมาชิกนำมาฝาก เป็นตัวเลข</li>
            <li>ใส่ทศนิยม 2 ตำแหน่ง เช่น <strong>500.00</strong> หรือ <strong>1000.00</strong></li>
            <li>ถ้าใส่ 500 ระบบจะเข้าใจเป็น 500.00 บาท</li>
            <li>ห้ามใส่เครื่องหมายจุลภาค (,) เช่น ห้ามใส่ 1,000 ให้ใส่ 1000 แทน</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ช่อง "วันที่ฝาก"</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>เลือกวันที่จากปฏิทิน (คลิกที่ช่องวันที่ ปฏิทินจะเปิดขึ้นมาให้เลือก)</li>
            <li>ค่าเริ่มต้นจะเป็น <strong>วันนี้</strong> อัตโนมัติ</li>
            <li>ถ้าสมาชิกมาฝากวันนี้ ไม่ต้องเปลี่ยน ใช้วันนี้ได้เลย</li>
            <li>ถ้าต้องการบันทึกย้อนหลัง ให้เลือกวันที่ที่ถูกต้อง</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ช่อง "คำอธิบาย"</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>ใส่รายละเอียดสั้นๆ เพื่อช่วยจำว่าฝากเงินเรื่องอะไร</li>
            <li>ตัวอย่าง: <strong>"ฝากเงินออมประจำเดือน มีนาคม 2569"</strong></li>
            <li>ตัวอย่าง: <strong>"ฝากเงินปันผล"</strong></li>
            <li>ช่องนี้ไม่บังคับ แต่แนะนำให้ใส่ จะช่วยดูย้อนหลังได้ง่าย</li>
        </ul>

        <x-guide-tip type="warning">
            ตรวจสอบจำนวนเงินให้ถูกต้องก่อนกดบันทึก ถ้าใส่ผิด (เช่น ใส่ 5000 แทน 500) จะต้องทำรายการแก้ไขภายหลัง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลครบแล้ว ให้คลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p class="mt-2">เมื่อบันทึกสำเร็จ ระบบจะทำสิ่งต่อไปนี้ <strong>ทั้งหมดอัตโนมัติ</strong>:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>&#10003; <strong>ยอดเงินฝากเพิ่มขึ้น</strong> ตามจำนวนที่ฝาก</li>
            <li>&#10003; <strong>บันทึกบัญชีอัตโนมัติ</strong> (ระบบลงบัญชี Dr.เงินสด Cr.เงินรับฝาก ให้เอง ไม่ต้องไปลงบัญชีเอง)</li>
            <li>&#10003; <strong>แจ้งเตือนสมาชิกผ่าน LINE</strong> (ถ้ากองทุนเปิดใช้งาน LINE แจ้งเตือน)</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ตัวอย่างข้อความ LINE ที่สมาชิกจะได้รับ:</h4>
        <div class="bg-gray-800 rounded-lg p-4 my-3 border border-gray-700">
            <p class="text-green-400 font-mono text-sm">
                &#x1F4B0; ฝากเงินสำเร็จ<br>
                บัญชี: SAV-000001<br>
                จำนวน: &#3647;500.00<br>
                ยอดคงเหลือ: &#3647;5,500.00
            </p>
        </div>

        <x-guide-tip type="important">
            ระบบจะ <strong>บันทึกบัญชีให้อัตโนมัติ</strong> ทั้งหมด ไม่ต้องไปที่เมนูรายรับ-รายจ่ายเพื่อลงบัญชีเองอีก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-tip type="tip">
        สามารถฝากเงินได้ <strong>ทุกวัน ไม่จำกัดจำนวนครั้ง</strong> สมาชิกจะมาฝากวันละหลายครั้งก็ได้ ระบบจะบันทึกทุกรายการให้หมด
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
