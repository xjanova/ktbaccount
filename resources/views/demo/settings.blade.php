@extends('layouts.app')

@section('page-title', 'ตั้งค่ากองทุน (โหมดทดลอง)')

@section('content')
{{-- Demo Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-600/20 to-orange-600/20 border border-amber-500/30">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div class="flex items-center gap-2">
            <span class="text-lg">🧪</span>
            <span class="text-amber-300 font-semibold text-sm">โหมดทดลองใช้งาน</span>
            <span class="text-amber-400/70 text-xs">- ข้อมูลตัวอย่าง ไม่ได้บันทึกจริง</span>
        </div>
        <a href="/register" class="px-4 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-medium rounded-lg transition-colors">ลงทะเบียนกองทุนจริง &rarr;</a>
    </div>
</div>

<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">ตั้งค่ากองทุน</h1>
        <p class="mt-1 text-gray-400">จัดการการตั้งค่าต่างๆ ของกองทุนหมู่บ้าน</p>
    </div>

    {{-- Fund Info --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-white border-b border-gray-700 pb-3 mb-5">ข้อมูลกองทุน</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">ชื่อกองทุน</label>
                <input type="text" value="กองทุนหมู่บ้านบ้านสวนสวรรค์" readonly class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">รหัสกองทุน</label>
                <input type="text" value="VF-001" readonly class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">จังหวัด</label>
                <input type="text" value="เชียงใหม่" readonly class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">เบอร์โทร</label>
                <input type="text" value="089-123-4567" readonly class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
            </div>
        </div>
    </div>

    {{-- LINE OA Settings --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-white border-b border-gray-700 pb-3 mb-5">ตั้งค่า LINE Official Account</h2>

        <div class="mb-4 rounded-xl p-4 bg-yellow-900/30 border border-yellow-700">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <span class="text-yellow-300 font-medium">ยังไม่ได้เชื่อมต่อ LINE OA</span>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-300 mb-2">Webhook URL</label>
            <div class="flex items-center gap-2">
                <input type="text" value="https://ktbaccount.xman4289.com/api/line/webhook/demo" readonly
                    class="flex-1 bg-gray-800 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-300 text-sm font-mono">
                <button class="px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition-colors">คัดลอก</button>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">Channel ID</label>
                <input type="text" placeholder="1234567890" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">Channel Secret</label>
                <input type="password" placeholder="*************" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">Channel Access Token</label>
                <textarea rows="2" placeholder="Channel Access Token" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm font-mono"></textarea>
            </div>
        </div>
    </div>

    {{-- Save Button (Demo) --}}
    <div class="flex justify-end">
        <button onclick="alert('โหมดทดลอง - ไม่ได้บันทึกจริง')" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
            บันทึกการตั้งค่า (ทดลอง)
        </button>
    </div>
</div>
@endsection
