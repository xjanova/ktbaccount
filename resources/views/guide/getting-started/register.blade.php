@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีลงทะเบียนกองทุนหมู่บ้านเข้าสู่ระบบ KTB Account
        เพื่อเริ่มต้นใช้งานระบบบัญชีกองทุนหมู่บ้านออนไลน์ ขั้นตอนไม่ยุ่งยาก ทำตามได้เลย
    </p>

    <x-guide-step :number="1" title="เปิดเว็บไซต์">
        <p>เปิดเว็บเบราว์เซอร์ (เช่น Google Chrome, Safari) แล้วพิมพ์ที่อยู่เว็บไซต์ในช่องด้านบน:</p>
        <p class="font-semibold text-white text-lg my-4">https://ktbaccount.xman4289.com</p>
        <p>หรือจะค้นหาคำว่า "KTB Account" ในกูเกิลก็ได้เช่นกัน</p>
        <x-guide-screenshot src="images/guide/getting-started/register-homepage.png" alt="หน้าแรกเว็บไซต์ KTB Account" caption="หน้าแรกของเว็บไซต์ KTB Account" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกปุ่มลงทะเบียนกองทุนใหม่">
        <p>ที่หน้าแรก จะเห็นปุ่ม <strong>"ลงทะเบียนกองทุนใหม่"</strong> ให้คลิกที่ปุ่มนี้เพื่อเริ่มลงทะเบียน</p>
        <x-guide-screenshot src="images/guide/getting-started/register-button.png" alt="ปุ่มลงทะเบียนกองทุนใหม่" caption="คลิกที่ปุ่มสีม่วง ลงทะเบียนกองทุนใหม่" />
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกข้อมูลผู้ดูแลระบบ (ขั้นตอนที่ 1)">
        <p>ในหน้านี้ ให้กรอกข้อมูลของผู้ที่จะเป็นผู้ดูแลระบบของกองทุน ซึ่งจะมีสิทธิ์จัดการทุกอย่างในระบบ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อ-นามสกุล</strong> - ชื่อจริงและนามสกุลของผู้ดูแลระบบ</li>
            <li><strong>อีเมล</strong> - อีเมลที่จะใช้เข้าสู่ระบบ (เช่น somchai@gmail.com)</li>
            <li><strong>รหัสผ่าน</strong> - ตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร ควรมีทั้งตัวเลขและตัวอักษร</li>
            <li><strong>ยืนยันรหัสผ่าน</strong> - พิมพ์รหัสผ่านเดิมอีกครั้งเพื่อยืนยัน</li>
            <li><strong>เบอร์โทรศัพท์</strong> - เบอร์มือถือที่ติดต่อได้</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/register-step1.png" alt="แบบฟอร์มกรอกข้อมูลผู้ดูแลระบบ" caption="กรอกข้อมูลผู้ดูแลระบบให้ครบทุกช่อง" />
        <x-guide-tip type="tip">
            แนะนำให้ใช้อีเมลที่เข้าถึงได้ง่าย เช่น Gmail หรืออีเมลที่ใช้งานอยู่เป็นประจำ
            เพราะระบบจะส่งข้อมูลสำคัญไปที่อีเมลนี้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กรอกข้อมูลกองทุน (ขั้นตอนที่ 2)">
        <p>ขั้นตอนนี้ให้กรอกข้อมูลของกองทุนหมู่บ้าน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อกองทุนหมู่บ้าน</strong> - ชื่อเต็มของกองทุน เช่น "กองทุนหมู่บ้านบ้านสวนสวรรค์"</li>
            <li><strong>รหัสกองทุน</strong> - เลขทะเบียนกองทุนที่ได้รับจาก สทบ.</li>
            <li><strong>ที่อยู่</strong> - ที่อยู่ของกองทุน</li>
            <li><strong>จังหวัด</strong> - เลือกจังหวัดจากรายการ</li>
            <li><strong>อำเภอ</strong> - เลือกอำเภอจากรายการ</li>
            <li><strong>ตำบล</strong> - เลือกตำบลจากรายการ</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/register-step2.png" alt="แบบฟอร์มกรอกข้อมูลกองทุน" caption="กรอกข้อมูลกองทุนให้ครบถ้วน" />
    </x-guide-step>

    <x-guide-step :number="5" title="ยืนยัน PDPA (ขั้นตอนที่ 3)">
        <p>ขั้นตอนสุดท้าย ระบบจะแสดงนโยบายความเป็นส่วนตัว (PDPA) ให้อ่าน:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>อ่านรายละเอียดนโยบายความเป็นส่วนตัว</li>
            <li>คลิกช่องยอมรับนโยบาย</li>
            <li>กดปุ่ม <strong>"ลงทะเบียน"</strong></li>
        </ol>
        <x-guide-screenshot src="images/guide/getting-started/register-pdpa.png" alt="หน้ายืนยัน PDPA" caption="อ่านและยอมรับนโยบายความเป็นส่วนตัว แล้วกดลงทะเบียน" />
        <x-guide-tip type="warning">
            ข้อมูลส่วนบุคคลของท่านจะถูกเก็บรักษาอย่างปลอดภัยตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล (PDPA)
            ระบบจะไม่เปิดเผยข้อมูลของท่านให้บุคคลภายนอก
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="ลงทะเบียนสำเร็จ!">
        <p>เมื่อลงทะเบียนเรียบร้อยแล้ว ระบบจะพาท่านเข้าสู่หน้าตั้งค่ากองทุนโดยอัตโนมัติ
        เพื่อเริ่มตั้งค่าข้อมูลกองทุนของท่านต่อไป</p>
        <x-guide-tip type="tip">
            จดอีเมลและรหัสผ่านเก็บไว้ในที่ปลอดภัย เพราะจะต้องใช้ในการเข้าสู่ระบบทุกครั้ง
            หากลืมรหัสผ่าน สามารถกด "ลืมรหัสผ่าน" ที่หน้าเข้าสู่ระบบได้
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
