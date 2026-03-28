@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะอธิบายส่วนต่างๆ ของหน้าหลัก (Dashboard) ให้ท่านเข้าใจว่าแต่ละส่วนแสดงข้อมูลอะไร
        และสามารถใช้งานอย่างไร เพื่อให้ท่านดูภาพรวมของกองทุนได้อย่างรวดเร็ว
    </p>

    <x-guide-step :number="1" title="ส่วนต่างๆ ของหน้าหลัก">
        <p>หน้าหลักของระบบแบ่งออกเป็น 3 ส่วนหลัก:</p>

        <h4 class="text-white font-semibold mt-6 mb-2">แถบด้านข้าง (Sidebar) - เมนูนำทาง</h4>
        <p>อยู่ทางด้านซ้ายของหน้าจอ เป็นเมนูสำหรับไปยังหน้าต่างๆ ของระบบ เช่น
        หน้าหลัก, สมาชิก, สินเชื่อ, บัญชี, รายงาน, ตั้งค่า</p>

        <h4 class="text-white font-semibold mt-6 mb-2">แถบด้านบน (Header)</h4>
        <p>อยู่ด้านบนสุดของหน้าจอ แสดงข้อมูลต่อไปนี้:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li><strong>ชื่อกองทุน</strong> - แสดงชื่อกองทุนที่ท่านกำลังใช้งานอยู่</li>
            <li><strong>กระดิ่งแจ้งเตือน</strong> - แสดงจำนวนแจ้งเตือนที่ยังไม่ได้อ่าน</li>
            <li><strong>รูปโปรไฟล์</strong> - คลิกเพื่อดูข้อมูลบัญชีผู้ใช้หรือออกจากระบบ</li>
        </ul>

        <h4 class="text-white font-semibold mt-6 mb-2">พื้นที่เนื้อหาหลัก</h4>
        <p>อยู่ตรงกลางและด้านขวาของหน้าจอ เป็นส่วนที่แสดงข้อมูลสำคัญต่างๆ
        ได้แก่ การ์ดสรุปตัวเลข กราฟ และรายการล่าสุด</p>

        <x-guide-screenshot src="images/guide/dashboard/overview-layout.png" alt="หน้าหลักพร้อมลูกศรชี้ส่วนต่างๆ" caption="ส่วนประกอบหลักของหน้าหลัก: แถบด้านข้าง, แถบด้านบน, และพื้นที่เนื้อหา" />
    </x-guide-step>

    <x-guide-step :number="2" title="การ์ดสรุปตัวเลข (4 ใบ)">
        <p>ที่ด้านบนของพื้นที่เนื้อหาหลัก จะมีการ์ด 4 ใบ แสดงตัวเลขสรุปสำคัญ:</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-4">
            <div class="bg-gray-800 rounded-lg p-4">
                <h5 class="text-green-400 font-semibold mb-1">เงินสด</h5>
                <p class="text-sm text-gray-300">ยอดเงินสดที่กองทุนมีอยู่ในมือ (ไม่รวมเงินในธนาคาร)</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <h5 class="text-blue-400 font-semibold mb-1">เงินฝากธนาคาร</h5>
                <p class="text-sm text-gray-300">ยอดเงินฝากในธนาคารทุกบัญชีรวมกัน</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <h5 class="text-orange-400 font-semibold mb-1">สินเชื่อค้างชำระ</h5>
                <p class="text-sm text-gray-300">ยอดเงินสินเชื่อทั้งหมดที่สมาชิกยังไม่ได้ชำระคืน</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <h5 class="text-purple-400 font-semibold mb-1">จำนวนสมาชิก</h5>
                <p class="text-sm text-gray-300">จำนวนสมาชิกทั้งหมดของกองทุน</p>
            </div>
        </div>

        <x-guide-screenshot src="images/guide/dashboard/overview-summary-cards.png" alt="การ์ดสรุป 4 ใบ" caption="การ์ดสรุปตัวเลขสำคัญ 4 รายการ" />
        <x-guide-tip type="tip">
            ตัวเลขบนการ์ดเหล่านี้จะอัปเดตโดยอัตโนมัติทุกครั้งที่มีการบันทึกรายการใหม่เข้าระบบ
            ท่านไม่ต้องคำนวณเอง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="3" title="กราฟและแผนภูมิ">
        <p>ด้านล่างการ์ดสรุป จะมีกราฟ 2 ตัว ช่วยให้ท่านเห็นภาพรวมของกองทุนได้ง่ายขึ้น:</p>

        <h4 class="text-white font-semibold mt-6 mb-2">กราฟแท่ง: รายรับ-รายจ่ายรายเดือน</h4>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li><strong>แท่งสีเขียว</strong> = รายรับ (เงินเข้า)</li>
            <li><strong>แท่งสีแดง</strong> = รายจ่าย (เงินออก)</li>
        </ul>
        <p>กราฟนี้ช่วยให้เห็นว่าแต่ละเดือนกองทุนมีเงินเข้า-ออกเท่าไหร่</p>

        <h4 class="text-white font-semibold mt-6 mb-2">แผนภูมิวงกลม: สัดส่วนสินเชื่อ</h4>
        <p>แสดงสัดส่วนสินเชื่อประเภทต่างๆ ของกองทุน
        ช่วยให้เห็นว่าเงินกู้ส่วนใหญ่เป็นประเภทไหน</p>

        <x-guide-screenshot src="images/guide/dashboard/overview-charts.png" alt="กราฟแท่งและแผนภูมิวงกลม" caption="กราฟแท่งรายรับ-รายจ่าย (ซ้าย) และแผนภูมิวงกลมสินเชื่อ (ขวา)" />
    </x-guide-step>

    <x-guide-step :number="4" title="รายการล่าสุด">
        <p>ด้านล่างสุดของหน้าหลัก จะมีตารางแสดง <strong>5 รายการรับ-จ่ายล่าสุด</strong>
        ที่บันทึกเข้าระบบ ประกอบด้วย:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>วันที่ทำรายการ</li>
            <li>รายละเอียด</li>
            <li>จำนวนเงิน</li>
            <li>ประเภท (รายรับ/รายจ่าย)</li>
        </ul>
        <p>ท่านสามารถคลิกที่แต่ละรายการเพื่อดูรายละเอียดเพิ่มเติมได้</p>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
