@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีตั้งค่าข้อมูลกองทุนหมู่บ้านในระบบ
        ซึ่งเป็นขั้นตอนสำคัญที่ต้องทำหลังจากลงทะเบียนเรียบร้อยแล้ว
        เพื่อให้ข้อมูลกองทุนถูกต้องครบถ้วนก่อนเริ่มใช้งานจริง
    </p>

    <x-guide-tip type="important">
        ข้อมูลที่ตั้งค่าในหน้านี้จะแสดงในรายงาน ใบสำคัญ และเอกสารทุกชนิด
        ควรกรอกให้ถูกต้องตั้งแต่แรก เพื่อไม่ต้องมาแก้ทีหลัง
    </x-guide-tip>

    <x-guide-step :number="1" title="ไปที่เมนู &quot;ตั้งค่า&quot;">
        <p>ที่แถบเมนูด้านซ้ายมือ ให้คลิกที่เมนู <strong>"ตั้งค่า"</strong>
        (มีรูปฟันเฟือง) เพื่อเข้าสู่หน้าตั้งค่ากองทุน</p>
        <x-guide-screenshot src="images/guide/getting-started/settings-menu.png" alt="เมนูตั้งค่าในแถบด้านข้าง" caption="คลิกที่เมนู &quot;ตั้งค่า&quot; ในแถบเมนูด้านซ้าย" />
    </x-guide-step>

    <x-guide-step :number="2" title="กรอกข้อมูลกองทุน">
        <p>ในหน้าตั้งค่า ให้ตรวจสอบและกรอกข้อมูลกองทุนให้ครบถ้วน:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อกองทุนหมู่บ้าน:</strong> ชื่อเต็มของกองทุน เช่น "กองทุนหมู่บ้านบ้านสวนสวรรค์"</li>
            <li><strong>รหัสกองทุน (ทะเบียนเลขที่):</strong> เลขทะเบียนที่ได้รับจาก สทบ.</li>
            <li><strong>ที่อยู่:</strong> ที่อยู่ที่ตั้งของกองทุน (หมู่บ้าน ตำบล อำเภอ จังหวัด)</li>
            <li><strong>เบอร์โทรศัพท์:</strong> เบอร์ติดต่อกองทุน (เบอร์ประธานหรือเจ้าหน้าที่)</li>
            <li><strong>อีเมล:</strong> อีเมลของกองทุน (ถ้ามี)</li>
        </ul>
        <x-guide-screenshot src="images/guide/getting-started/settings-fund-info.png" alt="หน้าตั้งค่าข้อมูลกองทุน" caption="กรอกข้อมูลกองทุนให้ครบทุกช่อง" />
        <x-guide-tip type="warning">
            ชื่อกองทุนและรหัสกองทุนจะปรากฏใน <strong>ทุกรายงาน</strong> และ <strong>ทุกใบสำคัญ</strong>
            ตรวจสอบให้ตรงกับข้อมูลที่ สทบ. บันทึกไว้
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="3" title="ตั้งค่าชุดบัญชี">
        <p><strong>ชุดบัญชีคืออะไร?</strong></p>
        <p>ชุดบัญชี คือ กลุ่มบัญชีที่แยกการบันทึกรายรับ-รายจ่ายตามประเภทเงินของกองทุน</p>

        <p class="mt-3"><strong>ตัวอย่างชุดบัญชีที่ใช้บ่อย:</strong></p>
        <div class="overflow-x-auto my-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="py-2 pr-4">ชื่อ</th>
                        <th class="py-2 pr-4">รหัส</th>
                        <th class="py-2">ใช้สำหรับ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-2 pr-4">บัญชีเงินล้าน</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">ML</td>
                        <td class="py-2">เงินกองทุนหมู่บ้าน 1 ล้านบาทแรก</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4">บัญชีเพิ่มทุน</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">AT</td>
                        <td class="py-2">เงินเพิ่มทุนระยะที่ 1-3</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4">บัญชีออมทรัพย์</td>
                        <td class="py-2 pr-4 font-mono text-indigo-400">SV</td>
                        <td class="py-2">เงินออมของสมาชิก</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p>การแยกชุดบัญชีจะช่วยให้ท่านดูรายงานแยกตามประเภทเงินได้ง่าย</p>
        <x-guide-screenshot src="images/guide/getting-started/settings-account-sets.png" alt="หน้าตั้งค่าชุดบัญชี" caption="เพิ่มหรือแก้ไขชุดบัญชีของกองทุน" />
        <x-guide-tip type="tip">
            กองทุนส่วนใหญ่จะมีประมาณ 2-3 ชุดบัญชี ท่านสามารถเพิ่มชุดบัญชีเพิ่มเติมได้ภายหลัง
            ระบบจะสร้างผังบัญชีมาตรฐานให้อัตโนมัติทุกชุดบัญชี
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="4" title="ตั้งค่าบัญชีธนาคาร">
        <p>เพิ่มข้อมูลบัญชีธนาคารของกองทุน เพื่อใช้ในการบันทึกรายการรับ-จ่ายผ่านธนาคาร:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>คลิกปุ่ม <strong>"เพิ่มบัญชีธนาคาร"</strong></li>
            <li>เลือกธนาคาร (เช่น ธนาคารกรุงไทย, ธนาคารออมสิน, ธ.ก.ส.)</li>
            <li>กรอกเลขที่บัญชี</li>
            <li>กรอกชื่อบัญชี</li>
            <li>กรอกสาขา</li>
        </ol>
        <x-guide-screenshot src="images/guide/getting-started/settings-bank-accounts.png" alt="หน้าตั้งค่าบัญชีธนาคาร" caption="เพิ่มบัญชีธนาคารของกองทุน" />
        <x-guide-tip type="info">
            เพิ่มบัญชีธนาคารทุกบัญชีที่กองทุนใช้อยู่ กองทุนส่วนใหญ่มี 1-3 บัญชี
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="ตั้งค่า LINE OA (ถ้ามี)">
        <p>ถ้ากองทุนมี LINE Official Account (LINE OA) สามารถเชื่อมต่อเพื่อ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li>ส่งแจ้งเตือนการชำระสินเชื่อให้สมาชิก</li>
            <li>แจ้งสมาชิกเมื่อมีการฝาก-ถอนเงิน</li>
            <li>สมาชิกสอบถามยอดผ่าน LINE</li>
        </ul>
        <p>วิธีตั้งค่า LINE OA อ่านเพิ่มเติมได้ในหมวด "LINE OA"</p>
    </x-guide-step>

    <x-guide-step :number="6" title="กดบันทึก">
        <p>เมื่อกรอกข้อมูลครบถ้วนแล้ว ให้กดปุ่ม <strong>"บันทึก"</strong> เพื่อบันทึกการตั้งค่าทั้งหมด</p>
        <p>ระบบจะแสดงข้อความ <strong>"บันทึกเรียบร้อย"</strong> เมื่อสำเร็จ</p>
    </x-guide-step>

    <x-guide-step :number="7" title="สรุปขั้นตอนตั้งค่า">
        <p>เช็คลิสต์สิ่งที่ต้องทำหลังลงทะเบียน:</p>
        <ol class="list-decimal list-inside space-y-2 my-4">
            <li>✅ กรอกชื่อกองทุนและรหัสกองทุน</li>
            <li>✅ กรอกที่อยู่และเบอร์ติดต่อ</li>
            <li>✅ เพิ่มชุดบัญชี (อย่างน้อย 1 ชุด)</li>
            <li>✅ เพิ่มบัญชีธนาคาร (ทุกบัญชีที่ใช้)</li>
            <li>✅ เชื่อมต่อ LINE OA (ถ้ามี)</li>
            <li>✅ เพิ่มผู้ใช้งานและกำหนดสิทธิ์</li>
        </ol>
        <x-guide-tip type="tip">
            เมื่อตั้งค่าครบแล้ว ก็พร้อมเริ่มใช้งานจริง! เริ่มจากการเพิ่มรายชื่อสมาชิก
            แล้วค่อยเริ่มบันทึกรายรับ-รายจ่าย
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
