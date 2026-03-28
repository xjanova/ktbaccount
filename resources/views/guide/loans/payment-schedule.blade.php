@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        หน้านี้จะแนะนำวิธีดูตารางผ่อนชำระของสัญญาสินเชื่อ
        เพื่อตรวจสอบว่าสมาชิกต้องจ่ายงวดละเท่าไหร่ และจ่ายไปแล้วกี่งวด
    </p>

    <x-guide-step :number="1" title="เปิดสัญญาสินเชื่อ">
        <p>เข้าเมนู <strong>"สินเชื่อ"</strong> แล้วคลิกเลือกสัญญาที่ต้องการดูตารางผ่อนชำระ</p>
        <x-guide-screenshot src="images/guide/loans/select-loan-for-schedule.png" alt="เลือกสัญญาสินเชื่อ" caption="คลิกเลือกสัญญาที่ต้องการดูตารางผ่อน" />
    </x-guide-step>

    <x-guide-step :number="2" title="คลิกดูตารางผ่อนชำระ">
        <p>ในหน้ารายละเอียดสัญญา ให้คลิกที่แถบ <strong>"ตารางผ่อนชำระ"</strong> ระบบจะแสดงตารางทุกงวดที่ต้องชำระ</p>
        <x-guide-screenshot src="images/guide/loans/tab-payment-schedule.png" alt="แถบตารางผ่อนชำระ" caption="คลิกแถบ &quot;ตารางผ่อนชำระ&quot; เพื่อดูรายละเอียด" />
    </x-guide-step>

    <x-guide-step :number="3" title="อ่านตารางผ่อนชำระ">
        <p>ตารางจะแสดงข้อมูลแต่ละงวดดังนี้:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><strong>งวดที่</strong> - ลำดับงวดการชำระ</li>
            <li><strong>วันครบกำหนด</strong> - วันที่ต้องชำระเงินในแต่ละงวด</li>
            <li><strong>เงินต้น</strong> - ส่วนที่เป็นเงินต้นในงวดนั้น</li>
            <li><strong>ดอกเบี้ย</strong> - ส่วนที่เป็นดอกเบี้ยในงวดนั้น</li>
            <li><strong>รวมต้องชำระ</strong> - ยอดรวมที่ต้องจ่ายในงวดนั้น</li>
            <li><strong>ยอดคงเหลือ</strong> - เงินต้นที่เหลืออยู่หลังชำระงวดนั้น</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/payment-schedule-table.png" alt="ตารางผ่อนชำระ" caption="ตารางแสดงรายละเอียดทุกงวด" />
    </x-guide-step>

    <x-guide-step :number="4" title="สังเกตสีสถานะของแต่ละงวด">
        <p>แต่ละงวดจะมีสีบอกสถานะให้เข้าใจง่าย:</p>
        <ul class="list-disc list-inside space-y-2 my-4">
            <li><span class="inline-block w-4 h-4 bg-yellow-500 rounded mr-2 align-middle"></span><strong>สีเหลือง = รอชำระ</strong> - ยังไม่ถึงกำหนดหรือรอสมาชิกมาจ่าย</li>
            <li><span class="inline-block w-4 h-4 bg-green-500 rounded mr-2 align-middle"></span><strong>สีเขียว = ชำระแล้ว</strong> - สมาชิกจ่ายเงินเรียบร้อยแล้ว</li>
            <li><span class="inline-block w-4 h-4 bg-red-500 rounded mr-2 align-middle"></span><strong>สีแดง = เลยกำหนด</strong> - เลยวันที่ต้องจ่ายแล้วแต่ยังไม่ได้ชำระ</li>
        </ul>
        <x-guide-screenshot src="images/guide/loans/schedule-status-colors.png" alt="สีสถานะงวดผ่อน" caption="สีเหลือง=รอ สีเขียว=ชำระแล้ว สีแดง=เลยกำหนด" />
        <x-guide-tip type="tip">
            ถ้าเห็นงวดสีแดง แสดงว่าสมาชิกค้างชำระ ควรติดต่อแจ้งเตือนโดยเร็ว
        </x-guide-tip>
    </x-guide-step>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
