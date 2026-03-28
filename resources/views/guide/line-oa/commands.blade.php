@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        สมาชิกสามารถพิมพ์ข้อความใน LINE OA ของกองทุนเพื่อสอบถามข้อมูลเบื้องต้นได้
        ระบบจะตอบกลับอัตโนมัติ
    </p>

    <x-guide-step :number="1" title="พิมพ์ 'ยอด' หรือ 'สินเชื่อ'">
        <p>พิมพ์คำว่า <strong>"ยอด"</strong> หรือ <strong>"สินเชื่อ"</strong></p>
        <p>ระบบจะแนะนำให้ดูรายละเอียดในแอปมือถือ ซึ่งจะแสดงข้อมูลครบถ้วนกว่า</p>
    </x-guide-step>

    <x-guide-step :number="2" title="พิมพ์ 'ฝาก' หรือ 'ถอน'">
        <p>พิมพ์คำว่า <strong>"ฝาก"</strong> หรือ <strong>"ถอน"</strong></p>
        <p>ระบบจะแจ้งให้ติดต่อเจ้าหน้าที่กองทุนโดยตรง เนื่องจากการฝาก-ถอนต้องทำที่กองทุน</p>
    </x-guide-step>

    <x-guide-step :number="3" title="พิมพ์ 'ติดต่อ'">
        <p>พิมพ์คำว่า <strong>"ติดต่อ"</strong></p>
        <p>ระบบจะแสดงข้อมูลติดต่อกองทุน เช่น เบอร์โทรศัพท์ ที่อยู่ เวลาทำการ</p>
    </x-guide-step>

    <x-guide-step :number="4" title="พิมพ์คำอื่นๆ">
        <p>ถ้าพิมพ์คำที่ระบบไม่รู้จัก จะตอบกลับอัตโนมัติพร้อมแนะนำคำที่ใช้ได้</p>
        <x-guide-screenshot src="images/guide/line-oa/auto-reply.png" alt="ตอบกลับอัตโนมัติ" caption="ระบบตอบกลับอัตโนมัติพร้อมแนะนำคำสั่ง" />
    </x-guide-step>

    <x-guide-tip type="info">
        LINE OA ตอบกลับอัตโนมัติเท่านั้น ไม่ได้มีคนมานั่งตอบ
        ถ้ามีเรื่องด่วน ให้โทรหากองทุนโดยตรง
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
