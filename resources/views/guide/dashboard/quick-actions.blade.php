@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำปุ่มลัดต่างๆ ที่อยู่ในหน้าหลัก ซึ่งช่วยให้ท่านทำงานที่ใช้บ่อยได้อย่างรวดเร็ว
        โดยไม่ต้องเปิดเมนูหลายขั้นตอน
    </p>

    <x-guide-step :number="1" title="ปุ่ม &quot;บันทึกรายรับ&quot;">
        <p>คลิกปุ่ม <strong>"บันทึกรายรับ"</strong> เพื่อไปยังหน้าบันทึกรายรับทันที</p>
        <p>ใช้เมื่อกองทุนได้รับเงินเข้า เช่น:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>สมาชิกจ่ายค่าหุ้น</li>
            <li>สมาชิกฝากเงินออม</li>
            <li>ได้รับดอกเบี้ยจากธนาคาร</li>
            <li>ได้รับเงินสนับสนุนจากหน่วยงาน</li>
        </ul>
        <x-guide-screenshot src="images/guide/dashboard/quick-actions-buttons.png" alt="ปุ่มลัดบนหน้าหลัก" caption="ปุ่มลัดสำหรับทำงานที่ใช้บ่อย" />
    </x-guide-step>

    <x-guide-step :number="2" title="ปุ่ม &quot;บันทึกรายจ่าย&quot;">
        <p>คลิกปุ่ม <strong>"บันทึกรายจ่าย"</strong> เพื่อไปยังหน้าบันทึกรายจ่ายทันที</p>
        <p>ใช้เมื่อกองทุนจ่ายเงินออก เช่น:</p>
        <ul class="list-disc list-inside space-y-1 my-2">
            <li>จ่ายค่าเช่าสถานที่</li>
            <li>จ่ายค่าอุปกรณ์สำนักงาน</li>
            <li>จ่ายค่าตอบแทนกรรมการ</li>
            <li>ค่าใช้จ่ายในการดำเนินงาน</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="ปุ่ม &quot;รับชำระสินเชื่อ&quot;">
        <p>คลิกปุ่ม <strong>"รับชำระสินเชื่อ"</strong> เพื่อไปยังหน้ารับชำระสินเชื่อทันที</p>
        <p>ใช้เมื่อสมาชิกมาชำระเงินกู้คืนกองทุน ระบบจะช่วยคำนวณเงินต้นและดอกเบี้ยให้อัตโนมัติ</p>
    </x-guide-step>

    <x-guide-step :number="4" title="กล่องแจ้งเตือนสินเชื่อค้างชำระ">
        <p>ที่ด้านล่างของหน้าหลัก จะมี <strong>กล่องสีแดง</strong> แสดงรายการสินเชื่อที่เลยกำหนดชำระแล้ว
        ประกอบด้วย:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>ชื่อสมาชิก</strong> - ผู้กู้ที่ยังไม่ชำระ</li>
            <li><strong>จำนวนเงิน</strong> - ยอดเงินที่ต้องชำระ</li>
            <li><strong>วันครบกำหนด</strong> - วันที่ต้องชำระ (ซึ่งผ่านมาแล้ว)</li>
            <li><strong>จำนวนวันที่เลยกำหนด</strong> - เลยกำหนดมาแล้วกี่วัน</li>
        </ul>
        <x-guide-screenshot src="images/guide/dashboard/quick-actions-overdue.png" alt="กล่องแจ้งเตือนสินเชื่อค้างชำระ" caption="กล่องสีแดงแสดงรายการสินเชื่อที่เลยกำหนดชำระ" />
        <x-guide-tip type="warning">
            ควรตรวจสอบรายการสินเชื่อค้างชำระทุกวันที่เข้าสู่ระบบ
            และติดตามทวงถามสมาชิกที่เลยกำหนดชำระโดยเร็ว
            เพื่อไม่ให้ยอดค้างชำระสะสมมากขึ้น
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
