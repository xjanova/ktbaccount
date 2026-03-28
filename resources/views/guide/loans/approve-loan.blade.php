@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีอนุมัติสัญญาสินเชื่อ เฉพาะผู้มีอำนาจเท่านั้นที่สามารถอนุมัติหรือไม่อนุมัติได้
    </p>

    <x-guide-step :number="1" title="เข้าเมนูอนุมัติสินเชื่อ">
        <p>คลิกที่เมนู <strong>"อนุมัติสินเชื่อ"</strong> ในแถบด้านข้างซ้ายมือ ระบบจะแสดงรายการสัญญาที่รออนุมัติ</p>
        <x-guide-screenshot src="images/guide/loans/menu-approve.png" alt="เมนูอนุมัติสินเชื่อ" caption="คลิกเมนู &quot;อนุมัติสินเชื่อ&quot; ในแถบด้านข้าง" />
        <x-guide-tip type="tip">
            ถ้ามีสัญญารออนุมัติ จะเห็นตัวเลขแจ้งเตือนที่เมนู บอกจำนวนสัญญาที่รอดำเนินการ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="2" title="เลือกสัญญาที่ต้องการดู">
        <p>ในตารางรายการ จะแสดงสัญญาที่รออนุมัติทั้งหมด ให้คลิกที่สัญญาที่ต้องการตรวจสอบ</p>
        <x-guide-screenshot src="images/guide/loans/pending-loan-list.png" alt="รายการสัญญารออนุมัติ" caption="คลิกเลือกสัญญาที่ต้องการตรวจสอบ" />
    </x-guide-step>

    <x-guide-step :number="3" title="ตรวจสอบรายละเอียดสัญญา">
        <p>ดูรายละเอียดสัญญาให้ครบถ้วน ตรวจสอบว่าข้อมูลถูกต้อง:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อผู้กู้</strong> - ตรวจสอบว่าเป็นสมาชิกที่ถูกต้อง</li>
            <li><strong>จำนวนเงินกู้</strong> - เช็คว่าอยู่ในวงเงินที่กองทุนอนุญาต</li>
            <li><strong>อัตราดอกเบี้ย</strong> - ตรงตามระเบียบกองทุนหรือไม่</li>
            <li><strong>จำนวนงวด</strong> - เหมาะสมกับจำนวนเงินหรือไม่</li>
            <li><strong>ผู้ค้ำประกัน</strong> - ครบตามระเบียบหรือไม่</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/loan-detail-review.png" alt="รายละเอียดสัญญา" caption="ตรวจสอบรายละเอียดสัญญาให้ครบทุกรายการ" />
    </x-guide-step>

    <x-guide-step :number="4" title="กดอนุมัติหรือไม่อนุมัติ">
        <p>เมื่อตรวจสอบเรียบร้อยแล้ว เลือกดำเนินการ:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>กดปุ่ม "อนุมัติ" (สีเขียว)</strong> - ถ้าข้อมูลถูกต้องครบถ้วน</li>
            <li><strong>กดปุ่ม "ไม่อนุมัติ" (สีแดง)</strong> - ถ้าข้อมูลไม่ถูกต้องหรือไม่ผ่านเงื่อนไข ระบบจะให้ใส่เหตุผลที่ไม่อนุมัติ</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/btn-approve-reject.png" alt="ปุ่มอนุมัติและไม่อนุมัติ" caption="เลือกกด &quot;อนุมัติ&quot; หรือ &quot;ไม่อนุมัติ&quot;" />
        <x-guide-tip type="warning">
            เมื่อกดอนุมัติแล้วจะไม่สามารถยกเลิกได้ ตรวจสอบให้แน่ใจก่อนกดอนุมัติ
        </x-guide-tip>
    </x-guide-step>

    <x-guide-step :number="5" title="ลงลายเซ็นผู้อนุมัติ">
        <p>ระบบจะแสดงหน้าลงลายเซ็นขึ้นมา ให้ผู้มีอำนาจลงลายเซ็นเพื่อยืนยันการอนุมัติ</p>
        <p>สามารถเซ็นด้วยนิ้วมือบนหน้าจอมือถือ หรือใช้เมาส์วาดบนคอมพิวเตอร์ได้</p>
        <x-guide-screenshot src="images/guide/loans/signature-pad.png" alt="หน้าลงลายเซ็น" caption="ลงลายเซ็นเพื่อยืนยันการอนุมัติ" />
        <x-guide-tip type="important">
            เมื่ออนุมัติสำเร็จ สถานะสัญญาจะเปลี่ยนเป็น "อนุมัติแล้ว" และสามารถเริ่มรับชำระเงินได้ทันที
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
