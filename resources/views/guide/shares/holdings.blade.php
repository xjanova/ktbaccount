@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดูยอดหุ้นที่สมาชิกแต่ละคนถือครอง
        ดูได้ว่าสมาชิกคนไหนมีหุ้นกี่หุ้น มูลค่ารวมเท่าไหร่
        พร้อมดูประวัติการซื้อ-ขายหุ้นย้อนหลังได้ทั้งหมด
    </p>

    <x-guide-step :number="1" title="เข้าเมนู &quot;หุ้น&quot;">
        <p>คลิกที่เมนู <strong>"หุ้น"</strong> ในแถบด้านซ้ายมือ (อยู่ในหมวด "บริการการเงิน")</p>
        <p>ระบบจะแสดงหน้าหลักของหุ้น พร้อมตารางยอดถือครองของสมาชิกทั้งหมด</p>
        <x-guide-screenshot src="images/guide/shares/menu-shares.png" alt="เมนูหุ้น" caption="คลิกเมนู &quot;หุ้น&quot; ในแถบด้านซ้าย" />
    </x-guide-step>

    <x-guide-step :number="2" title="ดูตารางยอดถือครอง">
        <p>ระบบจะแสดง <strong>ตารางรายชื่อสมาชิกทั้งหมด</strong> พร้อมข้อมูลหุ้น</p>
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
                        <td class="py-2 px-3 font-semibold text-white">ชื่อสมาชิก</td>
                        <td class="py-2 px-3">ชื่อ-นามสกุลของสมาชิก เรียงตามตัวอักษร</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">จำนวนหุ้น (หุ้น)</td>
                        <td class="py-2 px-3">จำนวนหุ้นที่สมาชิกถือครองอยู่ตอนนี้ เช่น 100 หุ้น</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">ราคาต่อหุ้น (บาท/หุ้น)</td>
                        <td class="py-2 px-3">ราคาหุ้นละกี่บาท เช่น 10 บาท/หุ้น</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">มูลค่ารวม (บาท)</td>
                        <td class="py-2 px-3">
                            มูลค่าหุ้นทั้งหมดของสมาชิกคนนั้น<br>
                            คำนวณจาก: <strong>จำนวนหุ้น x ราคาต่อหุ้น</strong><br>
                            เช่น 100 หุ้น x 10 บาท = 1,000 บาท
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-screenshot src="images/guide/shares/holdings-table.png" alt="ตารางยอดถือครอง" caption="ตารางแสดงยอดหุ้นของสมาชิกทุกคน" />
    </x-guide-step>

    <x-guide-step :number="3" title="ค้นหาสมาชิก">
        <p>ถ้าสมาชิกมีจำนวนมาก สามารถค้นหาได้:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>พิมพ์ <strong>ชื่อสมาชิก</strong> ในช่องค้นหา เช่น "สมชาย"</li>
            <li>ระบบจะกรองแสดงเฉพาะสมาชิกที่ตรงกับที่ค้นหา</li>
            <li>ถ้าต้องการดูทั้งหมด ให้ลบข้อความในช่องค้นหาออก</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="4" title="ดูประวัติซื้อ-ขายหุ้นของสมาชิก">
        <p>คลิกที่ <strong>ชื่อสมาชิก</strong> ในตาราง ระบบจะเปิดหน้ารายละเอียดหุ้นของสมาชิกคนนั้น</p>
        <p>ในหน้านี้จะแสดง:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ข้อมูลสรุป</h4>
        <ul class="list-disc pl-5 space-y-1">
            <li>จำนวนหุ้นรวมที่ถือครอง</li>
            <li>มูลค่ารวม</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ตารางประวัติซื้อ-ขาย</h4>
        <p>แสดงรายการซื้อ-ขายหุ้นทั้งหมดของสมาชิกคนนี้:</p>
        <div class="overflow-x-auto mt-2">
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
                        <td class="py-2 px-3">วันที่ทำรายการซื้อหรือขาย เช่น 15/03/2569</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">ประเภท</td>
                        <td class="py-2 px-3">
                            <strong class="text-green-400">ซื้อ</strong> = สมาชิกซื้อหุ้นเพิ่ม (สีเขียว)<br>
                            <strong class="text-red-400">ขาย</strong> = สมาชิกขายหุ้นคืน (สีแดง)
                        </td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">จำนวนหุ้น</td>
                        <td class="py-2 px-3">จำนวนหุ้นที่ซื้อหรือขายในรายการนั้น</td>
                    </tr>
                    <tr class="border-b border-gray-800">
                        <td class="py-2 px-3 font-semibold text-white">จำนวนเงิน</td>
                        <td class="py-2 px-3">ยอดเงินที่จ่ายซื้อ หรือได้รับคืนจากการขาย</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-guide-step>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ส่วนสรุปยอดรวมทั้งกองทุน</h3>
    <p>ที่ด้านบนหรือด้านล่างของหน้า จะมีข้อมูลสรุปยอดรวมทั้งกองทุน:</p>
    <ul class="list-disc pl-5 space-y-2 mt-2">
        <li><strong>จำนวนสมาชิกที่ถือหุ้น</strong> - เช่น 50 คน</li>
        <li><strong>จำนวนหุ้นรวม</strong> - เช่น 5,000 หุ้น (หุ้นทั้งหมดของสมาชิกทุกคนรวมกัน)</li>
        <li><strong>มูลค่ารวมทั้งกองทุน</strong> - เช่น 50,000 บาท (เงินทุนหุ้นทั้งหมด)</li>
    </ul>
    <p class="mt-2">ข้อมูลนี้มีประโยชน์ตอนทำรายงานประจำปี หรือเสนอต่อที่ประชุมใหญ่</p>

    <x-guide-tip type="tip">
        ใช้ตารางนี้ <strong>ตรวจสอบยอดหุ้น</strong> ได้ทุกเมื่อ ทั้งยอดของสมาชิกแต่ละคน และยอดรวมทั้งกองทุน ถ้าสมาชิกมาถามว่ามีหุ้นกี่หุ้น ก็ดูจากที่นี่ได้เลย
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
