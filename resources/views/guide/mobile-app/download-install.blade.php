@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        แอปมือถือ KTB Account เป็นแอปสำหรับสมาชิกกองทุนหมู่บ้าน ใช้ดูข้อมูลของตัวเองได้สะดวกบนมือถือ
        ไม่ต้องเดินทางไปถามที่กองทุน สามารถดูยอดสินเชื่อ ยอดเงินฝาก จำนวนหุ้น รับแจ้งเตือนครบกำหนดชำระ
        และข่าวสารจากกองทุนได้ทุกที่ทุกเวลา
    </p>

    <x-guide-tip type="info">
        แอปนี้ใช้ได้เฉพาะมือถือ <strong>แอนดรอยด์ (Android)</strong> เท่านั้น ยังไม่รองรับ iPhone (iOS)
        แอปใช้พื้นที่ประมาณ 30-50 MB บนมือถือของท่าน
    </x-guide-tip>

    <x-guide-step :number="1" title="เปิดแอป Google Chrome บนมือถือ">
        <p>มองหาไอคอน (รูปวงกลมสีแดง เขียว เหลือง น้ำเงิน) ที่หน้าจอมือถือ แล้ว <strong>กดที่ไอคอนนั้น 1 ครั้ง</strong></p>
        <p>ถ้าหาไม่เจอ ลองปัดหน้าจอไปทางซ้ายหรือขวา หรือเปิดลิ้นชักแอป (กดปุ่มจุด 3 จุดหรือลูกศรชี้ขึ้นด้านล่างหน้าจอ)</p>
        <p>ถ้าไม่มีแอป Chrome สามารถใช้เบราว์เซอร์อื่นที่มีในมือถือได้ เช่น Samsung Internet หรือ Firefox</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/chrome-icon.png" alt="ไอคอน Chrome" caption="ไอคอน Google Chrome บนหน้าจอมือถือ" />
    </x-guide-step>

    <x-guide-step :number="2" title="พิมพ์ที่อยู่เว็บไซต์">
        <p>เมื่อเปิด Chrome แล้ว ให้ <strong>กดที่ช่องด้านบนสุด</strong> ของหน้าจอ (ช่องที่มีตัวอักษรหรือรูปแว่นขยาย)</p>
        <p>พิมพ์คำว่า:</p>
        <div class="bg-gray-800 rounded-lg p-4 my-3">
            <code class="text-green-400 text-lg">https://ktbaccount.xman4289.com</code>
        </div>
        <p>พิมพ์ให้ครบทุกตัวอักษร แล้ว <strong>กดปุ่ม "ไป" หรือ "Enter"</strong> บนแป้นพิมพ์</p>
        <p>รอสักครู่ หน้าเว็บไซต์ระบบกองทุนจะแสดงขึ้นมา</p>
    </x-guide-step>

    <x-guide-step :number="3" title="กดลิงก์ดาวน์โหลดแอป">
        <p>เมื่อหน้าเว็บแสดงขึ้นมาแล้ว ให้มองหาปุ่มหรือลิงก์ที่เขียนว่า <strong>"ดาวน์โหลดแอป"</strong></p>
        <p>กดที่ลิงก์นั้น 1 ครั้ง ระบบจะพาไปหน้าดาวน์โหลด</p>
        <x-guide-tip type="info">
            แอปนี้ <strong>ไม่ได้อยู่บน Google Play Store</strong> เพราะเป็นแอปเฉพาะกองทุนหมู่บ้าน
            ต้องดาวน์โหลดจากเว็บไซต์ของระบบเท่านั้น ซึ่งเป็นเรื่องปกติและปลอดภัย
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="เลือกไฟล์ที่ตรงกับรุ่นมือถือ">
        <p>ในหน้าดาวน์โหลด จะมีไฟล์ให้เลือก 2 แบบ:</p>
        <div class="bg-gray-800 rounded-lg p-4 my-3 space-y-3">
            <div class="flex items-start gap-3">
                <span class="bg-green-600 text-white px-3 py-1 rounded font-bold text-sm whitespace-nowrap">arm64</span>
                <span>สำหรับมือถือรุ่นใหม่ (ผลิตตั้งแต่ปี 2020 ขึ้นไป) - <strong>ส่วนใหญ่เลือกอันนี้</strong></span>
            </div>
            <div class="flex items-start gap-3">
                <span class="bg-yellow-600 text-white px-3 py-1 rounded font-bold text-sm whitespace-nowrap">arm</span>
                <span>สำหรับมือถือรุ่นเก่า (ผลิตก่อนปี 2020)</span>
            </div>
        </div>
        <x-guide-tip type="tip">
            ถ้าไม่แน่ใจว่ามือถือเป็นรุ่นไหน ให้ <strong>เลือก arm64 ก่อน</strong>
            ถ้าติดตั้งไม่ได้ ค่อยกลับมาเลือก arm แทน
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="กดดาวน์โหลด">
        <p>กดที่ชื่อไฟล์ที่เลือก (จะมีนามสกุล <strong>.apk</strong>) เพื่อเริ่มดาวน์โหลด</p>
        <p>มือถืออาจถามว่า "ต้องการดาวน์โหลดไฟล์นี้หรือไม่?" ให้กด <strong>"ดาวน์โหลด"</strong> หรือ <strong>"ตกลง"</strong></p>
        <p>รอจนดาวน์โหลดเสร็จ (ดูแถบความคืบหน้าด้านบนหน้าจอ หรือแถบแจ้งเตือน)</p>
        <p>ใช้เวลาประมาณ 1-3 นาที ขึ้นอยู่กับความเร็วอินเทอร์เน็ต</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/download-page.png" alt="หน้าดาวน์โหลด" caption="กดดาวน์โหลดไฟล์ .apk" />
    </x-guide-step>

    <x-guide-step :number="6" title="เปิดไฟล์ที่ดาวน์โหลด">
        <p>เมื่อดาวน์โหลดเสร็จ จะมีแจ้งเตือนว่า "ดาวน์โหลดเสร็จแล้ว" ให้ <strong>กดที่แจ้งเตือนนั้น</strong> เพื่อเปิดไฟล์</p>
        <p>หรือเปิดแอป <strong>"ไฟล์" (Files)</strong> หรือ <strong>"ดาวน์โหลด" (Downloads)</strong> ในมือถือ แล้วกดที่ไฟล์ที่เพิ่งดาวน์โหลด</p>

        <div class="bg-yellow-900/30 border border-yellow-600 rounded-lg p-4 my-4">
            <p class="font-bold text-yellow-400 mb-2">มือถืออาจแสดงข้อความ "ไม่อนุญาตให้ติดตั้งแอปจากแหล่งนี้"</p>
            <p class="mb-2">นี่เป็นขั้นตอนปกติ ให้ทำตามนี้:</p>
            <ol class="list-decimal pl-5 space-y-2">
                <li>กดปุ่ม <strong>"ตั้งค่า" (Settings)</strong> ที่ปรากฏในข้อความ</li>
                <li>จะเปิดหน้าตั้งค่า ให้เปิดสวิตช์ <strong>"อนุญาตจากแหล่งนี้" (Allow from this source)</strong> ให้เป็นสีเขียวหรือสีน้ำเงิน</li>
                <li>กดปุ่ม <strong>ย้อนกลับ</strong> (ลูกศรชี้ซ้ายด้านล่างหน้าจอ) เพื่อกลับไปหน้าติดตั้ง</li>
            </ol>
        </div>

        <x-guide-tip type="warning">
            ขั้นตอนนี้เป็นเรื่องปกติและปลอดภัย เพราะแอปนี้ไม่ได้อยู่บน Play Store
            มือถือจึงถามยืนยันเพื่อความปลอดภัย ท่านอนุญาตได้อย่างสบายใจ
        </x-guide-tip>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/allow-install.png" alt="หน้าขออนุญาต" caption="เปิดอนุญาตติดตั้งจากแหล่งนี้" />
    </x-guide-step>

    <x-guide-step :number="7" title="กดติดตั้ง (Install)">
        <p>หน้าจอจะแสดงข้อมูลแอป ให้กดปุ่ม <strong>"ติดตั้ง" (Install)</strong></p>
        <p>รอสักครู่ ประมาณ 30 วินาที ถึง 1 นาที ระบบจะติดตั้งแอปลงในมือถือ</p>
        <p>จะเห็นแถบความคืบหน้าวิ่งไปเรื่อยๆ จนเสร็จ</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/installing.png" alt="หน้าติดตั้ง" caption="กดติดตั้งแล้วรอจนเสร็จ" />
    </x-guide-step>

    <x-guide-step :number="8" title="กดเปิดแอป (Open)">
        <p>เมื่อติดตั้งเสร็จ จะมีปุ่ม 2 ปุ่ม ให้กดปุ่ม <strong>"เปิด" (Open)</strong></p>
        <p>แอปจะเปิดขึ้นมา แสดงหน้า Splash Screen (หน้าจอโลโก้ XMAN Studio) สักครู่</p>
        <p>หลังจากนั้นจะเข้าสู่หน้าเข้าสู่ระบบ</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/splash-screen.png" alt="หน้า splash" caption="หน้าจอโลโก้เมื่อเปิดแอปครั้งแรก" />
    </x-guide-step>

    <x-guide-tip type="tip">
        หลังติดตั้งเสร็จ จะมีไอคอนแอป <strong>KTB Account</strong> อยู่บนหน้าจอมือถือ
        ครั้งต่อไปแค่กดที่ไอคอนนี้ก็เปิดแอปได้เลย ไม่ต้องติดตั้งใหม่
    </x-guide-tip>

    <x-guide-tip type="info">
        ถ้าติดตั้งไม่สำเร็จหรือมีปัญหา ลองทำตามนี้:
        <ul class="list-disc pl-5 mt-2 space-y-1">
            <li>ตรวจสอบว่ามือถือมีพื้นที่ว่างเพียงพอ (อย่างน้อย 100 MB)</li>
            <li>ลองเลือกไฟล์อีกแบบ (ถ้าเลือก arm64 ไม่ได้ ลองเลือก arm)</li>
            <li>ตรวจสอบว่าเปิดอนุญาตติดตั้งจากแหล่งภายนอกแล้ว</li>
            <li>ลองดาวน์โหลดใหม่อีกครั้ง</li>
            <li>ถ้ายังไม่ได้ ให้ติดต่อเจ้าหน้าที่กองทุนเพื่อขอความช่วยเหลือ</li>
        </ul>
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
