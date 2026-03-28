@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        สมาชิกกองทุนสามารถรับแจ้งเตือนผ่าน LINE ได้อัตโนมัติ เช่น เตือนก่อนถึงกำหนดชำระ
        แจ้งว่ารับเงินแล้ว แจ้งฝาก-ถอนเงิน แค่เพิ่มเพื่อน LINE OA ของกองทุน
    </p>

    <x-guide-step :number="1" title="เพิ่มเพื่อน LINE OA ของกองทุน">
        <p>เพิ่มเพื่อน LINE OA ของกองทุนได้ 2 วิธี:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>สแกน QR Code:</strong> สแกน QR Code ที่กองทุนแจกให้</li>
            <li><strong>ค้นหา ID:</strong> ค้นหาชื่อ LINE OA ของกองทุนในแอป LINE แล้วกด "เพิ่มเพื่อน"</li>
        </ul>
        <x-guide-screenshot src="images/guide/line-oa/add-friend.png" alt="เพิ่มเพื่อน LINE OA" caption="สแกน QR Code หรือค้นหาชื่อเพื่อเพิ่มเพื่อน" />
    </x-guide-step>

    <x-guide-step :number="2" title="รับแจ้งเตือนอัตโนมัติ">
        <p>เมื่อเพิ่มเพื่อนแล้ว จะได้รับแจ้งเตือนอัตโนมัติ ไม่ต้องตั้งค่าอะไรเพิ่ม:</p>
        <ul class="list-disc pl-5 space-y-2 mt-2">
            <li><strong>เตือนก่อนกำหนดชำระ:</strong> เตือนล่วงหน้า 7, 3, 1 วัน ก่อนถึงวันจ่ายเงินผ่อน</li>
            <li><strong>แจ้งรับชำระเรียบร้อย:</strong> เมื่อผู้ดูแลบันทึกว่ารับเงินแล้ว</li>
            <li><strong>แจ้งฝากเงิน:</strong> เมื่อบันทึกฝากเงินเข้าบัญชี</li>
            <li><strong>แจ้งถอนเงิน:</strong> เมื่อบันทึกถอนเงินจากบัญชี</li>
            <li><strong>ข่าวสารกองทุน:</strong> ประกาศ นัดประชุม ข่าวสำคัญ</li>
        </ul>
    </x-guide-step>

    <x-guide-tip type="tip">
        แค่เพิ่มเพื่อน LINE OA ทุกอย่างจะมาอัตโนมัติ ไม่ต้องตั้งค่าอะไรเพิ่มเติม สะดวกมาก
    </x-guide-tip>

    <x-guide-tip type="info">
        ถ้าไม่ได้รับแจ้งเตือน ให้ตรวจสอบว่าไม่ได้ปิดเสียงแจ้งเตือนของ LINE OA กองทุน
        และตรวจสอบว่ายังเป็นเพื่อนกับ LINE OA อยู่
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
