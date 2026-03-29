@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        ผู้ดูแลระบบสามารถเพิ่มผู้ใช้งานและกำหนดสิทธิ์การใช้งานได้ แต่ละคนจะเห็นเมนูตามสิทธิ์ที่ได้รับ
        การจัดการสิทธิ์ที่ดีช่วยให้ข้อมูลกองทุนปลอดภัย และแต่ละคนทำงานได้อย่างเหมาะสม
    </p>

    <x-guide-step :number="1" title="เปิดหน้าจัดการผู้ใช้">
        <p>ไปที่ <strong>ตั้งค่า > ผู้ใช้งาน</strong></p>
        <p>ระบบจะแสดงรายชื่อผู้ใช้งานทั้งหมดในระบบ พร้อมข้อมูล:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อ-นามสกุล</strong> ของผู้ใช้</li>
            <li><strong>อีเมล</strong> ที่ใช้เข้าสู่ระบบ</li>
            <li><strong>บทบาท (Role)</strong> สิทธิ์การใช้งาน</li>
            <li><strong>สถานะ</strong> ใช้งานอยู่หรือถูกระงับ</li>
            <li><strong>เข้าสู่ระบบล่าสุด</strong> วันที่เข้าใช้งานครั้งสุดท้าย</li>
        </ul>
        <x-guide-screenshot src="images/guide/settings/users-list.png" alt="รายชื่อผู้ใช้งาน" caption="รายชื่อผู้ใช้งานทั้งหมดในระบบ" />
    </x-guide-step>

    <x-guide-step :number="2" title="เพิ่มผู้ใช้ใหม่">
        <p>คลิกปุ่ม <strong>"+ เพิ่มผู้ใช้"</strong> แล้วกรอกข้อมูล:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ชื่อ-นามสกุล:</strong> ชื่อจริงของผู้ใช้</li>
            <li><strong>อีเมล:</strong> อีเมลสำหรับเข้าสู่ระบบ (ต้องไม่ซ้ำกับคนอื่น)</li>
            <li><strong>รหัสผ่าน:</strong> ตั้งรหัสผ่านเริ่มต้น (แนะนำ 8 ตัวอักษรขึ้นไป)</li>
            <li><strong>บทบาท (Role):</strong> เลือกสิทธิ์การใช้งาน (อ่านรายละเอียดด้านล่าง)</li>
        </ul>
        <x-guide-tip type="tip">
            แนะนำให้บอกผู้ใช้ใหม่ว่า ควรเปลี่ยนรหัสผ่านทันทีหลังเข้าสู่ระบบครั้งแรก เพื่อความปลอดภัย
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="3" title="ทำความเข้าใจบทบาท (Role)">
        <p>แต่ละบทบาทมีสิทธิ์ในการเข้าถึงเมนูและทำงานต่างกัน:</p>

        <div class="overflow-x-auto my-6">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">บทบาท</th>
                        <th class="py-2 pr-4">สิ่งที่ทำได้</th>
                        <th class="py-2">เหมาะสำหรับ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-indigo-400">ผู้ดูแลระบบ (Admin)</td>
                        <td class="py-3 pr-4">ทำได้ทุกอย่าง: ตั้งค่าระบบ จัดการผู้ใช้ บันทึกบัญชี อนุมัติสินเชื่อ ดูรายงาน ปิดบัญชี</td>
                        <td class="py-3">ประธานกองทุน หรือผู้รับผิดชอบหลัก</td>
                    </tr>
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-emerald-400">ผู้จัดการกองทุน</td>
                        <td class="py-3 pr-4">บันทึกรายการ รับชำระสินเชื่อ ฝาก-ถอนเงิน ดูรายงาน แต่ไม่สามารถจัดการผู้ใช้หรือตั้งค่าระบบ</td>
                        <td class="py-3">ผู้จัดการหรือเจ้าหน้าที่ประจำ</td>
                    </tr>
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-amber-400">ผู้จัดทำบัญชี</td>
                        <td class="py-3 pr-4">บันทึกรายรับ-รายจ่าย บันทึกรายการบัญชี ดูรายงาน</td>
                        <td class="py-3">คนทำบัญชีของกองทุน</td>
                    </tr>
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-blue-400">คณะกรรมการ</td>
                        <td class="py-3 pr-4">อนุมัติสินเชื่อ ดูรายงานทุกชนิด แต่ไม่สามารถบันทึกหรือแก้ไขข้อมูล</td>
                        <td class="py-3">คณะกรรมการกองทุน</td>
                    </tr>
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-gray-400">เจ้าหน้าที่ธนาคาร / สทบ.</td>
                        <td class="py-3 pr-4">ดูรายงานและข้อมูลทั้งหมดได้ แต่แก้ไขอะไรไม่ได้</td>
                        <td class="py-3">เจ้าหน้าที่ภายนอกที่ต้องตรวจสอบ</td>
                    </tr>
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-purple-400">สมาชิก</td>
                        <td class="py-3 pr-4">ดูข้อมูลของตัวเองเท่านั้น (ยอดสินเชื่อ เงินฝาก หุ้น)</td>
                        <td class="py-3">สมาชิกกองทุนทั่วไป</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-guide-tip type="info">
            กองทุนส่วนใหญ่จะมีผู้ใช้งาน 2-5 คน ได้แก่ ประธาน (Admin) 1 คน ผู้จัดการ 1-2 คน และคณะกรรมการ 2-3 คน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="แก้ไขข้อมูลผู้ใช้">
        <p>คลิกที่ชื่อผู้ใช้ในรายการเพื่อเข้าหน้าแก้ไข สามารถแก้ไขได้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อ-นามสกุล</strong></li>
            <li><strong>อีเมล</strong> (ต้องไม่ซ้ำกับคนอื่น)</li>
            <li><strong>บทบาท</strong> - เปลี่ยนสิทธิ์การใช้งาน</li>
            <li><strong>รีเซ็ตรหัสผ่าน</strong> - ตั้งรหัสผ่านใหม่ให้ผู้ใช้ที่ลืมรหัส</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="5" title="ระงับหรือลบผู้ใช้">
        <p><strong>ระงับผู้ใช้:</strong> คลิกปุ่ม "ระงับ" เพื่อปิดการเข้าใช้งานชั่วคราว ผู้ใช้จะไม่สามารถเข้าสู่ระบบได้ แต่ข้อมูลที่เคยบันทึกไว้ยังอยู่ครบ</p>
        <p class="mt-3"><strong>ลบผู้ใช้:</strong> คลิกปุ่ม "ลบ" เพื่อลบผู้ใช้ออกจากระบบถาวร ระบบจะถามยืนยันก่อนลบ</p>
        <x-guide-tip type="tip">
            แนะนำให้ <strong>"ระงับ"</strong> แทน "ลบ" เมื่อผู้ใช้ไม่ได้ทำหน้าที่แล้ว เพราะประวัติการทำงานจะยังคงอยู่ในระบบ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="6" title="คำถามที่พบบ่อย">
        <div class="space-y-4 mt-4">
            <div>
                <p class="font-semibold text-white">ถาม: ผู้ใช้ลืมรหัสผ่าน ทำอย่างไร?</p>
                <p>ตอบ: ผู้ดูแลระบบสามารถ "รีเซ็ตรหัสผ่าน" ให้ได้ในหน้าแก้ไขผู้ใช้ หรือผู้ใช้กดลิงก์ "ลืมรหัสผ่าน" ที่หน้าเข้าสู่ระบบ</p>
            </div>
            <div>
                <p class="font-semibold text-white">ถาม: ต้องการให้คนทำบัญชีดูรายงานได้ แต่ไม่อยากให้อนุมัติสินเชื่อ?</p>
                <p>ตอบ: ให้เลือกบทบาท "ผู้จัดทำบัญชี" ซึ่งจะเข้าถึงได้เฉพาะระบบบัญชีและรายงาน</p>
            </div>
            <div>
                <p class="font-semibold text-white">ถาม: Admin มีได้กี่คน?</p>
                <p>ตอบ: มีได้มากกว่า 1 คน แต่แนะนำให้มีน้อยที่สุด เพื่อความปลอดภัยของข้อมูล</p>
            </div>
        </div>
    </x-guide-step>

    <x-guide-tip type="warning">
        <strong>ระวังเรื่องสิทธิ์ Admin</strong> คนที่เป็น Admin ทำได้ทุกอย่าง รวมถึงลบข้อมูลและเปลี่ยนแปลงการตั้งค่า
        ควรให้เฉพาะคนที่ไว้ใจได้เท่านั้น และไม่ควรใช้บัญชี Admin ร่วมกัน
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
