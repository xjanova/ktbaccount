@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        แอปมือถือจะส่งแจ้งเตือนให้สมาชิกทราบเรื่องสำคัญต่างๆ โดยอัตโนมัติ เช่น ใกล้ถึงกำหนดชำระ
        รับเงินสำเร็จ หรือข่าวสารจากกองทุน
    </p>

    <x-guide-step :number="1" title="เปิดแท็บแจ้งเตือน">
        <p>กดแท็บ <strong>"แจ้งเตือน"</strong> ที่แถบด้านล่าง</p>
        <p>จะแสดงรายการแจ้งเตือนทั้งหมดเรียงจากใหม่ไปเก่า</p>
        <x-guide-screenshot caption="แท็บแจ้งเตือน แสดงรายการแจ้งเตือนทั้งหมด" type="app" />
    </x-guide-step>

    <x-guide-step :number="2" title="ประเภทแจ้งเตือน">
        <p>แจ้งเตือนมีหลายประเภท สังเกตจากสี:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><span class="text-orange-400 font-bold">สีส้ม</span> = <strong>ใกล้กำหนดชำระสินเชื่อ</strong> (เตือนว่าใกล้ถึงวันจ่ายเงินแล้ว)</li>
            <li><span class="text-green-400 font-bold">สีเขียว</span> = <strong>รับชำระเรียบร้อย</strong> (ยืนยันว่าจ่ายเงินแล้ว)</li>
            <li><span class="text-blue-400 font-bold">สีน้ำเงิน</span> = <strong>ฝากเงิน/ถอนเงิน</strong> (แจ้งรายการเงินฝาก)</li>
            <li><span class="text-purple-400 font-bold">สีม่วง</span> = <strong>ข่าวสารจากกองทุน</strong> (ประกาศ ข่าว นัดประชุม)</li>
        </ul>
    </x-guide-step>

    <x-guide-step :number="3" title="อ่านแจ้งเตือน">
        <p>กดที่แจ้งเตือนเพื่ออ่านรายละเอียด</p>
        <p><strong>จุดแดง</strong> หมายถึงยังไม่ได้อ่าน เมื่อกดอ่านแล้วจุดแดงจะหายไป</p>
        <x-guide-screenshot caption="กดอ่านแจ้งเตือน จุดแดงหมายถึงยังไม่ได้อ่าน" type="app" />
    </x-guide-step>

    <x-guide-tip type="tip">
        แจ้งเตือนจะมาอัตโนมัติ ไม่ต้องตั้งค่าอะไร แค่เปิดแอปก็เห็นแจ้งเตือนทั้งหมด
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
