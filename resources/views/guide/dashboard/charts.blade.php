@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะสอนวิธีอ่านกราฟและตัวเลขสรุปที่แสดงในหน้าหลัก
        เพื่อให้ท่านเข้าใจสถานะการเงินของกองทุนได้อย่างถูกต้อง
    </p>

    <x-guide-step :number="1" title="วิธีอ่านกราฟแท่งรายรับ-รายจ่าย">
        <p>กราฟแท่งแสดงยอดรายรับและรายจ่ายของกองทุนในแต่ละเดือน วิธีอ่านมีดังนี้:</p>

        <div class="bg-gray-800 rounded-lg p-4 my-4 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-6 h-6 bg-green-500 rounded"></div>
                <span><strong>แท่งสีเขียว</strong> = รายรับ (เงินที่เข้ากองทุน เช่น ค่าหุ้น ดอกเบี้ยรับ เงินชำระสินเชื่อ)</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-6 h-6 bg-red-500 rounded"></div>
                <span><strong>แท่งสีแดง</strong> = รายจ่าย (เงินที่ออกจากกองทุน เช่น ปล่อยสินเชื่อ ค่าใช้จ่ายดำเนินงาน)</span>
            </div>
        </div>

        <p><strong>วิธีดูกราฟ:</strong></p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>แกนนอน (ด้านล่าง)</strong> = แสดงชื่อเดือน เช่น ม.ค., ก.พ., มี.ค.</li>
            <li><strong>แกนตั้ง (ด้านซ้าย)</strong> = แสดงจำนวนเงิน (หน่วยเป็นบาท)</li>
            <li>ยิ่งแท่งสูง หมายความว่ามียอดเงินมาก</li>
        </ul>

        <x-guide-screenshot src="images/guide/dashboard/charts-bar-annotated.png" alt="กราฟแท่งพร้อมคำอธิบาย" caption="กราฟแท่ง: แท่งเขียว=รายรับ, แท่งแดง=รายจ่าย, แกนนอน=เดือน, แกนตั้ง=จำนวนเงิน" />
        <x-guide-tip type="tip">
            หากแท่งสีเขียวสูงกว่าแท่งสีแดงในเดือนนั้น แสดงว่ากองทุนมีรายรับมากกว่ารายจ่าย
            ซึ่งหมายความว่ากองทุนมีกำไรในเดือนนั้น
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="วิธีอ่านแผนภูมิวงกลมสินเชื่อ">
        <p>แผนภูมิวงกลม (พายชาร์ต) แสดงสัดส่วนสินเชื่อแต่ละประเภทของกองทุน</p>
        <p>แต่ละสี หมายถึง สินเชื่อประเภทต่างๆ ที่กองทุนปล่อยกู้ ตัวอย่างเช่น:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>สินเชื่อทั่วไป</li>
            <li>สินเชื่อฉุกเฉิน</li>
            <li>สินเชื่อพิเศษ</li>
        </ul>
        <p>ยิ่งส่วนใดมีขนาดใหญ่ แสดงว่าสินเชื่อประเภทนั้นมีสัดส่วนมาก
        ท่านสามารถนำข้อมูลนี้ไปวิเคราะห์ว่าสมาชิกกู้ประเภทไหนมากที่สุด</p>
        <x-guide-screenshot src="images/guide/dashboard/charts-pie.png" alt="แผนภูมิวงกลมสินเชื่อ" caption="แผนภูมิวงกลมแสดงสัดส่วนสินเชื่อแต่ละประเภท" />
    </x-guide-step>

    <x-guide-step :number="3" title="วิธีอ่านตัวเลขบนการ์ดสรุป">
        <p>การ์ดสรุปด้านบนของหน้าหลักจะแสดงตัวเลขพร้อมลูกศรเปรียบเทียบกับเดือนที่แล้ว:</p>

        <div class="space-y-4 my-4">
            <div class="bg-gray-800 rounded-lg p-4 flex items-center gap-3">
                <span class="text-green-400 text-2xl font-bold">&uarr;</span>
                <div>
                    <p class="font-semibold text-white">ลูกศรขึ้น (สีเขียว)</p>
                    <p class="text-sm text-gray-300">ตัวเลขเพิ่มขึ้นเมื่อเทียบกับเดือนที่แล้ว</p>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-4 flex items-center gap-3">
                <span class="text-red-400 text-2xl font-bold">&darr;</span>
                <div>
                    <p class="font-semibold text-white">ลูกศรลง (สีแดง)</p>
                    <p class="text-sm text-gray-300">ตัวเลขลดลงเมื่อเทียบกับเดือนที่แล้ว</p>
                </div>
            </div>
        </div>

        <p><strong>ตัวอย่าง:</strong> ถ้าการ์ด "เงินสด" แสดงยอด 50,000 บาท พร้อมลูกศรขึ้นสีเขียว +5,000
        หมายความว่า เดือนนี้กองทุนมีเงินสดมากกว่าเดือนที่แล้ว 5,000 บาท</p>

        <x-guide-tip type="info">
            ลูกศรขึ้นของ "สินเชื่อค้างชำระ" ไม่ใช่เรื่องดีเสมอไป เพราะหมายความว่ายอดหนี้เพิ่มขึ้น
            ควรตรวจสอบว่าเป็นเพราะปล่อยสินเชื่อใหม่ หรือสมาชิกชำระคืนช้า
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
