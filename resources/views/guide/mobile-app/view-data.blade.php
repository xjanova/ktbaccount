@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        สมาชิกสามารถดูยอดสินเชื่อ เงินฝาก และหุ้นของตัวเองได้จากแอปมือถือ
        ไม่ต้องเดินทางไปถามที่กองทุน ดูได้ทุกที่ทุกเวลา ข้อมูลเป็นปัจจุบันเสมอ
    </p>

    <x-guide-tip type="info">
        ข้อมูลทั้งหมดดึงจากเซิร์ฟเวอร์ (คอมพิวเตอร์กลาง) ทุกครั้งที่เปิดดู
        จึงเป็นข้อมูลล่าสุดเสมอ ไม่ต้องกังวลว่าข้อมูลจะเก่า
    </x-guide-tip>

    <h3 class="text-xl font-bold text-white mt-8 mb-4">ดูยอดสินเชื่อ</h3>

    <x-guide-step :number="1" title="กดแถบ 'สินเชื่อ' ด้านล่าง">
        <p>มองที่ <strong>แถบด้านล่างสุด</strong> ของหน้าจอ จะเห็นเมนูหลายอัน</p>
        <p>กดที่คำว่า <strong>"สินเชื่อ"</strong> (ตัวที่ 2 จากซ้าย)</p>
        <p>ระบบจะแสดงรายการสินเชื่อทั้งหมดของท่าน</p>
    </x-guide-step>

    <x-guide-step :number="2" title="อ่านข้อมูลสินเชื่อ">
        <p>แต่ละรายการสินเชื่อจะแสดงข้อมูลดังนี้:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>รหัสสัญญา</strong> - เช่น LN2569-00001 (ใช้อ้างอิงเมื่อติดต่อกองทุน)</li>
            <li><strong>ยอดเงินกู้</strong> - จำนวนเงินที่กู้ทั้งหมด เช่น 50,000 บาท</li>
            <li><strong>ยอดคงเหลือ</strong> - จำนวนเงินที่ยังต้องชำระ เช่น 35,000 บาท</li>
            <li><strong>สถานะ</strong> - สถานะปัจจุบันของสินเชื่อ</li>
        </ul>

        <p class="mt-4"><strong>สีบอกสถานะ:</strong></p>
        <div class="space-y-2 mt-2">
            <div class="flex items-center gap-3">
                <span class="inline-block w-4 h-4 rounded-full bg-green-500"></span>
                <span><strong>สีเขียว = ปกติ</strong> - ชำระตรงเวลา ไม่มีปัญหา</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-block w-4 h-4 rounded-full bg-red-500"></span>
                <span><strong>สีแดง = เลยกำหนดชำระ</strong> - เกินวันที่ต้องจ่ายแล้ว ต้องรีบติดต่อกองทุน</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-block w-4 h-4 rounded-full bg-gray-500"></span>
                <span><strong>สีเทา = ชำระครบแล้ว</strong> - จ่ายเงินครบหมดแล้ว ไม่ต้องจ่ายอีก</span>
            </div>
        </div>
    </x-guide-step>

    <x-guide-step :number="3" title="ดูตารางผ่อนชำระ">
        <p>กดที่รายการสินเชื่อที่ต้องการดูรายละเอียด</p>
        <p>จะแสดงข้อมูลเพิ่มเติม:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>ตารางผ่อนชำระ</strong> - แสดงทุกงวดว่าต้องจ่ายเท่าไหร่ วันไหน จ่ายแล้วหรือยัง</li>
            <li><strong>Progress bar (แถบความคืบหน้า)</strong> - แสดงว่าชำระไปแล้วกี่เปอร์เซ็นต์ของยอดทั้งหมด</li>
            <li><strong>งวดถัดไป</strong> - จำนวนเงินและวันที่ต้องจ่ายงวดถัดไป</li>
        </ul>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/loan-detail.png" alt="รายละเอียดสินเชื่อ" caption="กดที่รายการสินเชื่อเพื่อดูตารางผ่อนชำระและความคืบหน้า" />
    </x-guide-step>

    <h3 class="text-xl font-bold text-white mt-8 mb-4">ดูยอดเงินฝาก</h3>

    <x-guide-step :number="4" title="กดแถบ 'เงินฝาก' ด้านล่าง">
        <p>กดที่คำว่า <strong>"เงินฝาก"</strong> ที่แถบด้านล่าง (ตัวที่ 3 จากซ้าย)</p>
        <p>ระบบจะแสดงบัญชีเงินฝากทั้งหมดของท่าน</p>
    </x-guide-step>

    <x-guide-step :number="5" title="อ่านข้อมูลเงินฝาก">
        <p>แต่ละบัญชีเงินฝากจะแสดง:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>เลขที่บัญชี</strong> - เช่น SAV-000001</li>
            <li><strong>ยอดคงเหลือ</strong> - จำนวนเงินในบัญชี (ตัวเลขใหญ่ตรงกลาง)</li>
            <li><strong>ประวัติฝาก/ถอนล่าสุด</strong> - รายการล่าสุดที่ฝากหรือถอน</li>
        </ul>
        <p class="mt-3">กดที่บัญชีเพื่อดูประวัติการฝาก-ถอนทั้งหมด เรียงจากรายการล่าสุดไปเก่าสุด</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/savings-list.png" alt="บัญชีเงินฝาก" caption="แสดงยอดคงเหลือเงินฝากและประวัติล่าสุด" />
    </x-guide-step>

    <h3 class="text-xl font-bold text-white mt-8 mb-4">ดูยอดหุ้น</h3>

    <x-guide-step :number="6" title="เข้าเมนู 'อื่นๆ' แล้วกด 'หุ้น'">
        <p>กดที่คำว่า <strong>"อื่นๆ"</strong> ที่แถบด้านล่าง (ตัวสุดท้ายทางขวา)</p>
        <p>จะเห็นเมนูย่อยหลายรายการ ให้กดที่ <strong>"หุ้น"</strong></p>
        <p>ระบบจะแสดงข้อมูลหุ้น:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>จำนวนหุ้นที่ถือ</strong> - เช่น 50 หุ้น</li>
            <li><strong>มูลค่าต่อหุ้น</strong> - เช่น หุ้นละ 100 บาท</li>
            <li><strong>มูลค่ารวม</strong> - เช่น 5,000 บาท</li>
        </ul>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/shares-view.png" alt="ดูยอดหุ้น" caption="ข้อมูลหุ้นที่ถืออยู่ในกองทุน" />
    </x-guide-step>

    <h3 class="text-xl font-bold text-white mt-8 mb-4">รีเฟรชข้อมูลล่าสุด</h3>

    <x-guide-step :number="7" title="ดึงหน้าจอลงเพื่อรีเฟรช">
        <p>ถ้าเพิ่งทำรายการไป (เช่น เพิ่งจ่ายเงินที่กองทุน) แต่ยังไม่เห็นข้อมูลอัพเดท</p>
        <p>ให้ <strong>ใช้นิ้วกดค้างแล้วลากหน้าจอลงด้านล่าง</strong> (Pull down) แล้วปล่อย</p>
        <p>จะเห็นไอคอนหมุนสักครู่ แสดงว่ากำลังดึงข้อมูลใหม่จากเซิร์ฟเวอร์</p>
        <p>เมื่อเสร็จ ข้อมูลจะอัพเดทเป็นล่าสุด</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        <strong>ดึงลง (Pull down) เพื่อรีเฟรช</strong> ใช้ได้ทุกหน้า ทั้งสินเชื่อ เงินฝาก และหุ้น
        ถ้าข้อมูลยังไม่อัพเดท อาจเป็นเพราะเจ้าหน้าที่ยังไม่ได้บันทึกรายการในระบบ
    </x-guide-tip>

    <x-guide-tip type="warning">
        ท่านสามารถ <strong>ดูข้อมูลได้อย่างเดียว</strong> ไม่สามารถแก้ไขหรือทำรายการผ่านแอปได้
        การชำระเงิน ฝาก ถอน ต้องทำที่กองทุนหรือผ่านเจ้าหน้าที่เท่านั้น
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
