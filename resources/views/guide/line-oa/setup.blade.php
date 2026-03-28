@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        กองทุนสามารถเชื่อมต่อ LINE OA (LINE Official Account) เพื่อส่งแจ้งเตือนให้สมาชิกผ่าน LINE ได้อัตโนมัติ
        เช่น เตือนก่อนครบกำหนดชำระสินเชื่อ แจ้งรับเงิน แจ้งฝาก-ถอนเงิน
        สมาชิกจะได้รับข้อมูลทันทีใน LINE โดยไม่ต้องเปิดแอปหรือเว็บ
    </p>

    <x-guide-tip type="important">
        ขั้นตอนนี้เป็นสำหรับ <strong>ผู้ดูแลระบบกองทุน (Admin)</strong> เท่านั้น
        สมาชิกทั่วไปไม่ต้องทำขั้นตอนนี้ สมาชิกแค่เพิ่มเพื่อน LINE OA ก็รับแจ้งเตือนได้เลย
        (ดูวิธีเพิ่มเพื่อนในหน้า "รับแจ้งเตือนผ่าน LINE")
    </x-guide-tip>

    <x-guide-step :number="1" title="สมัคร LINE Official Account">
        <p>เปิดเบราว์เซอร์ (Chrome) บนคอมพิวเตอร์ แล้วไปที่เว็บไซต์:</p>
        <div class="bg-gray-800 rounded-lg p-4 my-3">
            <code class="text-green-400 text-lg">https://manager.line.biz/</code>
        </div>
        <p>ขั้นตอน:</p>
        <ol class="list-decimal pl-5 space-y-2 mt-2">
            <li>กดปุ่ม <strong>"สร้างบัญชี LINE Official Account"</strong> หรือ <strong>"Create Account"</strong></li>
            <li>เข้าสู่ระบบด้วย <strong>LINE ID ของผู้ดูแล</strong> (ใช้อีเมลหรือเบอร์โทรที่ผูกกับ LINE)</li>
            <li>กรอกข้อมูลบัญชี:
                <ul class="list-disc pl-5 mt-1 space-y-1">
                    <li><strong>ชื่อบัญชี:</strong> ตั้งเป็นชื่อกองทุน เช่น "กองทุนหมู่บ้านบ้านสวนสวรรค์"</li>
                    <li><strong>ประเภทธุรกิจ:</strong> เลือก "องค์กรไม่แสวงหากำไร" หรือ "อื่นๆ"</li>
                </ul>
            </li>
            <li>เลือกประเภท <strong>"Messaging API"</strong> เพื่อให้เชื่อมต่อกับระบบ KTB Account ได้</li>
            <li>กดยืนยันสร้างบัญชี</li>
        </ol>
    </x-guide-step>

    <x-guide-step :number="2" title="เข้า LINE Developers Console">
        <p>เปิดเว็บไซต์:</p>
        <div class="bg-gray-800 rounded-lg p-4 my-3">
            <code class="text-green-400 text-lg">https://developers.line.biz/</code>
        </div>
        <p>ขั้นตอน:</p>
        <ol class="list-decimal pl-5 space-y-2 mt-2">
            <li>เข้าสู่ระบบด้วย LINE ID เดียวกับขั้นตอนที่ 1</li>
            <li>สร้าง <strong>Provider ใหม่</strong> (ถ้ายังไม่มี) หรือเลือก Provider ที่มีอยู่แล้ว
                <ul class="list-disc pl-5 mt-1">
                    <li>ชื่อ Provider ใส่ชื่อกองทุนหรือชื่อหมู่บ้าน</li>
                </ul>
            </li>
            <li>ใน Provider นั้น จะเห็น Channel ที่สร้างไว้จากขั้นตอนที่ 1 (ถ้าเลือก Messaging API ไว้)</li>
            <li>ถ้ายังไม่มี Channel ให้กด <strong>"Create a new channel"</strong> เลือกประเภท <strong>"Messaging API"</strong></li>
        </ol>
    </x-guide-step>

    <x-guide-step :number="3" title="คัดลอก 3 ค่าสำคัญ">
        <p>ในหน้า LINE Developers คัดลอกข้อมูล <strong>3 อย่าง</strong> ที่สำคัญมาก:</p>

        <div class="space-y-3 mt-3">
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="font-bold text-white">1. Channel ID</p>
                <p class="text-gray-400">อยู่ในแท็บ "Basic settings" &gt; "Channel ID"</p>
                <p class="text-gray-400">เป็นตัวเลข 10 หลัก เช่น <code>1234567890</code></p>
                <p class="text-gray-400">กดปุ่ม "Copy" ข้างตัวเลขเพื่อคัดลอก</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="font-bold text-white">2. Channel Secret</p>
                <p class="text-gray-400">อยู่ในแท็บ "Basic settings" &gt; "Channel secret"</p>
                <p class="text-gray-400">เป็นตัวอักษรผสมตัวเลข 32 ตัว เช่น <code>abc123def456...</code></p>
                <p class="text-gray-400">กดปุ่ม "Copy" เพื่อคัดลอก</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="font-bold text-white">3. Channel Access Token</p>
                <p class="text-gray-400">อยู่ในแท็บ "Messaging API" &gt; "Channel access token (long-lived)"</p>
                <p class="text-gray-400">ถ้ายังไม่มี ให้กดปุ่ม <strong>"Issue"</strong> เพื่อสร้างขึ้นมา</p>
                <p class="text-gray-400">เป็นข้อความยาวมาก กดปุ่ม "Copy" เพื่อคัดลอก</p>
            </div>
        </div>

        <x-guide-screenshot src="images/guide/line-oa/line-developers.png" alt="หน้า LINE Developers" caption="คัดลอก Channel ID, Secret และ Token จาก LINE Developers" />

        <x-guide-tip type="important">
            <strong>เก็บค่าเหล่านี้เป็นความลับ!</strong> ห้ามแชร์ให้ผู้อื่น ห้ามส่งทาง LINE หรือ Facebook
            ถ้าหลุดออกไป อาจมีคนส่งข้อความปลอมในชื่อกองทุนได้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="เปิดหน้าตั้งค่า LINE OA ในระบบ KTB Account">
        <p>กลับมาที่เว็บไซต์ระบบ KTB Account</p>
        <ol class="list-decimal pl-5 space-y-2 mt-2">
            <li>เข้าสู่ระบบด้วยบัญชี <strong>ผู้ดูแลระบบ</strong></li>
            <li>กดเมนู <strong>"ตั้งค่า"</strong> ที่เมนูด้านซ้าย</li>
            <li>กดที่ <strong>"LINE OA"</strong></li>
        </ol>
    </x-guide-step>

    <x-guide-step :number="5" title="วาง Channel ID, Secret, Access Token">
        <p>ในหน้าตั้งค่า LINE OA จะมีช่องให้กรอก 3 ช่อง:</p>
        <ol class="list-decimal pl-5 space-y-2 mt-2">
            <li>ช่อง <strong>"Channel ID"</strong> - กดที่ช่อง แล้วกด Ctrl+V (วาง) หรือกดค้างแล้วเลือก "วาง"</li>
            <li>ช่อง <strong>"Channel Secret"</strong> - วางค่า Channel Secret ที่คัดลอกมา</li>
            <li>ช่อง <strong>"Channel Access Token"</strong> - วางค่า Access Token ที่คัดลอกมา</li>
        </ol>
        <p class="mt-3">ตรวจสอบว่าวางครบทั้ง 3 ช่อง และไม่มีเว้นวรรคหน้าหรือหลังข้อความ</p>
    </x-guide-step>

    <x-guide-step :number="6" title="คัดลอก Webhook URL">
        <p>ในหน้าเดียวกัน ระบบจะแสดง <strong>Webhook URL</strong> ให้</p>
        <p>URL จะมีรูปแบบ:</p>
        <div class="bg-gray-800 rounded-lg p-4 my-3">
            <code class="text-green-400">https://ktbaccount.xman4289.com/api/line/webhook/XXXX</code>
        </div>
        <p>(XXXX คือรหัสกองทุนของท่าน)</p>
        <p>กดปุ่ม <strong>"คัดลอก"</strong> ข้าง Webhook URL เพื่อคัดลอก</p>
    </x-guide-step>

    <x-guide-step :number="7" title="วาง Webhook URL ใน LINE Developers">
        <p>กลับไปที่เว็บไซต์ <strong>LINE Developers</strong></p>
        <ol class="list-decimal pl-5 space-y-2 mt-2">
            <li>เข้าไปที่ Channel ของกองทุน</li>
            <li>กดแท็บ <strong>"Messaging API"</strong></li>
            <li>เลื่อนลงไปที่ส่วน <strong>"Webhook settings"</strong></li>
            <li>กดปุ่ม <strong>"Edit"</strong> ข้าง Webhook URL</li>
            <li>วาง Webhook URL ที่คัดลอกมาจากระบบ KTB Account</li>
            <li>กดปุ่ม <strong>"Update"</strong> หรือ <strong>"Save"</strong></li>
            <li>เปิดสวิตช์ <strong>"Use webhook"</strong> ให้เป็น <strong>On</strong> (สีเขียว)</li>
            <li>กดปุ่ม <strong>"Verify"</strong> เพื่อทดสอบการเชื่อมต่อ</li>
            <li>ถ้าขึ้นข้อความ <strong>"Success"</strong> แสดงว่าเชื่อมต่อสำเร็จ</li>
        </ol>
    </x-guide-step>

    <x-guide-step :number="8" title="บันทึกในระบบ KTB Account">
        <p>กลับมาที่หน้าตั้งค่า LINE OA ในระบบ KTB Account</p>
        <p>กดปุ่ม <strong>"บันทึก"</strong></p>
        <div class="bg-gray-800 rounded-lg p-4 my-3 space-y-3">
            <div class="flex items-start gap-3">
                <span class="text-green-400 font-bold">ถ้าสำเร็จ:</span>
                <span>จะแสดงสถานะ "เชื่อมต่อ LINE OA สำเร็จ" เป็นสีเขียว</span>
            </div>
            <div class="flex items-start gap-3">
                <span class="text-red-400 font-bold">ถ้าไม่สำเร็จ:</span>
                <span>ให้ตรวจสอบว่า Channel ID, Channel Secret, Access Token ถูกต้องครบถ้วน ไม่มีเว้นวรรคเกิน</span>
            </div>
        </div>
    </x-guide-step>

    <x-guide-step :number="9" title="ตั้งค่าข้อความต้อนรับ">
        <p>เมื่อเชื่อมต่อสำเร็จแล้ว สามารถตั้งค่าข้อความต้อนรับได้</p>
        <p>ข้อความนี้จะส่งให้สมาชิกอัตโนมัติเมื่อเพิ่มเพื่อน LINE OA ของกองทุน</p>
        <p>ตัวอย่างข้อความ: "ยินดีต้อนรับสู่กองทุนหมู่บ้านบ้านสวนสวรรค์ ท่านจะได้รับแจ้งเตือนอัตโนมัติผ่าน LINE นี้"</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ขั้นตอนนี้ทำครั้งเดียว หลังจากตั้งค่าเสร็จแล้ว ระบบจะส่งแจ้งเตือนอัตโนมัติให้สมาชิกทุกคน
        ที่เพิ่มเพื่อน LINE OA ของกองทุน ไม่ต้องตั้งค่าอะไรเพิ่มเติม
    </x-guide-tip>

    <x-guide-tip type="warning">
        ถ้าเปลี่ยน Channel Secret หรือ Access Token ใน LINE Developers (เช่น กด Re-issue)
        <strong>ต้องอัพเดทค่าใหม่ในระบบ KTB Account ด้วย</strong> ไม่งั้นระบบจะส่งแจ้งเตือนไม่ได้
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
