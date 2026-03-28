@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกต้องการถอนเงินจากบัญชีเงินฝาก ผู้ดูแลระบบจะบันทึกการถอนเงินในระบบ
        ยอดเงินจะลดลงอัตโนมัติ ระบบบันทึกบัญชีให้เสร็จ และส่งแจ้งเตือน LINE ให้สมาชิกทราบ
    </p>

    <x-guide-step :number="1" title="เข้าเมนู &quot;เงินฝาก&quot;">
        <p>คลิกที่เมนู <strong>"เงินฝาก"</strong> ในแถบด้านซ้ายมือ (อยู่ในหมวด "บริการการเงิน")</p>
        <p>ระบบจะแสดงรายการบัญชีเงินฝากทั้งหมดของกองทุน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ค้นหาบัญชีของสมาชิก">
        <p>ค้นหาบัญชีของสมาชิกที่ต้องการถอนเงิน</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>พิมพ์ชื่อสมาชิก</strong> ในช่องค้นหา เช่น "สมหญิง"</li>
            <li><strong>พิมพ์เลขบัญชี</strong> เช่น "SAV-000003"</li>
        </ul>
        <p class="mt-2">ระบบจะกรองแสดงเฉพาะบัญชีที่ตรงกับที่ค้นหา</p>
    </x-guide-step>

    <x-guide-step :number="3" title="คลิกเข้าดูบัญชี">
        <p>คลิกที่แถวของบัญชีที่ต้องการ ระบบจะเปิดหน้ารายละเอียดบัญชี</p>
        <p>ตรวจสอบข้อมูลให้แน่ใจ:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อเจ้าของบัญชี</strong> - ตรงกับสมาชิกที่มาถอนหรือไม่?</li>
            <li><strong>ยอดคงเหลือ</strong> - มีเงินเพียงพอสำหรับถอนหรือไม่?</li>
        </ul>
        <x-guide-tip type="important">
            ตรวจสอบยอดคงเหลือก่อนถอนทุกครั้ง ถ้ายอดคงเหลือน้อยกว่าจำนวนที่จะถอน จะถอนไม่ได้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="คลิกปุ่ม &quot;ถอนเงิน&quot;">
        <p>ที่หน้ารายละเอียดบัญชี ให้คลิกปุ่ม <strong>"ถอนเงิน"</strong> (ปุ่มสีแดง/ส้ม)</p>
        <p>ระบบจะเปิดแบบฟอร์มถอนเงินขึ้นมา พร้อมแสดงยอดเงินคงเหลือปัจจุบันให้เห็น</p>
        <x-guide-screenshot src="images/guide/savings/btn-withdraw.png" alt="ปุ่มถอนเงิน" caption="คลิกปุ่ม &quot;ถอนเงิน&quot;" />
    </x-guide-step>

    <x-guide-step :number="5" title="กรอกข้อมูลการถอนเงิน">
        <p>กรอกข้อมูลในแบบฟอร์มให้ครบทุกช่อง:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ช่อง "จำนวนเงิน"</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>ใส่จำนวนเงินที่สมาชิกต้องการถอน เป็นตัวเลข</li>
            <li>ใส่ทศนิยม 2 ตำแหน่ง เช่น <strong>500.00</strong> หรือ <strong>1000.00</strong></li>
            <li><strong>จำนวนเงินต้องไม่เกินยอดคงเหลือ</strong> ในบัญชี</li>
        </ul>
        <x-guide-tip type="warning">
            ถ้าใส่จำนวนเงินเกินยอดคงเหลือ ระบบจะแสดงข้อความ <strong>"ยอดเงินฝากไม่เพียงพอ"</strong> สีแดง และจะไม่ให้บันทึก ต้องแก้ไขจำนวนเงินให้ไม่เกินยอดที่มีอยู่
        </x-guide-tip>

        <h4 class="text-white font-semibold mt-4 mb-2">ช่อง "วันที่ถอน"</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>เลือกวันที่จากปฏิทิน</li>
            <li>ค่าเริ่มต้นจะเป็น <strong>วันนี้</strong> อัตโนมัติ</li>
            <li>ถ้าสมาชิกมาถอนวันนี้ ไม่ต้องเปลี่ยน ใช้วันนี้ได้เลย</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ช่อง "คำอธิบาย"</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>ใส่รายละเอียดสั้นๆ เช่น <strong>"ถอนเงินใช้จ่ายส่วนตัว"</strong></li>
            <li>ตัวอย่าง: <strong>"ถอนเงินค่ารักษาพยาบาล"</strong></li>
            <li>ช่องนี้ไม่บังคับ แต่แนะนำให้ใส่ จะช่วยดูย้อนหลังได้ง่าย</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลครบแล้ว ให้คลิกปุ่ม <strong>"บันทึก"</strong></p>
        <p class="mt-2">เมื่อบันทึกสำเร็จ ระบบจะทำสิ่งต่อไปนี้ <strong>ทั้งหมดอัตโนมัติ</strong>:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>&#10003; <strong>ยอดเงินฝากลดลง</strong> ตามจำนวนที่ถอน</li>
            <li>&#10003; <strong>บันทึกบัญชีอัตโนมัติ</strong> (ระบบลงบัญชี Dr.เงินรับฝาก Cr.เงินสด ให้เอง ไม่ต้องลงบัญชีเอง)</li>
            <li>&#10003; <strong>แจ้งเตือนสมาชิกผ่าน LINE</strong> (ถ้ากองทุนเปิดใช้งาน LINE แจ้งเตือน)</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ตัวอย่างข้อความ LINE ที่สมาชิกจะได้รับ:</h4>
        <div class="bg-gray-800 rounded-lg p-4 my-3 border border-gray-700">
            <p class="text-green-400 font-mono text-sm">
                &#x1F4B8; ถอนเงินสำเร็จ<br>
                บัญชี: SAV-000001<br>
                จำนวน: &#3647;500.00<br>
                ยอดคงเหลือ: &#3647;5,000.00
            </p>
        </div>
    </x-guide-step>

    <x-guide-tip type="tip">
        ถ้าสมาชิกต้องการ <strong>ปิดบัญชี</strong> ให้ถอนเงินออกทั้งหมดจนยอดคงเหลือเป็น 0 บาท แล้วเปลี่ยนสถานะบัญชีเป็น "ปิดบัญชี" ที่หน้ารายละเอียดบัญชี
    </x-guide-tip>

    <x-guide-tip type="info">
        ระบบจะ <strong>บันทึกบัญชีให้อัตโนมัติ</strong> ทั้งหมด ไม่ต้องไปที่เมนูรายรับ-รายจ่ายเพื่อลงบัญชีเองอีก
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
