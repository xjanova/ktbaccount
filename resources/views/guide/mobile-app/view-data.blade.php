@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        สมาชิกสามารถดูยอดสินเชื่อ เงินฝาก และหุ้นของตัวเองได้จากแอปมือถือ โดยไม่ต้องไปถามที่กองทุน
    </p>

    <x-guide-step :number="1" title="ดูยอดสินเชื่อ">
        <p>กดแท็บ <strong>"สินเชื่อ"</strong> ที่แถบด้านล่าง</p>
        <p>จะแสดงรายการสินเชื่อทั้งหมด: ยอดเงินกู้ ยอดคงเหลือ งวดถัดไป วันที่ต้องจ่าย</p>
        <x-guide-screenshot caption="แท็บสินเชื่อ แสดงยอดเงินกู้และงวดถัดไป" type="app" />
    </x-guide-step>

    <x-guide-step :number="2" title="ดูยอดเงินฝาก">
        <p>กดแท็บ <strong>"เงินฝาก"</strong> ที่แถบด้านล่าง</p>
        <p>จะแสดงบัญชีเงินฝากทั้งหมด: เลขที่บัญชี ยอดคงเหลือ</p>
        <p>กดที่บัญชีเพื่อดูประวัติการฝาก-ถอน</p>
        <x-guide-screenshot caption="แท็บเงินฝาก แสดงยอดคงเหลือ" type="app" />
    </x-guide-step>

    <x-guide-step :number="3" title="ดูยอดหุ้น">
        <p>กดแท็บ <strong>"เพิ่มเติม"</strong> แล้วเลือก <strong>"หุ้น"</strong></p>
        <p>จะแสดงจำนวนหุ้นที่ถืออยู่ และมูลค่ารวม</p>
        <x-guide-screenshot caption="ดูยอดหุ้นในเมนูเพิ่มเติม" type="app" />
    </x-guide-step>

    <x-guide-step :number="4" title="รีเฟรชข้อมูล">
        <p>ถ้าต้องการดูข้อมูลล่าสุด ให้ <strong>ลากหน้าจอลง</strong> (Pull down to refresh) เพื่ออัพเดทข้อมูล</p>
    </x-guide-step>

    <x-guide-tip type="tip">
        ข้อมูลจะอัพเดทอัตโนมัติเมื่อเปิดแอป แต่ถ้าเพิ่งทำรายการไป ให้ลากหน้าจอลงเพื่อรีเฟรช
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
