@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        การจัดสรรกำไรประจำปีเป็นขั้นตอนสำคัญที่ต้องทำทุกปี
        เพื่อนำกำไรของกองทุนมาแบ่งให้สมาชิกและใช้ประโยชน์ต่างๆ ตามมติที่ประชุมใหญ่
        หน้านี้จะอธิบายขั้นตอนทั้งหมดตั้งแต่ต้นจนจบ ให้เข้าใจง่าย
    </p>

    <x-guide-tip type="tip">
        ควรทำการจัดสรรกำไร <strong>ภายในไตรมาสแรกของปีถัดไป</strong> (ก่อน 31 มีนาคม) เช่น กำไรปี 2568 ควรจัดสรรให้เสร็จก่อน 31 มีนาคม 2569
    </x-guide-tip>

    <h3 class="text-xl font-bold text-white mt-8 mb-4">ขั้นตอนที่ 1: ตรวจสอบงบการเงินประจำปี</h3>
    <p>ก่อนจัดสรรกำไร ต้องตรวจสอบตัวเลขให้ถูกต้องก่อน ไปที่เมนู <strong>"รายงาน"</strong> แล้วตรวจสอบรายงานต่อไปนี้:</p>

    <h4 class="text-white font-semibold mt-4 mb-2">1.1 งบทดลอง</h4>
    <ul class="list-disc pl-5 space-y-2 mt-2">
        <li>ตรวจสอบว่า <strong>ยอดรวมเดบิต = ยอดรวมเครดิต</strong></li>
        <li>ถ้ายอดเท่ากัน &#10003; แสดงว่าบัญชีถูกต้อง</li>
        <li>ถ้ายอดไม่เท่ากัน &#10007; ต้องกลับไปตรวจสอบรายการบัญชีก่อน</li>
    </ul>

    <h4 class="text-white font-semibold mt-4 mb-2">1.2 งบกำไรขาดทุน</h4>
    <ul class="list-disc pl-5 space-y-2 mt-2">
        <li>ดูตัวเลข <strong>"กำไรสุทธิ"</strong> (หรือ "ขาดทุนสุทธิ" ถ้าขาดทุน)</li>
        <li>ตัวเลขนี้คือกำไรที่จะนำมาจัดสรร</li>
        <li>ถ้าเป็น <strong>กำไร</strong> → จัดสรรได้</li>
        <li>ถ้าเป็น <strong>ขาดทุน</strong> → ไม่มีกำไรให้จัดสรร ต้องบันทึกเป็นขาดทุนสะสม</li>
    </ul>

    <h4 class="text-white font-semibold mt-4 mb-2">1.3 งบดุล (งบแสดงฐานะการเงิน)</h4>
    <ul class="list-disc pl-5 space-y-2 mt-2">
        <li>ตรวจสอบว่า <strong>สินทรัพย์ = หนี้สิน + ทุน</strong></li>
        <li>ถ้าเท่ากัน &#10003; แสดงว่างบถูกต้อง</li>
    </ul>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ขั้นตอนที่ 2: ปิดบัญชีสิ้นปี</h3>
    <p>ก่อนจัดสรรกำไร ต้อง <strong>ปิดบัญชีสิ้นปี</strong> ก่อน เพื่อโอนกำไรเข้าบัญชีกำไรสะสม (รหัส 33010)</p>
    <ul class="list-disc pl-5 space-y-2 mt-2">
        <li>ไปที่เมนู <strong>"รายรับ-รายจ่าย"</strong> → เลือกชุดบัญชี</li>
        <li>คลิก <strong>"ประมวลผลสิ้นงวด"</strong></li>
        <li>เลือกเดือน <strong>ธันวาคม</strong> ของปีที่ต้องการปิด</li>
        <li>ระบบจะโอนกำไรสุทธิเข้าบัญชีกำไรสะสม (33010) อัตโนมัติ</li>
    </ul>
    <x-guide-tip type="important">
        ต้องปิดบัญชีสิ้นปีให้เสร็จ <strong>ก่อน</strong> จัดสรรกำไร ถ้ายังไม่ปิดบัญชี ตัวเลขกำไรสะสมจะไม่ถูกต้อง
    </x-guide-tip>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ขั้นตอนที่ 3: จัดประชุมใหญ่สามัญประจำปี</h3>
    <p>ตามระเบียบกองทุนหมู่บ้าน การจัดสรรกำไรต้องผ่าน <strong>มติที่ประชุมใหญ่สามัญประจำปี</strong></p>
    <ul class="list-disc pl-5 space-y-2 mt-2">
        <li>เตรียมงบการเงินประจำปี (งบทดลอง, งบกำไรขาดทุน, งบดุล) เพื่อเสนอต่อที่ประชุม</li>
        <li>แจ้งตัวเลข <strong>กำไรสุทธิ</strong> ให้สมาชิกทราบ</li>
        <li>เสนอแผนการจัดสรรกำไร (แบ่งเป็นหมวดต่างๆ)</li>
        <li>ให้สมาชิก <strong>ลงมติ</strong> อนุมัติการจัดสรร</li>
    </ul>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ขั้นตอนที่ 4: บันทึกมติจัดสรรกำไร</h3>
    <p>เมื่อที่ประชุมมีมติแล้ว ให้บันทึกในระบบ โดยแบ่งกำไรเป็นหมวดต่างๆ ดังนี้:</p>

    <h4 class="text-white font-semibold mt-4 mb-2">หมวดที่จัดสรรได้:</h4>

    <div class="space-y-4 mt-4">
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <h5 class="text-yellow-400 font-semibold mb-2">1. เงินสำรอง/ประกันความเสี่ยง</h5>
            <p class="text-gray-300">เงินที่เก็บไว้เพื่อ <strong>รองรับหนี้สูญ</strong> หรือความเสียหายที่อาจเกิดขึ้น เช่น สมาชิกกู้เงินแล้วไม่คืน เงินสำรองนี้จะช่วยให้กองทุนไม่ขาดทุน เหมือนเงินเก็บฉุกเฉินของกองทุน</p>
        </div>
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <h5 class="text-blue-400 font-semibold mb-2">2. เงินสมทบกองทุน</h5>
            <p class="text-gray-300">เงินที่นำไปเพิ่มทุนให้กองทุน ทำให้กองทุนมีเงินมากขึ้น สามารถปล่อยกู้ได้มากขึ้น หรือรับฝากเงินได้มากขึ้น ทำให้กองทุนเติบโตและแข็งแรง</p>
        </div>
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <h5 class="text-green-400 font-semibold mb-2">3. เงินเฉลี่ยคืนสมาชิก</h5>
            <p class="text-gray-300">เงินที่ <strong>แจกคืนให้สมาชิก</strong> ตามสัดส่วนหุ้นที่ถืออยู่ ใครถือหุ้นมากก็ได้เงินเฉลี่ยคืนมาก ใครถือหุ้นน้อยก็ได้น้อย เหมือนปันผลหุ้นของบริษัท</p>
        </div>
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <h5 class="text-purple-400 font-semibold mb-2">4. ทุนสาธารณประโยชน์</h5>
            <p class="text-gray-300">เงินที่ใช้เพื่อ <strong>ประโยชน์ของชุมชน</strong> ทั้งหมู่บ้าน เช่น ซ่อมถนน สร้างศาลา ช่วยเหลือผู้ประสบภัย จัดงานบุญ หรือกิจกรรมสาธารณะต่างๆ</p>
        </div>
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <h5 class="text-orange-400 font-semibold mb-2">5. ค่าตอบแทนคณะกรรมการ</h5>
            <p class="text-gray-300">เงินตอบแทนให้ <strong>คณะกรรมการ</strong> ที่ดูแลบริหารกองทุน เป็นค่าตอบแทนที่กรรมการสละเวลามาทำงานให้กองทุน</p>
        </div>
    </div>

    <x-guide-tip type="important">
        ร้อยละรวมทุกหมวด <strong>ต้องเท่ากับ 100.00% พอดี</strong> ถ้ารวมไม่ถึง 100% หรือเกิน 100% ระบบจะไม่ให้บันทึก
    </x-guide-tip>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ตัวอย่างการจัดสรรกำไร</h3>
    <p>สมมติกองทุนมี <strong>กำไรสุทธิ 100,000 บาท</strong> ที่ประชุมมีมติจัดสรรดังนี้:</p>

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="text-left py-2 px-3 text-gray-300">หมวด</th>
                    <th class="text-right py-2 px-3 text-gray-300">ร้อยละ</th>
                    <th class="text-right py-2 px-3 text-gray-300">จำนวนเงิน</th>
                </tr>
            </thead>
            <tbody class="text-gray-400">
                <tr class="border-b border-gray-800">
                    <td class="py-2 px-3">เงินสำรอง/ประกันความเสี่ยง</td>
                    <td class="py-2 px-3 text-right">25%</td>
                    <td class="py-2 px-3 text-right">25,000 บาท</td>
                </tr>
                <tr class="border-b border-gray-800">
                    <td class="py-2 px-3">เงินสมทบกองทุน</td>
                    <td class="py-2 px-3 text-right">10%</td>
                    <td class="py-2 px-3 text-right">10,000 บาท</td>
                </tr>
                <tr class="border-b border-gray-800">
                    <td class="py-2 px-3">เงินเฉลี่ยคืนสมาชิก</td>
                    <td class="py-2 px-3 text-right">30%</td>
                    <td class="py-2 px-3 text-right">30,000 บาท</td>
                </tr>
                <tr class="border-b border-gray-800">
                    <td class="py-2 px-3">ทุนสาธารณประโยชน์</td>
                    <td class="py-2 px-3 text-right">15%</td>
                    <td class="py-2 px-3 text-right">15,000 บาท</td>
                </tr>
                <tr class="border-b border-gray-800">
                    <td class="py-2 px-3">ค่าตอบแทนคณะกรรมการ</td>
                    <td class="py-2 px-3 text-right">20%</td>
                    <td class="py-2 px-3 text-right">20,000 บาท</td>
                </tr>
                <tr class="border-t-2 border-gray-600">
                    <td class="py-2 px-3 font-semibold text-white">รวม</td>
                    <td class="py-2 px-3 text-right font-semibold text-green-400">100%</td>
                    <td class="py-2 px-3 text-right font-semibold text-green-400">100,000 บาท &#10003;</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold text-white mt-10 mb-4">ขั้นตอนที่ 5: บันทึกในระบบ</h3>
    <p>นำมติจากที่ประชุมมาบันทึกลงในระบบ ดูวิธีละเอียดได้ที่หน้า <strong>"บันทึกจัดสรรกำไร"</strong> (หน้าถัดไป)</p>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
