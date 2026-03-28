@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีเพิ่มผู้ใช้งานเข้าระบบ และกำหนดสิทธิ์ว่าแต่ละคนทำอะไรได้บ้าง
        เพื่อให้คณะกรรมการและเจ้าหน้าที่กองทุนสามารถเข้าใช้งานระบบร่วมกันได้อย่างปลอดภัย
    </p>

    <x-guide-step :number="1" title="ไปที่เมนู &quot;ตั้งค่า&quot; แล้วเลือก &quot;จัดการผู้ใช้งาน&quot;">
        <p>ที่แถบเมนูด้านซ้ายมือ ให้คลิกที่ <strong>"ตั้งค่า"</strong> แล้วเลือก <strong>"จัดการผู้ใช้งาน"</strong></p>
        <x-guide-screenshot src="images/guide/getting-started/users-menu.png" alt="เมนูจัดการผู้ใช้งาน" caption="คลิก &quot;ตั้งค่า&quot; แล้วเลือก &quot;จัดการผู้ใช้งาน&quot;" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิก &quot;เพิ่มผู้ใช้งานใหม่&quot;">
        <p>ในหน้าจัดการผู้ใช้งาน จะเห็นรายชื่อผู้ใช้งานทั้งหมด
        ให้กดปุ่ม <strong>"เพิ่มผู้ใช้งานใหม่"</strong> เพื่อเพิ่มคนเข้าระบบ</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กรอกข้อมูลผู้ใช้งาน">
        <p>กรอกข้อมูลของผู้ที่ต้องการเพิ่มเข้าระบบ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อ-นามสกุล</strong> - ชื่อจริงของผู้ใช้งาน</li>
            <li><strong>อีเมล</strong> - อีเมลที่ผู้ใช้งานจะใช้เข้าสู่ระบบ</li>
            <li><strong>เบอร์โทรศัพท์</strong> - เบอร์มือถือที่ติดต่อได้</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/users-add-form.png" alt="แบบฟอร์มเพิ่มผู้ใช้งาน" caption="กรอกข้อมูลผู้ใช้งานใหม่" />
    </x-guide-step>

    <x-guide-step :number="4" title="กำหนดสิทธิ์การใช้งาน">
        <p>เลือกสิทธิ์ (บทบาท) ให้กับผู้ใช้งาน แต่ละสิทธิ์จะทำได้ต่างกัน:</p>

        <div class="overflow-x-auto my-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-600">
                        <th class="text-left py-2 px-3">สิทธิ์</th>
                        <th class="text-left py-2 px-3">ทำอะไรได้บ้าง</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-700">
                        <td class="py-2 px-3 font-semibold">ผู้ดูแลระบบกองทุน</td>
                        <td class="py-2 px-3">ทำได้ทุกอย่าง รวมถึงตั้งค่าระบบ เพิ่ม/ลบผู้ใช้งาน</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="py-2 px-3 font-semibold">ผู้จัดการกองทุน</td>
                        <td class="py-2 px-3">จัดการงานประจำวัน บันทึกรายการ ดูรายงาน จัดการสมาชิก</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="py-2 px-3 font-semibold">ผู้จัดทำบัญชี</td>
                        <td class="py-2 px-3">บันทึกบัญชีรายรับ-รายจ่าย และดูรายงานบัญชี</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="py-2 px-3 font-semibold">คณะกรรมการ</td>
                        <td class="py-2 px-3">อนุมัติสินเชื่อ ดูรายงาน (ไม่สามารถแก้ไขข้อมูล)</td>
                    </tr>
                    <tr class="border-b border-gray-700">
                        <td class="py-2 px-3 font-semibold">สมาชิก</td>
                        <td class="py-2 px-3">ดูข้อมูลของตัวเองเท่านั้น เช่น ยอดเงินฝาก ยอดสินเชื่อ</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-screenshot src="images/guide/getting-started/users-roles.png" alt="ตัวเลือกสิทธิ์การใช้งาน" caption="เลือกสิทธิ์ที่เหมาะสมกับหน้าที่ของผู้ใช้งาน" />
        <x-guide-tip type="warning">
            ระวังการให้สิทธิ์ "ผู้ดูแลระบบกองทุน" ควรให้เฉพาะคนที่ไว้วางใจเท่านั้น
            เพราะสิทธิ์นี้สามารถแก้ไขและลบข้อมูลทั้งหมดในระบบได้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลและเลือกสิทธิ์เรียบร้อยแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong></p>
        <x-guide-tip type="info">
            ผู้ใช้งานใหม่จะได้รับอีเมลเชิญให้ตั้งรหัสผ่าน
            โดยต้องคลิกลิงก์ในอีเมลเพื่อสร้างรหัสผ่านของตัวเอง จึงจะเข้าสู่ระบบได้
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
