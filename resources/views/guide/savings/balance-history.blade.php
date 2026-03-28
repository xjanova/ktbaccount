@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดูยอดเงินคงเหลือและประวัติการฝาก-ถอนของบัญชีเงินฝากแต่ละบัญชี
        สามารถดูย้อนหลังได้ว่าฝากเมื่อไหร่ ถอนเมื่อไหร่ เป็นจำนวนเท่าไหร่
    </p>

    <x-guide-step :number="1" title="เปิดบัญชีเงินฝากที่ต้องการดู">
        <p>คลิกเมนู <strong>"เงินฝาก"</strong> ในแถบด้านซ้ายมือ (หมวด "บริการการเงิน")</p>
        <p>จากรายการบัญชีทั้งหมด ให้ค้นหาบัญชีที่ต้องการดู:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>พิมพ์ <strong>ชื่อสมาชิก</strong> หรือ <strong>เลขบัญชี</strong> ในช่องค้นหา</li>
            <li>คลิกที่แถวของบัญชีที่ต้องการ</li>
        </ul>
        <p class="mt-2">ระบบจะเปิดหน้ารายละเอียดบัญชีขึ้นมา</p>
    </x-guide-step>

    <x-guide-step :number="2" title="ดูข้อมูลสรุปของบัญชี">
        <p>ที่ด้านบนของหน้า จะแสดงข้อมูลสรุปของบัญชีนี้:</p>
        <ul class="list-disc pl-5 space-y-3 mt-2">
            <li>
                <strong>เลขบัญชี</strong> - เช่น SAV-000001
                (เลขนี้ระบบสร้างให้ตอนเปิดบัญชี ใช้อ้างอิงรายการต่างๆ)
            </li>
            <li>
                <strong>ชื่อเจ้าของบัญชี</strong> - ชื่อ-นามสกุลของสมาชิกที่เป็นเจ้าของบัญชีนี้
            </li>
            <li>
                <strong>ประเภทบัญชี</strong> - ออมทรัพย์ หรือ ประจำ
            </li>
            <li>
                <strong>อัตราดอกเบี้ย</strong> - เช่น 2.00% ต่อปี (เป็นอัตราดอกเบี้ยที่กำหนดตอนเปิดบัญชี)
            </li>
            <li>
                <strong>ยอดคงเหลือ</strong> - ตัวเลขใหญ่ อ่านง่าย แสดงจำนวนเงินที่มีในบัญชีตอนนี้
                เช่น &#3647;5,500.00 (ห้าพันห้าร้อยบาทถ้วน)
            </li>
            <li>
                <strong>วันที่เปิดบัญชี</strong> - วันที่สร้างบัญชีนี้ในระบบ
            </li>
        </ul>
        <x-guide-screenshot src="images/guide/savings/account-summary.png" alt="ข้อมูลสรุปบัญชี" caption="ข้อมูลสรุปแสดงที่ด้านบนของหน้า พร้อมยอดคงเหลือตัวใหญ่" />
    </x-guide-step>

    <x-guide-step :number="3" title="ดูตารางประวัติการฝาก-ถอน">
        <p>ด้านล่างของข้อมูลสรุป จะเป็น <strong>ตารางประวัติ</strong> แสดงรายการฝาก-ถอนทั้งหมด</p>
        <p>ตารางมีคอลัมน์ดังนี้:</p>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-2 px-3 text-gray-300">คอลัมน์</th>
                        <th class="text-left py-2 px-3 text-gray-300">ความหมาย</th>
                    </tr>
                </thead>
                <tbody class="text-gray-400">
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">วันที่</td>
                        <td class="py-2 px-3">วันที่ทำรายการฝากหรือถอน เช่น 15/03/2569</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">ประเภท</td>
                        <td class="py-2 px-3">
                            <strong class="text-green-400">ฝาก</strong> = สมาชิกนำเงินมาฝาก (แสดงสีเขียว)<br>
                            <strong class="text-red-400">ถอน</strong> = สมาชิกถอนเงินออก (แสดงสีแดง)
                        </td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">จำนวนเงิน</td>
                        <td class="py-2 px-3">จำนวนเงินที่ฝากหรือถอนในรายการนั้น เช่น &#3647;500.00</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">ยอดคงเหลือ</td>
                        <td class="py-2 px-3">ยอดเงินในบัญชี <strong>หลังจาก</strong> ทำรายการนั้นเสร็จ เช่น ถ้ามี 5,000 แล้วฝาก 500 ยอดคงเหลือจะเป็น 5,500</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">คำอธิบาย</td>
                        <td class="py-2 px-3">รายละเอียดที่บันทึกไว้ตอนฝากหรือถอน เช่น "ฝากเงินออมประจำเดือน มีนาคม 2569"</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-screenshot src="images/guide/savings/transaction-history.png" alt="ตารางประวัติ" caption="ตารางแสดงประวัติฝาก-ถอนทั้งหมด เรียงจากใหม่ไปเก่า" />
        <x-guide-tip type="info">
            รายการจะเรียงจาก <strong>รายการล่าสุด</strong> อยู่บนสุด ไล่ลงไปถึงรายการเก่าสุดอยู่ล่างสุด
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กรองประวัติตามช่วงวันที่">
        <p>ถ้าต้องการดูเฉพาะบางช่วงเวลา สามารถกรองได้:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>เลือก <strong>"วันที่เริ่มต้น"</strong> - เช่น 01/01/2569</li>
            <li>เลือก <strong>"วันที่สิ้นสุด"</strong> - เช่น 31/03/2569</li>
            <li>คลิกปุ่ม <strong>"ค้นหา"</strong> หรือ <strong>"กรอง"</strong></li>
        </ul>
        <p class="mt-2">ระบบจะแสดงเฉพาะรายการที่อยู่ในช่วงวันที่ที่เลือก</p>
        <p>วิธีนี้มีประโยชน์เวลาต้องการดูรายการเฉพาะเดือน หรือเฉพาะปี</p>
    </x-guide-step>

    <x-guide-step :number="5" title="ดาวน์โหลดสมุดบัญชี (PDF)">
        <p>ถ้าต้องการพิมพ์สมุดบัญชีให้สมาชิก หรือเก็บเป็นเอกสาร:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>คลิกปุ่ม <strong>"ดาวน์โหลด PDF"</strong> หรือ <strong>"พิมพ์สมุดบัญชี"</strong></li>
            <li>ระบบจะสร้างไฟล์ PDF ที่มีรายละเอียดบัญชีและประวัติทั้งหมด</li>
            <li>สามารถเปิดดูในคอมพิวเตอร์ หรือพิมพ์ออกมาเป็นกระดาษได้</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="tip">
        สมาชิกสามารถ <strong>ดูยอดเงินฝากผ่านแอปมือถือ</strong> ได้ด้วยตัวเอง โดยไม่ต้องมาถามที่กองทุน ถ้ากองทุนเปิดใช้งานแอปมือถือแล้ว
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
