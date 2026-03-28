@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีตั้งค่าข้อมูลกองทุนหมู่บ้านในระบบ
        ซึ่งเป็นขั้นตอนสำคัญที่ต้องทำหลังจากลงทะเบียนเรียบร้อยแล้ว
        เพื่อให้ข้อมูลกองทุนถูกต้องครบถ้วนก่อนเริ่มใช้งานจริง
    </p>

    <x-guide-step :number="1" title="ไปที่เมนู &quot;ตั้งค่า&quot;">
        <p>ที่แถบเมนูด้านซ้ายมือ ให้คลิกที่เมนู <strong>"ตั้งค่า"</strong>
        (มีรูปฟันเฟือง) เพื่อเข้าสู่หน้าตั้งค่ากองทุน</p>
        <x-guide-screenshot src="images/guide/getting-started/settings-menu.png" alt="เมนูตั้งค่าในแถบด้านข้าง" caption="คลิกที่เมนู &quot;ตั้งค่า&quot; ในแถบเมนูด้านซ้าย" />
    </x-guide-step>

    <x-guide-step :number="2" title="กรอกหรือแก้ไขข้อมูลกองทุน">
        <p>ในหน้าตั้งค่า ให้ตรวจสอบและกรอกข้อมูลกองทุนให้ครบถ้วน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อกองทุนหมู่บ้าน</strong> - ชื่อเต็มของกองทุน</li>
            <li><strong>รหัสกองทุน (ทะเบียนเลขที่)</strong> - เลขทะเบียนที่ได้รับจาก สทบ.</li>
            <li><strong>ที่อยู่</strong> - ที่อยู่ที่ตั้งของกองทุน</li>
            <li><strong>เบอร์โทรศัพท์</strong> - เบอร์ติดต่อกองทุน</li>
            <li><strong>อีเมล</strong> - อีเมลของกองทุน (ถ้ามี)</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/settings-fund-info.png" alt="หน้าตั้งค่าข้อมูลกองทุน" caption="กรอกข้อมูลกองทุนให้ครบทุกช่อง" />
    </x-guide-step>

    <x-guide-step :number="3" title="ตั้งค่าชุดบัญชี">
        <p><strong>ชุดบัญชีคืออะไร?</strong></p>
        <p>ชุดบัญชี คือ กลุ่มบัญชีที่แยกการบันทึกรายรับ-รายจ่ายตามประเภทเงินของกองทุน ตัวอย่างเช่น:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>บัญชีเงินล้าน</strong> - สำหรับเงินกองทุนหมู่บ้าน 1 ล้านบาท</li>
            <li><strong>บัญชีเงินเพิ่มทุน</strong> - สำหรับเงินเพิ่มทุนจากรัฐบาล</li>
            <li><strong>บัญชีเงินออมทรัพย์</strong> - สำหรับเงินออมของสมาชิก</li>
        </ul>
        <p>การแยกชุดบัญชีจะช่วยให้ท่านดูรายงานแยกตามประเภทเงินได้ง่าย</p>
        <x-guide-screenshot src="images/guide/getting-started/settings-account-sets.png" alt="หน้าตั้งค่าชุดบัญชี" caption="เพิ่มหรือแก้ไขชุดบัญชีของกองทุน" />
        <x-guide-tip type="tip">
            กองทุนส่วนใหญ่จะมีประมาณ 2-3 ชุดบัญชี ท่านสามารถเพิ่มชุดบัญชีเพิ่มเติมได้ภายหลัง
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="ตั้งค่าบัญชีธนาคาร">
        <p>เพิ่มข้อมูลบัญชีธนาคารของกองทุน เพื่อใช้ในการบันทึกรายการรับ-จ่ายผ่านธนาคาร:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>คลิกปุ่ม <strong>"เพิ่มบัญชีธนาคาร"</strong></li>
            <li>เลือกธนาคาร (เช่น ธนาคารกรุงไทย, ธนาคารออมสิน)</li>
            <li>กรอกเลขที่บัญชี</li>
            <li>กรอกชื่อบัญชี</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/settings-bank-accounts.png" alt="หน้าตั้งค่าบัญชีธนาคาร" caption="เพิ่มบัญชีธนาคารของกองทุน" />
    </x-guide-step>

    <x-guide-step :number="5" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลครบถ้วนแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong> เพื่อบันทึกการตั้งค่าทั้งหมด</p>
        <x-guide-tip type="important">
            ตรวจสอบข้อมูลให้ถูกต้องก่อนกดบันทึก โดยเฉพาะชื่อกองทุนและรหัสกองทุน
            เพราะข้อมูลเหล่านี้จะแสดงในรายงานและเอกสารต่างๆ
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
