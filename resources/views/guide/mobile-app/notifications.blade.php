@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        แอปมือถือจะส่งแจ้งเตือนให้ท่านทราบเรื่องสำคัญต่างๆ โดยอัตโนมัติ
        เช่น ใกล้ถึงกำหนดชำระสินเชื่อ ยืนยันว่ารับเงินแล้ว แจ้งฝาก-ถอนเงิน หรือข่าวสารจากกองทุน
        ท่านไม่ต้องตั้งค่าอะไร แจ้งเตือนจะมาให้อัตโนมัติ
    </p>

    <x-guide-step :number="1" title="เปิดแท็บแจ้งเตือน">
        <p>มองที่ <strong>แถบด้านล่างสุด</strong> ของหน้าจอ</p>
        <p>กดที่ <strong>ไอคอนรูปกระดิ่ง (แจ้งเตือน)</strong> ตัวที่ 4 จากซ้าย</p>
        <p>ถ้ามีแจ้งเตือนที่ยังไม่ได้อ่าน จะเห็น <strong>ตัวเลขสีแดง</strong> เล็กๆ อยู่บนไอคอนกระดิ่ง บอกจำนวนที่ยังไม่ได้อ่าน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ดูรายการแจ้งเตือน">
        <p>หน้าจอจะแสดงรายการแจ้งเตือนทั้งหมด เรียงจาก <strong>ใหม่สุดอยู่บน</strong> ไปเก่าสุดอยู่ล่าง</p>
        <p>แต่ละรายการจะแสดง:</p>
        <ul class="list-disc pl-5 space-y-1 mt-2">
            <li>ไอคอนสีบอกประเภท</li>
            <li>ข้อความแจ้งเตือน</li>
            <li>วันที่และเวลา</li>
            <li><strong>จุดสีแดง</strong> ด้านขวา = ยังไม่ได้อ่าน</li>
        </ul>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/notifications-list.png" alt="รายการแจ้งเตือน" caption="รายการแจ้งเตือนทั้งหมด จุดแดงคือยังไม่ได้อ่าน" />
    </x-guide-step>

    <x-guide-step :number="3" title="อ่านแจ้งเตือน">
        <p>กดที่แจ้งเตือนที่ต้องการอ่าน จะแสดงรายละเอียดเพิ่มเติม</p>
        <p>เมื่อกดอ่านแล้ว <strong>จุดสีแดงจะหายไป</strong> แสดงว่าอ่านแล้ว</p>
    </x-guide-step>

    <x-guide-step :number="4" title="ประเภทแจ้งเตือนทั้งหมด">
        <p>แจ้งเตือนมี 5 ประเภท สังเกตจากสีและไอคอน:</p>

        <div class="space-y-4 mt-4">
            <div class="bg-orange-900/20 border border-orange-700 rounded-lg p-4">
                <p class="font-bold text-orange-400 mb-1">ครบกำหนดชำระ (สีส้ม)</p>
                <p class="text-gray-300">เตือนว่าใกล้ถึงวันที่ต้องจ่ายเงินผ่อนสินเชื่อแล้ว</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "สัญญา LN2569-00001 ครบกำหนดชำระอีก 7 วัน จำนวน 5,000.00 บาท"</p>
                <p class="text-gray-400 text-sm">ระบบจะเตือนล่วงหน้า 7 วัน, 3 วัน, และ 1 วัน ก่อนครบกำหนด</p>
            </div>

            <div class="bg-green-900/20 border border-green-700 rounded-lg p-4">
                <p class="font-bold text-green-400 mb-1">ยืนยันรับชำระ (สีเขียว)</p>
                <p class="text-gray-300">ยืนยันว่ากองทุนรับเงินผ่อนสินเชื่อของท่านเรียบร้อยแล้ว</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "รับชำระสินเชื่อเรียบร้อย จำนวน 5,000.00 บาท ยอดคงเหลือ 45,000.00 บาท"</p>
            </div>

            <div class="bg-blue-900/20 border border-blue-700 rounded-lg p-4">
                <p class="font-bold text-blue-400 mb-1">ยืนยันฝากเงิน (สีน้ำเงิน)</p>
                <p class="text-gray-300">ยืนยันว่าฝากเงินเข้าบัญชีเงินฝากเรียบร้อยแล้ว</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "ฝากเงินสำเร็จ บัญชี SAV-000001 จำนวน 500.00 บาท"</p>
            </div>

            <div class="bg-blue-900/20 border border-blue-700 rounded-lg p-4">
                <p class="font-bold text-blue-400 mb-1">ยืนยันถอนเงิน (สีน้ำเงิน)</p>
                <p class="text-gray-300">ยืนยันว่าถอนเงินจากบัญชีเงินฝากเรียบร้อยแล้ว</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "ถอนเงินสำเร็จ บัญชี SAV-000001 จำนวน 200.00 บาท"</p>
            </div>

            <div class="bg-purple-900/20 border border-purple-700 rounded-lg p-4">
                <p class="font-bold text-purple-400 mb-1">ข่าวสารกองทุน (สีม่วง)</p>
                <p class="text-gray-300">ข้อมูลประกาศจากกองทุน เช่น วันประชุม ข่าวสำคัญ การเปลี่ยนแปลงต่างๆ</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "ประชุมใหญ่สามัญประจำปี วันที่ 15 มี.ค. 2569 เวลา 09:00 น. ณ ศาลาหมู่บ้าน"</p>
            </div>
        </div>
    </x-guide-step>

    <x-guide-tip type="tip">
        เปิดใช้ <strong>แจ้งเตือนผ่าน LINE</strong> ด้วย จะได้รับแจ้งเตือนแม้ไม่ได้เปิดแอป
        ดูวิธีตั้งค่าได้ที่หน้า "รับแจ้งเตือนผ่าน LINE"
    </x-guide-tip>

    <x-guide-tip type="important">
        ถ้าไม่เห็นแจ้งเตือน อาจเกิดจากสาเหตุเหล่านี้:
        <ul class="list-disc pl-5 mt-2 space-y-1">
            <li>กองทุนยังไม่ได้ตั้งค่าระบบแจ้งเตือน - ให้ถามเจ้าหน้าที่กองทุน</li>
            <li>LINE OA ของกองทุนยังไม่ได้เปิดใช้งาน (กรณีแจ้งเตือน LINE)</li>
            <li>ท่านยังไม่ได้เพิ่มเพื่อน LINE OA ของกองทุน (กรณีแจ้งเตือน LINE)</li>
            <li>ลองดึงหน้าจอลง (Pull down) เพื่อรีเฟรชข้อมูล</li>
        </ul>
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
