@extends('layouts.guide')

@section('guide-content')
<div class="prose prose-invert max-w-none">
    <p class="text-lg text-gray-300 mb-8">
        แอปมือถือสำหรับสมาชิกกองทุนหมู่บ้าน ใช้ดูยอดสินเชื่อ เงินฝาก หุ้น และรับแจ้งเตือน
    </p>

    <x-guide-step :number="1" title="เปิดเว็บในมือถือ">
        <p>เปิดเบราว์เซอร์ในมือถือ แล้วไปที่เว็บไซต์ระบบกองทุน</p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/download-page.png" alt="หน้าดาวน์โหลด" caption="เปิดหน้าดาวน์โหลดแอป" />
    </x-guide-step>

    <x-guide-step :number="2" title="ดาวน์โหลด APK">
        <p>คลิกปุ่มดาวน์โหลด เลือกเวอร์ชัน <strong>arm64</strong> (มือถือรุ่นใหม่ใช้ตัวนี้)</p>
    </x-guide-step>

    <x-guide-step :number="3" title="อนุญาตติดตั้งจากแหล่งภายนอก">
        <p>มือถือจะถามว่าอนุญาตติดตั้งจากแหล่งภายนอกหรือไม่ ให้กด <strong>"อนุญาต"</strong></p>
        <p>เพราะแอปนี้ไม่ได้อยู่ใน Play Store ต้องอนุญาตให้ติดตั้งได้</p>
    </x-guide-step>

    <x-guide-step :number="4" title="ติดตั้งแอป">
        <p>คลิก <strong>"ติดตั้ง"</strong> รอจนเสร็จ แล้วคลิก <strong>"เปิด"</strong></p>
        <x-guide-screenshot type="app" src="images/guide/mobile-app/install-complete.png" alt="ติดตั้งเสร็จ" caption="ติดตั้งเสร็จแล้ว กดเปิดแอป" />
    </x-guide-step>

    <x-guide-tip type="warning">
        แอปนี้ <strong>ไม่ได้อยู่ใน Play Store</strong> ต้องดาวน์โหลดจากเว็บไซต์ของระบบเท่านั้น
        ถ้ามือถือบล็อกการติดตั้ง ให้ไปที่ตั้งค่า > ความปลอดภัย > อนุญาตติดตั้งจากแหล่งภายนอก
    </x-guide-tip>
</div>

<x-guide-nav :prevPage="$prevPage" :nextPage="$nextPage" />
@endsection
