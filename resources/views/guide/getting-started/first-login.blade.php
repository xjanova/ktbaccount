@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีเข้าสู่ระบบ KTB Account เป็นครั้งแรก
        หลังจากที่ท่านลงทะเบียนกองทุนเรียบร้อยแล้ว สามารถเข้าสู่ระบบได้ทันที
    </p>

    <x-guide-step :number="1" title="เปิดเว็บไซต์">
        <p>เปิดเว็บเบราว์เซอร์ (Google Chrome, Safari, หรือเบราว์เซอร์อื่นๆ) แล้วพิมพ์ที่อยู่เว็บไซต์:</p>
        <p class="font-semibold text-white text-lg my-4 bg-white/5 px-4 py-3 rounded-xl border border-white/10">https://ktbaccount.xman4289.com</p>
        <x-guide-tip type="tip">
            แนะนำให้ใช้ <strong>Google Chrome</strong> เพราะรองรับฟีเจอร์ทั้งหมดของระบบได้ดีที่สุด
            หรือใช้ Safari บน iPhone/iPad ก็ได้เช่นกัน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="คลิก &quot;เข้าสู่ระบบ&quot;">
        <p>ที่หน้าแรกของเว็บไซต์ ให้คลิกปุ่ม <strong>"เข้าสู่ระบบ"</strong> ที่มุมขวาบนของหน้าจอ</p>
        <p>ระบบจะพาท่านไปที่หน้าเข้าสู่ระบบ</p>
        <x-guide-screenshot src="images/guide/getting-started/login-button.png" alt="ปุ่มเข้าสู่ระบบ" caption="คลิกปุ่ม &quot;เข้าสู่ระบบ&quot; ที่มุมขวาบน" />
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกอีเมลและรหัสผ่าน">
        <p>กรอกข้อมูลเข้าสู่ระบบ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>อีเมล</strong> — อีเมลที่ใช้ตอนลงทะเบียน</li>
            <li><strong>รหัสผ่าน</strong> — รหัสผ่านที่ตั้งไว้ตอนลงทะเบียน</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/login-form.png" alt="หน้าเข้าสู่ระบบ" caption="กรอกอีเมลและรหัสผ่านที่ใช้ตอนลงทะเบียน" />
        <x-guide-tip type="tip">
            ติ๊กเครื่องหมายถูกที่ช่อง <strong>"จดจำฉัน"</strong> เพื่อให้ระบบจำข้อมูลไว้
            จะได้ไม่ต้องกรอกอีเมลใหม่ทุกครั้งที่เข้าสู่ระบบ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="กดปุ่ม &quot;เข้าสู่ระบบ&quot;">
        <p>เมื่อกรอกข้อมูลเรียบร้อยแล้ว ให้กดปุ่ม <strong>"เข้าสู่ระบบ"</strong> (ปุ่มสีม่วง)</p>
        <p>ถ้าข้อมูลถูกต้อง ระบบจะพาท่านเข้าสู่หน้าหลัก (Dashboard)</p>
    </x-guide-step>

    <x-guide-step :number="5" title="เข้าสู่หน้าหลัก (Dashboard)">
        <p>เมื่อเข้าสู่ระบบสำเร็จ ระบบจะพาท่านเข้าสู่หน้าหลัก (Dashboard) ของกองทุน
        ซึ่งจะแสดงข้อมูลสรุปต่างๆ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>จำนวนสมาชิก</strong> ของกองทุน</li>
            <li><strong>ยอดสินเชื่อคงค้าง</strong></li>
            <li><strong>ยอดเงินฝากรวม</strong></li>
            <li><strong>กราฟรายรับ-รายจ่าย</strong></li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/dashboard-after-login.png" alt="หน้าหลักหลังเข้าสู่ระบบ" caption="หน้าหลักของระบบ แสดงข้อมูลสรุปกองทุน" />
    </x-guide-step>

    <x-guide-step :number="6" title="ถ้าเข้าสู่ระบบไม่ได้?">
        <p>ถ้าเข้าสู่ระบบไม่ได้ อาจเกิดจากสาเหตุต่อไปนี้:</p>

        <h4 class="text-white font-semibold mt-4 mb-2">ปัญหา: "อีเมลหรือรหัสผ่านไม่ถูกต้อง"</h4>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>ตรวจสอบว่าพิมพ์อีเมลถูกต้อง (ตัวพิมพ์เล็กทั้งหมด)</li>
            <li>ตรวจสอบรหัสผ่าน (ระวังตัวพิมพ์ใหญ่-เล็ก)</li>
            <li>ตรวจสอบว่าคีย์บอร์ดไม่ได้เปิด Caps Lock</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ปัญหา: "ลืมรหัสผ่าน"</h4>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>คลิกลิงก์ <strong>"ลืมรหัสผ่าน"</strong> ที่หน้าเข้าสู่ระบบ</li>
            <li>กรอกอีเมลที่ใช้ลงทะเบียน</li>
            <li>ระบบจะส่งลิงก์ตั้งรหัสผ่านใหม่ไปที่อีเมลของท่าน</li>
            <li>เปิดอีเมลแล้วคลิกลิงก์เพื่อตั้งรหัสผ่านใหม่</li>
        </ul>

        <h4 class="text-white font-semibold mt-4 mb-2">ปัญหา: "หน้าจอขาว/โหลดไม่ขึ้น"</h4>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>ตรวจสอบว่าเชื่อมต่ออินเทอร์เน็ตอยู่</li>
            <li>ลอง Refresh หน้าเว็บ (กด F5 หรือ Ctrl+R)</li>
            <li>ลองเปิดในเบราว์เซอร์อื่น</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="info">
        กองทุนที่เปิดใช้งาน LINE OA สามารถเข้าสู่ระบบด้วย LINE ได้เลย
        โดยกดปุ่ม "เข้าสู่ระบบด้วย LINE" ที่หน้าเข้าสู่ระบบ
    </x-guide-tip>

    <x-guide-tip type="tip">
        <strong>เคล็ดลับ:</strong> บันทึกที่อยู่เว็บไซต์เป็น "Bookmark" หรือ "รายการโปรด"
        ในเบราว์เซอร์ จะได้เปิดได้เร็วโดยไม่ต้องพิมพ์ใหม่ทุกครั้ง
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
