@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        สมาชิกกองทุนสามารถรับแจ้งเตือนผ่าน LINE ได้อัตโนมัติ เช่น เตือนก่อนถึงกำหนดชำระสินเชื่อ
        แจ้งว่ารับเงินแล้ว แจ้งฝาก-ถอนเงิน ข่าวสารจากกองทุน
        แค่เพิ่มเพื่อน LINE OA ของกองทุน ก็จะได้รับแจ้งเตือนทันที ไม่ต้องตั้งค่าอะไร
    </p>

    <x-guide-step :number="1" title="ขอ QR Code หรือ LINE ID จากเจ้าหน้าที่กองทุน">
        <p>ก่อนเริ่ม ท่านต้องได้รับข้อมูล LINE OA ของกองทุนจากเจ้าหน้าที่ก่อน ซึ่งอาจเป็น:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>QR Code</strong> - รูปสี่เหลี่ยมลายจุดขาวดำ (มักแปะที่สำนักงานกองทุน หรือแจกเป็นใบปลิว)</li>
            <li><strong>LINE ID</strong> - ชื่อที่มี @ นำหน้า เช่น @fundvillage</li>
            <li><strong>ลิงก์</strong> - ลิงก์ที่กดแล้วเปิด LINE อัตโนมัติ</li>
        </ul>
        <p class="mt-3">ถ้าไม่มีข้อมูลเหล่านี้ ให้ถามเจ้าหน้าที่กองทุนว่า "LINE OA ของกองทุนชื่ออะไร" หรือ "ขอ QR Code LINE กองทุน"</p>
    </x-guide-step>

    <x-guide-step :number="2" title="เปิดแอป LINE บนมือถือ">
        <p>มองหาไอคอนแอป <strong>LINE</strong> (สีเขียว มีรูปกรอบข้อความ) บนหน้าจอมือถือ</p>
        <p>กดที่ไอคอน LINE เพื่อเปิดแอป</p>
        <p>ถ้ายังไม่มีแอป LINE ให้ไปดาวน์โหลดจาก Google Play Store ก่อน (ค้นหาคำว่า "LINE" แล้วกดติดตั้ง)</p>
    </x-guide-step>

    <x-guide-step :number="3" title="เพิ่มเพื่อน LINE OA ของกองทุน">
        <p>มี 3 วิธี เลือกวิธีที่สะดวกที่สุด:</p>

        <div class="space-y-4 mt-4">
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="font-bold text-white mb-2">วิธีที่ 1: สแกน QR Code (ง่ายที่สุด)</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>ในแอป LINE กดที่ไอคอน <strong>"เพิ่มเพื่อน"</strong> (รูปคนมีเครื่องหมาย +) ด้านบนขวา</li>
                    <li>กดที่ <strong>"QR Code"</strong></li>
                    <li>กล้องจะเปิดขึ้นมา ให้ <strong>ส่องกล้องไปที่ QR Code</strong> ของกองทุน</li>
                    <li>เมื่อสแกนสำเร็จ จะแสดงชื่อ LINE OA ของกองทุน</li>
                </ol>
            </div>

            <div class="bg-gray-800 rounded-lg p-4">
                <p class="font-bold text-white mb-2">วิธีที่ 2: ค้นหาชื่อ LINE OA</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>ในแอป LINE กดที่ไอคอน <strong>"เพิ่มเพื่อน"</strong> (รูปคนมีเครื่องหมาย +)</li>
                    <li>กดที่ <strong>"ค้นหา"</strong> (รูปแว่นขยาย)</li>
                    <li>พิมพ์ชื่อ LINE OA ของกองทุน เช่น <code>@fundvillage</code> (ต้องมี @ นำหน้า)</li>
                    <li>กดค้นหา แล้วจะเห็นชื่อ LINE OA ของกองทุน</li>
                </ol>
            </div>

            <div class="bg-gray-800 rounded-lg p-4">
                <p class="font-bold text-white mb-2">วิธีที่ 3: กดลิงก์</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>ถ้าได้รับลิงก์จากเจ้าหน้าที่ (เช่นส่งทาง SMS หรือ LINE)</li>
                    <li>กดที่ลิงก์นั้น จะเปิดแอป LINE อัตโนมัติ</li>
                    <li>แสดงหน้า LINE OA ของกองทุน</li>
                </ol>
            </div>
        </div>

        <x-guide-screenshot type="app" src="images/guide/line-oa/add-friend.png" alt="เพิ่มเพื่อน LINE OA" caption="สแกน QR Code หรือค้นหาชื่อเพื่อเพิ่มเพื่อน" />
    </x-guide-step>

    <x-guide-step :number="4" title="กด 'เพิ่มเพื่อน' (Add)">
        <p>เมื่อเจอ LINE OA ของกองทุนแล้ว ให้กดปุ่ม <strong>"เพิ่มเพื่อน" (Add)</strong></p>
        <p>จะได้รับข้อความต้อนรับจาก LINE OA ทันที</p>
        <p>เช่น "ยินดีต้อนรับสู่กองทุนหมู่บ้านบ้านสวนสวรรค์ ท่านจะได้รับแจ้งเตือนอัตโนมัติผ่าน LINE นี้"</p>
    </x-guide-step>

    <x-guide-step :number="5" title="เสร็จแล้ว! รอรับแจ้งเตือนอัตโนมัติ">
        <p>หลังจากเพิ่มเพื่อนแล้ว <strong>ไม่ต้องทำอะไรเพิ่ม</strong> ระบบจะส่งแจ้งเตือนอัตโนมัติดังนี้:</p>

        <div class="space-y-3 mt-4">
            <div class="bg-orange-900/20 border border-orange-700 rounded-lg p-4">
                <p class="font-bold text-orange-400">เตือนก่อนครบกำหนดชำระ</p>
                <p class="text-gray-300">เตือนล่วงหน้า 7 วัน, 3 วัน, และ 1 วัน ก่อนถึงวันจ่ายเงินผ่อน</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "แจ้งเตือน: สัญญา LN2569-00001 ครบกำหนดชำระอีก 7 วัน จำนวน 5,000 บาท"</p>
            </div>

            <div class="bg-red-900/20 border border-red-700 rounded-lg p-4">
                <p class="font-bold text-red-400">เตือนวันครบกำหนดและเลยกำหนด</p>
                <p class="text-gray-300">เตือนในวันครบกำหนด และเมื่อเลยกำหนดชำระแล้ว</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "เตือน: สัญญา LN2569-00001 เลยกำหนดชำระแล้ว กรุณาติดต่อกองทุน"</p>
            </div>

            <div class="bg-green-900/20 border border-green-700 rounded-lg p-4">
                <p class="font-bold text-green-400">ยืนยันรับชำระสินเชื่อ</p>
                <p class="text-gray-300">เมื่อเจ้าหน้าที่บันทึกว่ารับเงินผ่อนแล้ว</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "รับชำระสินเชื่อเรียบร้อย จำนวน 5,000 บาท ยอดคงเหลือ 45,000 บาท"</p>
            </div>

            <div class="bg-blue-900/20 border border-blue-700 rounded-lg p-4">
                <p class="font-bold text-blue-400">ยืนยันฝากเงิน / ถอนเงิน</p>
                <p class="text-gray-300">เมื่อเจ้าหน้าที่บันทึกรายการฝากหรือถอนเงิน</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "ฝากเงินสำเร็จ บัญชี SAV-000001 จำนวน 500 บาท"</p>
            </div>

            <div class="bg-purple-900/20 border border-purple-700 rounded-lg p-4">
                <p class="font-bold text-purple-400">ข่าวสารจากกองทุน</p>
                <p class="text-gray-300">ประกาศ นัดประชุม ข่าวสำคัญจากกองทุน</p>
                <p class="text-gray-400 text-sm mt-1">ตัวอย่าง: "ประชุมใหญ่สามัญประจำปี 15 มี.ค. 2569 เวลา 09:00 น."</p>
            </div>
        </div>
    </x-guide-step>

    <x-guide-tip type="tip">
        ไม่ต้องทำอะไรเพิ่มเติม <strong>แค่เพิ่มเพื่อน LINE OA ครั้งเดียว</strong>
        แจ้งเตือนทุกอย่างจะส่งมาอัตโนมัติตลอด สะดวกมาก
    </x-guide-tip>

    <x-guide-tip type="important">
        ถ้าไม่ได้รับแจ้งเตือน ให้ตรวจสอบตามลำดับ:
        <ol class="list-decimal pl-5 mt-2 space-y-1">
            <li>ตรวจสอบว่า <strong>เพิ่มเพื่อน LINE OA แล้ว</strong> จริงๆ - เปิด LINE ดูว่ามีชื่อกองทุนอยู่ในรายชื่อเพื่อนหรือไม่</li>
            <li>ตรวจสอบว่า <strong>ไม่ได้บล็อค LINE OA</strong> - ถ้าบล็อคอยู่ จะไม่ได้รับข้อความ ให้ปลดบล็อค</li>
            <li>ตรวจสอบว่า <strong>LINE OA ของกองทุนเปิดใช้งานแล้ว</strong> - ถามเจ้าหน้าที่กองทุนว่าตั้งค่า LINE OA แล้วหรือยัง</li>
            <li>ตรวจสอบว่า <strong>ไม่ได้ปิดเสียงแจ้งเตือน</strong> - เข้าไปในห้องแชท LINE OA กดไอคอนกระดิ่งเพื่อเปิดเสียง</li>
        </ol>
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
