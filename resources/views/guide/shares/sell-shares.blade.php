@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกต้องการขายหรือถอนหุ้นคืน ผู้ดูแลระบบจะบันทึกในระบบ
        จำนวนหุ้นจะลดลงอัตโนมัติ และระบบจะคำนวณเงินคืนให้สมาชิก
        ทำตามขั้นตอนด้านล่างได้เลย
    </p>

    <x-guide-step :number="1" title="เข้าเมนู &quot;หุ้น&quot;">
        <p>คลิกที่เมนู <strong>"หุ้น"</strong> ในแถบด้านซ้ายมือ (อยู่ในหมวด "บริการการเงิน")</p>
        <p>ระบบจะแสดงหน้ารายการหุ้นของสมาชิกทั้งหมด</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ค้นหาสมาชิกที่ต้องการขายหุ้น">
        <p>จากตารางรายการหุ้น ให้ค้นหาสมาชิกที่ต้องการขายหุ้น:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>พิมพ์ <strong>ชื่อสมาชิก</strong> ในช่องค้นหา เช่น "สมชาย"</li>
            <li>หรือเลื่อนหาในตาราง</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="ดูยอดหุ้นปัจจุบัน">
        <p>คลิกที่ชื่อสมาชิก ระบบจะแสดงข้อมูลหุ้นของสมาชิกคนนั้น:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>จำนวนหุ้นที่ถือครอง</strong> - เช่น 150 หุ้น</li>
            <li><strong>มูลค่ารวม</strong> - เช่น 1,500 บาท</li>
            <li><strong>ประวัติซื้อ-ขาย</strong> - รายการที่ผ่านมาทั้งหมด</li>
        </ul>
        <p class="mt-2">ตรวจสอบว่าสมาชิกมีหุ้นเพียงพอสำหรับขาย</p>
    </x-guide-step>

    <x-guide-step :number="4" title="คลิกปุ่ม &quot;ขาย/ถอนหุ้น&quot;">
        <p>คลิกปุ่ม <strong>"ขาย/ถอนหุ้น"</strong> ระบบจะเปิดแบบฟอร์มขายหุ้นขึ้นมา</p>
        <x-guide-screenshot src="images/guide/shares/btn-sell-shares.png" alt="ปุ่มขายหุ้น" caption="คลิกปุ่ม &quot;ขาย/ถอนหุ้น&quot;" />
    </x-guide-step>

    <x-guide-step :number="5" title="ใส่จำนวนหุ้นที่ต้องการขาย">
        <p>ในช่อง <strong>"จำนวนหุ้น"</strong> ให้ใส่ตัวเลขจำนวนหุ้นที่สมาชิกต้องการขาย</p>

        <h4 class="text-white font-semibold mt-4 mb-2">กฎสำคัญ</h4>
        <ul class="list-disc pl-5 space-y-2">
            <li>จำนวนหุ้นที่ขาย <strong>ต้องไม่เกินจำนวนหุ้นที่ถือครองอยู่</strong></li>
            <li>ระบบจะ <strong>คำนวณเงินคืน</strong> ให้อัตโนมัติ (จำนวนหุ้น x ราคาต่อหุ้น)</li>
        </ul>

        <x-guide-tip type="warning">
            ถ้าใส่จำนวนหุ้นเกินจำนวนที่ถือครอง ระบบจะแสดงข้อความ <strong>"จำนวนหุ้นไม่เพียงพอ"</strong> สีแดง และจะไม่ให้บันทึก ต้องแก้ไขจำนวนให้ไม่เกินที่มีอยู่
        </x-guide-tip>

        <x-guide-tip type="important">
            ถ้าสมาชิกขายหุ้น <strong>จนหมด</strong> (เหลือ 0 หุ้น) จะไม่มีหุ้นเหลือในกองทุน ตรวจสอบระเบียบกองทุนก่อนว่าอนุญาตให้ขายหุ้นหมดได้หรือไม่ บางกองทุนกำหนดว่าสมาชิกต้องถือหุ้นขั้นต่ำไม่น้อยกว่า 1 หุ้น
        </x-guide-tip>

        <h4 class="text-white font-semibold mt-4 mb-2">ตัวอย่าง</h4>
        <div class="bg-gray-800 rounded-lg p-4 my-3 border border-gray-700">
            <p class="text-gray-300">
                สมาชิก <strong class="text-white">สมหญิง รักดี</strong> มีหุ้น <strong class="text-white">100 หุ้น</strong> (มูลค่า 1,000 บาท)<br>
                ต้องการขาย <strong class="text-white">30 หุ้น</strong><br><br>
                เงินที่ได้คืน = 30 x 10 = <strong class="text-green-400">300 บาท</strong><br>
                หุ้นคงเหลือ = 100 - 30 = <strong class="text-yellow-400">70 หุ้น</strong> (มูลค่า 700 บาท)
            </p>
        </div>
    </x-guide-step>

    <x-guide-step :number="6" title="เลือกวันที่ขาย">
        <p>ในช่อง <strong>"วันที่"</strong> ให้เลือกวันที่ที่สมาชิกมาขายหุ้น</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>ค่าเริ่มต้นจะเป็น <strong>วันนี้</strong> อัตโนมัติ</li>
            <li>ถ้าสมาชิกมาขายวันนี้ ไม่ต้องเปลี่ยน ใช้วันนี้ได้เลย</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="7" title="ตรวจสอบข้อมูลและกดบันทึก">
        <p>ก่อนกดบันทึก ให้ตรวจสอบข้อมูลทั้งหมด:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>ชื่อสมาชิก - ถูกคนหรือไม่?</li>
            <li>จำนวนหุ้นที่ขาย - ถูกต้องหรือไม่?</li>
            <li>เงินที่ต้องจ่ายคืน - ตรงกับที่คำนวณหรือไม่?</li>
        </ul>
        <p class="mt-3">ถ้าถูกต้องแล้ว ให้คลิกปุ่ม <strong>"บันทึก"</strong></p>

        <p class="mt-3">เมื่อบันทึกสำเร็จ ระบบจะทำสิ่งต่อไปนี้:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>&#10003; <strong>จำนวนหุ้นลดลง</strong> ตามจำนวนที่ขาย</li>
            <li>&#10003; <strong>คำนวณเงินคืน</strong> ให้สมาชิก</li>
            <li>&#10003; <strong>บันทึกบัญชีอัตโนมัติ</strong> (Dr.ทุนหุ้นสมาชิก Cr.เงินสด)</li>
        </ul>

        <x-guide-tip type="info">
            หลังบันทึกแล้ว อย่าลืม <strong>จ่ายเงินคืนให้สมาชิก</strong> ตามจำนวนที่ระบบคำนวณ
        </x-guide-tip>
    </x-guide-step>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">สิ่งที่ควรรู้เพิ่มเติม</h3>
    <ul class="list-disc pl-5 space-y-3 mt-2">
        <li>การขายหุ้นจะ <strong>ลดทุนของกองทุน</strong> ถ้าสมาชิกหลายคนขายหุ้นพร้อมกัน กองทุนจะมีเงินทุนลดลง</li>
        <li>บางกองทุนกำหนดว่า <strong>ต้องแจ้งล่วงหน้า</strong> ก่อนขายหุ้น ตรวจสอบระเบียบกองทุนก่อน</li>
        <li>ถ้าสมาชิก <strong>ลาออก</strong> จากกองทุน ต้องขายหุ้นคืนทั้งหมด พร้อมปิดบัญชีเงินฝาก และชำระหนี้เงินกู้ให้ครบ</li>
        <li>ประวัติการซื้อ-ขายหุ้นทั้งหมดจะถูกเก็บไว้ในระบบ สามารถดูย้อนหลังได้ตลอด</li>
    </ul>

    <x-guide-tip type="tip">
        ถ้าไม่แน่ใจว่าสมาชิกขายหุ้นได้หรือไม่ ให้ <strong>ปรึกษาประธานกองทุน</strong> หรือดูจากระเบียบกองทุนหมู่บ้าน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
