@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        เมื่อสมาชิกต้องการซื้อหุ้นกองทุนหมู่บ้าน ผู้ดูแลระบบจะบันทึกการซื้อหุ้นในระบบ
        หุ้นเป็นเงินที่สมาชิกลงทุนกับกองทุน ยิ่งถือหุ้นมาก เวลาแบ่งกำไรก็จะได้มาก
        ทำตามขั้นตอนด้านล่างได้เลย
    </p>

    <x-guide-step :number="1" title="เข้าเมนู &quot;หุ้น&quot;">
        <p>คลิกที่เมนู <strong>"หุ้น"</strong> ในแถบด้านซ้ายมือ (อยู่ในหมวด "บริการการเงิน")</p>
        <p>ระบบจะแสดงหน้ารายการหุ้นของสมาชิกทั้งหมด</p>
        <x-guide-screenshot src="images/guide/shares/menu-shares.png" alt="เมนูหุ้น" caption="คลิกเมนู &quot;หุ้น&quot; ในแถบด้านซ้าย หมวด &quot;บริการการเงิน&quot;" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่ม &quot;+ ซื้อหุ้น&quot;">
        <p>มองไปที่ <strong>มุมขวาบน</strong> ของหน้าจอ คลิกปุ่ม <strong>"+ ซื้อหุ้น"</strong></p>
        <p>ระบบจะเปิดแบบฟอร์มซื้อหุ้นขึ้นมา</p>
        <x-guide-screenshot src="images/guide/shares/btn-buy-shares.png" alt="ปุ่มซื้อหุ้น" caption="คลิกปุ่ม &quot;+ ซื้อหุ้น&quot; ที่มุมขวาบน" />
    </x-guide-step>

    <x-guide-step :number="3" title="เลือกสมาชิก">
        <p>ในแบบฟอร์ม จะมีช่อง <strong>"สมาชิก"</strong> ให้เลือก</p>
        <p>วิธีค้นหาสมาชิก:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>พิมพ์ชื่อ</strong> - เช่น พิมพ์ "สมชาย" ระบบจะแสดงรายชื่อให้เลือก</li>
            <li><strong>พิมพ์รหัสสมาชิก</strong> - เช่น "M001"</li>
        </ul>
        <p class="mt-2">คลิกที่ชื่อสมาชิกที่ถูกต้องเพื่อเลือก</p>
        <x-guide-tip type="info">
            สมาชิกทุกคนต้องถือหุ้นอย่างน้อย <strong>1 หุ้น</strong> ตามระเบียบกองทุนหมู่บ้าน การถือหุ้นเป็นเงื่อนไขของการเป็นสมาชิก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="ใส่จำนวนหุ้นที่ต้องการซื้อ">
        <p>ในช่อง <strong>"จำนวนหุ้น"</strong> ให้ใส่ตัวเลขจำนวนหุ้นที่สมาชิกต้องการซื้อ</p>

        <h4 class="text-white font-semibold mt-4 mb-2">วิธีคำนวณ</h4>
        <ul class="list-disc pl-5 space-y-2">
            <li>ราคาหุ้น <strong>หุ้นละ 10 บาท</strong> (เป็นค่าเริ่มต้น กองทุนแต่ละแห่งปรับราคาได้)</li>
            <li>ระบบจะ <strong>คำนวณยอดเงินรวม</strong> ให้อัตโนมัติ</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ตัวอย่างการคำนวณ</h4>
        <div class="overflow-x-auto mt-2">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-2 px-3 text-gray-300">จำนวนหุ้น</th>
                        <th class="text-left py-2 px-3 text-gray-300">ราคาต่อหุ้น</th>
                        <th class="text-left py-2 px-3 text-gray-300">ยอดเงินรวม</th>
                    </tr>
                </thead>
                <tbody class="text-gray-400">
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3">10 หุ้น</td>
                        <td class="py-2 px-3">10 บาท</td>
                        <td class="py-2 px-3 font-semibold text-white">100 บาท</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3">50 หุ้น</td>
                        <td class="py-2 px-3">10 บาท</td>
                        <td class="py-2 px-3 font-semibold text-white">500 บาท</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3">100 หุ้น</td>
                        <td class="py-2 px-3">10 บาท</td>
                        <td class="py-2 px-3 font-semibold text-white">1,000 บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-tip type="tip">
            จำนวนหุ้นขั้นต่ำ <strong>1 หุ้น</strong> ไม่มีขั้นสูง สมาชิกจะซื้อกี่หุ้นก็ได้ตามกำลัง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="เลือกวันที่ซื้อ">
        <p>ในช่อง <strong>"วันที่"</strong> ให้เลือกวันที่ที่สมาชิกมาซื้อหุ้น</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>ค่าเริ่มต้นจะเป็น <strong>วันนี้</strong> อัตโนมัติ</li>
            <li>ถ้าสมาชิกมาซื้อวันนี้ ไม่ต้องเปลี่ยน ใช้วันนี้ได้เลย</li>
            <li>ถ้าต้องการบันทึกย้อนหลัง ให้คลิกที่ช่องวันที่แล้วเลือกวันที่ที่ถูกต้อง</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="6" title="ตรวจสอบข้อมูลและกดบันทึก">
        <p>ก่อนกดบันทึก ให้ตรวจสอบข้อมูลทั้งหมด:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>ชื่อสมาชิก - ถูกคนหรือไม่?</li>
            <li>จำนวนหุ้น - ถูกต้องหรือไม่?</li>
            <li>ยอดเงินรวม - ตรงกับเงินที่สมาชิกจ่ายมาหรือไม่?</li>
        </ul>
        <p class="mt-3">ถ้าถูกต้องแล้ว ให้คลิกปุ่ม <strong>"บันทึก"</strong></p>

        <p class="mt-3">เมื่อบันทึกสำเร็จ ระบบจะทำสิ่งต่อไปนี้:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>&#10003; <strong>จำนวนหุ้นของสมาชิกเพิ่มขึ้น</strong> ตามจำนวนที่ซื้อ</li>
            <li>&#10003; <strong>มูลค่าหุ้นรวมเพิ่มขึ้น</strong> ตามยอดเงิน</li>
            <li>&#10003; <strong>บันทึกบัญชีอัตโนมัติ</strong> (Dr.เงินสด Cr.ทุนหุ้นสมาชิก)</li>
        </ul>
    </x-guide-step>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ตัวอย่างการซื้อหุ้นเพิ่ม</h3>
    <div class="bg-gray-800 rounded-lg p-4 my-3 border border-gray-700">
        <p class="text-gray-300">
            สมาชิก <strong class="text-white">สมชาย ใจดี</strong> มีหุ้นเดิม <strong class="text-white">100 หุ้น</strong> (มูลค่า 1,000 บาท)<br>
            วันนี้มาซื้อเพิ่มอีก <strong class="text-white">50 หุ้น</strong> (จ่ายเงิน 500 บาท)<br><br>
            หลังบันทึกแล้ว:<br>
            จำนวนหุ้นรวม = <strong class="text-green-400">150 หุ้น</strong><br>
            มูลค่ารวม = <strong class="text-green-400">1,500 บาท</strong>
        </p>
    </div>

    <x-guide-tip type="tip">
        ราคาหุ้นละ 10 บาท เป็นค่าเริ่มต้น กองทุนแต่ละแห่งสามารถ <strong>ปรับราคาหุ้นได้</strong> ในหน้าตั้งค่ากองทุน ถ้าระเบียบกองทุนกำหนดราคาหุ้นต่างจากนี้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
