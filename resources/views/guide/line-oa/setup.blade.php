@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        กองทุนสามารถเชื่อมต่อ LINE OA (LINE Official Account) เพื่อส่งแจ้งเตือนให้สมาชิกผ่าน LINE ได้อัตโนมัติ
        เช่น เตือนชำระสินเชื่อ แจ้งรับเงิน แจ้งฝาก-ถอน
    </p>

    <x-guide-tip type="important">
        ขั้นตอนนี้เป็นสำหรับ <strong>ผู้ดูแลระบบ (Admin)</strong> เท่านั้น สมาชิกทั่วไปไม่ต้องทำ
    </x-guide-tip>

    <x-guide-step :number="1" title="สร้าง LINE OA">
        <p>ไปที่เว็บไซต์ <strong>manager.line.biz</strong> แล้วสร้างบัญชี LINE Official Account ใหม่</p>
        <p>ตั้งชื่อเป็นชื่อกองทุน เช่น "กองทุนหมู่บ้านบ้านสุข"</p>
    </x-guide-step>

    <x-guide-step :number="2" title="สร้าง Messaging API Channel">
        <p>ไปที่เว็บไซต์ <strong>developers.line.biz</strong></p>
        <p>สร้าง <strong>Messaging API Channel</strong> เชื่อมกับ LINE OA ที่สร้างไว้ในขั้นตอนที่ 1</p>
    </x-guide-step>

    <x-guide-step :number="3" title="คัดลอก Channel ID, Secret, Token">
        <p>ในหน้า LINE Developers คัดลอกข้อมูล 3 อย่าง:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>Channel ID:</strong> รหัสของช่องทาง</li>
            <li><strong>Channel Secret:</strong> รหัสลับ</li>
            <li><strong>Channel Access Token:</strong> โทเค็นสำหรับเชื่อมต่อ</li>
        </ul>
        <x-guide-screenshot src="images/guide/line-oa/line-developers.png" alt="หน้า LINE Developers" caption="คัดลอก Channel ID, Secret และ Token จาก LINE Developers" />
    </x-guide-step>

    <x-guide-step :number="4" title="ตั้งค่าในระบบ KTB Account">
        <p>กลับมาที่ระบบ KTB Account ไปที่ <strong>ตั้งค่า > LINE OA</strong></p>
        <p>วางข้อมูลที่คัดลอกมา:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li>วาง Channel ID</li>
            <li>วาง Channel Secret</li>
            <li>วาง Channel Access Token</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="5" title="คัดลอก Webhook URL">
        <p>ระบบจะแสดง <strong>Webhook URL</strong> ให้คัดลอก</p>
        <p>นำ Webhook URL ไปวางในหน้า LINE Developers > Messaging API > Webhook URL</p>
    </x-guide-step>

    <x-guide-step :number="6" title="เปิดใช้งาน Webhook">
        <p>ในหน้า LINE Developers เปิดสวิตช์ <strong>"Use webhook"</strong> ให้เป็นสีเขียว</p>
    </x-guide-step>

    <x-guide-step :number="7" title="บันทึก">
        <p>กลับมาที่ระบบ KTB Account แล้วคลิก <strong>"บันทึก"</strong></p>
        <p>ระบบจะทดสอบการเชื่อมต่อ ถ้าสำเร็จจะแสดงสถานะ "เชื่อมต่อแล้ว"</p>
    </x-guide-step>

    <x-guide-tip type="warning">
        <strong>เก็บ Channel Secret และ Token เป็นความลับ</strong> อย่าแชร์ให้คนอื่นเด็ดขาด
        ถ้าหลุดออกไปอาจมีคนอื่นส่งข้อความปลอมในชื่อกองทุนได้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
