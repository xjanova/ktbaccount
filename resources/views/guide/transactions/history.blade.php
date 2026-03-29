@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดูประวัติรายการรายรับ-รายจ่ายทั้งหมดที่เคยบันทึกไว้ รวมถึงวิธีค้นหาและกรองรายการ
        เพื่อตรวจสอบข้อมูลย้อนหลังได้อย่างสะดวก
    </p>

    <x-guide-step :number="1" title="เข้าหน้ารายรับ-รายจ่าย">
        <p>คลิกที่เมนู <strong>"รายรับ-รายจ่าย"</strong> ในแถบด้านข้างซ้ายมือ ระบบจะแสดงรายการล่าสุดในตาราง</p>
        <x-guide-screenshot src="images/guide/transactions/menu-transaction.png" alt="เมนูรายรับ-รายจ่าย" caption="คลิกเมนู &quot;รายรับ-รายจ่าย&quot; ในแถบด้านข้าง" />
    </x-guide-step>

    <x-guide-step :number="2" title="ดูรายการล่าสุดในตาราง">
        <p>หน้ารายรับ-รายจ่ายจะแสดงรายการล่าสุดในตาราง แต่ละรายการจะแสดงข้อมูล:</p>
        <div class="overflow-x-auto my-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">คอลัมน์</th>
                        <th class="py-2">ความหมาย</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4 font-semibold">วันที่</td>
                        <td class="py-2">วันที่เกิดรายการ</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">ประเภท</td>
                        <td class="py-2">รายรับ (สีเขียว) หรือ รายจ่าย (สีแดง)</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">หมวด</td>
                        <td class="py-2">ประเภทรายรับ/รายจ่าย เช่น ดอกเบี้ยรับ ค่าตอบแทน</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">คำอธิบาย</td>
                        <td class="py-2">รายละเอียดของรายการ</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold">จำนวนเงิน</td>
                        <td class="py-2">จำนวนเงินของรายการ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <x-guide-screenshot src="images/guide/transactions/history-table.png" alt="ตารางรายการ" caption="ตารางแสดงรายการรายรับ-รายจ่ายล่าสุด" />
    </x-guide-step>

    <x-guide-step :number="3" title="คัดกรองรายการ">
        <p>ถ้าต้องการค้นหารายการเฉพาะ ใช้ตัวกรองด้านบนของตาราง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชุดบัญชี:</strong> เลือกชุดบัญชีที่ต้องการดู เช่น "บัญชีเงินล้าน"</li>
            <li><strong>ประเภท (รายรับ/รายจ่าย):</strong> เลือกดูเฉพาะรายรับ หรือเฉพาะรายจ่าย หรือทั้งหมด</li>
            <li><strong>ช่วงวันที่:</strong> เลือกวันที่เริ่มต้นและวันที่สิ้นสุด เพื่อดูรายการเฉพาะช่วงเวลา</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/history-filters.png" alt="ตัวกรองรายการ" caption="ใช้ตัวกรองเพื่อค้นหารายการที่ต้องการ" />
        <x-guide-tip type="tip">
            การกรองตามช่วงวันที่มีประโยชน์มากเมื่อต้องการตรวจสอบรายการของเดือนใดเดือนหนึ่ง
            เช่น ต้องการดูเฉพาะรายการเดือนมกราคม ให้เลือกวันที่ 1 ม.ค. ถึง 31 ม.ค.
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="ดูหลายหน้า (Pagination)">
        <p>ถ้ามีรายการจำนวนมาก ระบบจะแบ่งเป็นหลายหน้า หน้าละ 20 รายการ</p>
        <p>ใช้ปุ่ม <strong>"หน้าก่อนหน้า"</strong> และ <strong>"หน้าถัดไป"</strong> ที่ด้านล่างของตารางเพื่อเปลี่ยนหน้า</p>
        <p>หรือคลิกหมายเลขหน้าที่ต้องการไปโดยตรง</p>
    </x-guide-step>

    <x-guide-step :number="5" title="ดูรายละเอียดของรายการ">
        <p>คลิกที่รายการใดก็ได้ในตาราง เพื่อดูรายละเอียดทั้งหมดของรายการนั้น:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ข้อมูลทั่วไป:</strong> ประเภท วันที่ จำนวนเงิน คำอธิบาย</li>
            <li><strong>ข้อมูลบัญชี:</strong> ลงบัญชีจากบัญชีไหน (เงินสด/ธนาคาร)</li>
            <li><strong>ผู้จ่าย/ผู้รับ:</strong> ชื่อสมาชิกหรือบุคคลภายนอก</li>
            <li><strong>เลขที่เอกสาร:</strong> เลขที่อ้างอิงในระบบ</li>
            <li><strong>รายการบัญชีที่เกี่ยวข้อง:</strong> รายการเดบิต/เครดิตที่ระบบบันทึกให้อัตโนมัติ</li>
        </ul>
        <x-guide-screenshot src="images/guide/transactions/history-detail.png" alt="รายละเอียดรายการ" caption="คลิกรายการเพื่อดูรายละเอียดทั้งหมด" />
    </x-guide-step>

    <x-guide-step :number="6" title="ดาวน์โหลดใบสำคัญ">
        <p>ในหน้ารายละเอียดของแต่ละรายการ จะมีปุ่ม <strong>"ดาวน์โหลดใบสำคัญ"</strong></p>
        <p>คลิกเพื่อดาวน์โหลดใบสำคัญรับหรือใบสำคัญจ่ายเป็นไฟล์ PDF (อ่านเพิ่มเติมในหัวข้อ "ใบสำคัญรับ/จ่าย")</p>
    </x-guide-step>

    <x-guide-tip type="info">
        ระบบเก็บประวัติรายการทั้งหมดตั้งแต่เริ่มใช้งาน ไม่มีวันหมดอายุ สามารถย้อนดูได้ตลอด
        แต่ถ้างวดบัญชีเดือนนั้นปิดไปแล้ว จะไม่สามารถแก้ไขรายการเดิมได้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
