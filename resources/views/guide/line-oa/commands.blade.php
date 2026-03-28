@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        นอกจากรับแจ้งเตือนอัตโนมัติแล้ว สมาชิกยังสามารถพิมพ์ข้อความถาม LINE OA ของกองทุนได้ด้วย
        ระบบจะตอบกลับอัตโนมัติทันที ไม่ต้องรอเจ้าหน้าที่ตอบ
    </p>

    <x-guide-step :number="1" title="วิธีพิมพ์ข้อความถาม LINE OA">
        <p>เปิดแอป LINE แล้วเข้าไปที่ <strong>ห้องแชทของ LINE OA กองทุน</strong></p>
        <p>กดที่ช่องพิมพ์ข้อความด้านล่าง แล้วพิมพ์คำที่ต้องการถาม</p>
        <p>กดปุ่ม <strong>"ส่ง"</strong> (ลูกศรสีเขียว) ระบบจะตอบกลับภายในไม่กี่วินาที</p>
    </x-guide-step>

    <x-guide-step :number="2" title="คำสั่งที่ใช้ได้">
        <p>ตารางด้านล่างแสดงคำที่สามารถพิมพ์ได้ และระบบจะตอบกลับอะไร:</p>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-3 text-left text-white">พิมพ์คำว่า</th>
                        <th class="px-4 py-3 text-left text-white">ระบบตอบกลับ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <tr>
                        <td class="px-4 py-3"><code class="text-green-400">"ยอด"</code> หรือ <code class="text-green-400">"สินเชื่อ"</code></td>
                        <td class="px-4 py-3 text-gray-300">แนะนำให้ดูยอดสินเชื่อผ่านแอป KTB Account หรือเว็บไซต์ ซึ่งจะแสดงข้อมูลครบถ้วนกว่า</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3"><code class="text-green-400">"ฝาก"</code> หรือ <code class="text-green-400">"ถอน"</code></td>
                        <td class="px-4 py-3 text-gray-300">แจ้งให้ติดต่อเจ้าหน้าที่กองทุนโดยตรง เพราะการฝาก-ถอนต้องทำที่กองทุน</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3"><code class="text-green-400">"ติดต่อ"</code></td>
                        <td class="px-4 py-3 text-gray-300">แสดงข้อมูลติดต่อกองทุน: ชื่อกองทุน เบอร์โทรศัพท์ อีเมล เวลาทำการ</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3"><span class="text-gray-400">คำอื่นๆ ที่ไม่ตรง</span></td>
                        <td class="px-4 py-3 text-gray-300">ตอบกลับอัตโนมัติพร้อมแนะนำคำสั่งที่ใช้ได้</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-guide-step>

    <x-guide-step :number="3" title="ตัวอย่างการสนทนา">
        <p>ตัวอย่างข้อความที่ส่งและคำตอบที่ได้รับ:</p>

        <div class="bg-gray-800 rounded-lg p-4 my-4 space-y-4">
            {{-- ตัวอย่างที่ 1 --}}
            <div>
                <div class="flex justify-end mb-2">
                    <div class="bg-green-600 text-white rounded-lg px-4 py-2 max-w-xs">
                        <p>ยอดสินเชื่อเท่าไหร่</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-700 text-gray-200 rounded-lg px-4 py-2 max-w-sm">
                        <p>กรุณาตรวจสอบยอดสินเชื่อผ่านแอป KTB Account หรือเว็บไซต์ https://ktbaccount.xman4289.com เพื่อดูข้อมูลที่ครบถ้วนและเป็นปัจจุบัน</p>
                    </div>
                </div>
            </div>

            {{-- ตัวอย่างที่ 2 --}}
            <div>
                <div class="flex justify-end mb-2">
                    <div class="bg-green-600 text-white rounded-lg px-4 py-2 max-w-xs">
                        <p>ติดต่อ</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-700 text-gray-200 rounded-lg px-4 py-2 max-w-sm">
                        <p class="font-bold">กองทุนหมู่บ้านบ้านสวนสวรรค์</p>
                        <p>โทร: 089-xxx-xxxx</p>
                        <p>อีเมล: fund@example.com</p>
                        <p>เวลาทำการ: จ-ศ 09:00-16:00</p>
                    </div>
                </div>
            </div>

            {{-- ตัวอย่างที่ 3 --}}
            <div>
                <div class="flex justify-end mb-2">
                    <div class="bg-green-600 text-white rounded-lg px-4 py-2 max-w-xs">
                        <p>อยากฝากเงิน</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-700 text-gray-200 rounded-lg px-4 py-2 max-w-sm">
                        <p>การฝาก-ถอนเงิน กรุณาติดต่อเจ้าหน้าที่กองทุนโดยตรง หรือไปที่สำนักงานกองทุนในเวลาทำการ</p>
                    </div>
                </div>
            </div>

            {{-- ตัวอย่างที่ 4 --}}
            <div>
                <div class="flex justify-end mb-2">
                    <div class="bg-green-600 text-white rounded-lg px-4 py-2 max-w-xs">
                        <p>สวัสดีครับ</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-700 text-gray-200 rounded-lg px-4 py-2 max-w-sm">
                        <p>สวัสดีค่ะ ขอบคุณที่ติดต่อมา</p>
                        <p class="mt-2">คำสั่งที่ใช้ได้:</p>
                        <p>- พิมพ์ "ยอด" เพื่อดูข้อมูลสินเชื่อ</p>
                        <p>- พิมพ์ "ติดต่อ" เพื่อดูข้อมูลกองทุน</p>
                        <p>- พิมพ์ "ฝาก" หรือ "ถอน" สำหรับคำแนะนำ</p>
                    </div>
                </div>
            </div>
        </div>

        <x-guide-screenshot type="app" src="images/guide/line-oa/auto-reply.png" alt="ตอบกลับอัตโนมัติ" caption="ตัวอย่างการพิมพ์คำสั่งและคำตอบอัตโนมัติ" />
    </x-guide-step>

    <x-guide-tip type="info">
        LINE OA <strong>ตอบกลับอัตโนมัติ</strong>เท่านั้น ไม่ได้มีคนนั่งตอบ
        ถ้ามีเรื่องด่วนหรือต้องการคุยกับเจ้าหน้าที่จริงๆ ให้ <strong>โทรศัพท์</strong> หาเจ้าหน้าที่กองทุนโดยตรง
        (พิมพ์ "ติดต่อ" เพื่อดูเบอร์โทรศัพท์)
    </x-guide-tip>

    <x-guide-tip type="info">
        ระบบจะพัฒนาคำสั่งเพิ่มเติมในอนาคต เช่น ถามยอดเงินฝาก ถามจำนวนหุ้น
        ติดตามข่าวสารเพิ่มเติมผ่านแอปหรือเว็บไซต์
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
