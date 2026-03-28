@extends('layouts.app')

@section('page-title', 'บันทึกรายการ (โหมดทดลอง)')

@section('content')
<div x-data="{ tab: 'income' }" class="max-w-3xl">

    {{-- Demo Banner --}}
    <div class="mb-6 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-600/20 to-orange-600/20 border border-amber-500/30">
        <div class="flex items-center gap-2">
            <span class="text-lg">🧪</span>
            <span class="text-amber-300 font-semibold text-sm">โหมดทดลอง</span>
            <span class="text-amber-400/70 text-xs">- ข้อมูลจะไม่ถูกบันทึกจริง</span>
        </div>
    </div>

    {{-- Back link --}}
    <a href="{{ route('demo.transactions.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
        กลับไปรายการ
    </a>

    {{-- Tab toggle --}}
    <div class="flex bg-gray-900 border border-gray-800 rounded-xl p-1 mb-6">
        <button type="button" @click="tab = 'income'"
                :class="tab === 'income' ? 'bg-green-600/20 text-green-400 border-green-600/30' : 'text-gray-400 hover:text-gray-200 border-transparent'"
                class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium border transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            รายรับ
        </button>
        <button type="button" @click="tab = 'expense'"
                :class="tab === 'expense' ? 'bg-red-600/20 text-red-400 border-red-600/30' : 'text-gray-400 hover:text-gray-200 border-transparent'"
                class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium border transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
            รายจ่าย
        </button>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('demo.transactions.store') }}" class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
        @csrf
        <input type="hidden" name="type" :value="tab">

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">เลือกชุดบัญชี <span class="text-red-400">*</span></label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option value="">-- เลือก --</option>
                <option selected>บัญชีหลัก - กองทุนตัวอย่าง</option>
            </select>
        </div>

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ลงบัญชี <span class="text-red-400">*</span></label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option value="cash">เงินสด</option>
                <option value="bank">เงินฝากธนาคาร</option>
            </select>
        </div>

        {{-- Income categories --}}
        <div x-show="tab === 'income'" x-transition>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ประเภทรายรับ <span class="text-red-400">*</span></label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option value="">-- เลือก --</option>
                <option>รับชำระสินเชื่อ</option>
                <option>รับฝากเงินสมาชิก</option>
                <option>รับค่าหุ้น</option>
                <option>ดอกเบี้ยรับ</option>
                <option>ค่าธรรมเนียม</option>
            </select>
        </div>

        {{-- Expense categories --}}
        <div x-show="tab === 'expense'" x-transition>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ประเภทรายจ่าย <span class="text-red-400">*</span></label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option value="">-- เลือก --</option>
                <option>จ่ายสินเชื่อ</option>
                <option>ค่าสาธารณูปโภค</option>
                <option>ค่าเดินทาง</option>
                <option>ค่าตอบแทนกรรมการ</option>
                <option>อื่นๆ</option>
            </select>
        </div>

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">วันที่ <span class="text-red-400">*</span></label>
            <input type="text" value="{{ now()->format('d/m/Y') }}" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">จำนวนเงิน (บาท) <span class="text-red-400">*</span></label>
            <input type="number" placeholder="0.00" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">รายละเอียด <span class="text-red-400">*</span></label>
            <textarea rows="3" placeholder="อธิบายรายละเอียดของรายการ" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm"></textarea>
        </div>

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">รับเงินจาก / จ่ายเงินให้</label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option value="member">สมาชิก</option>
                <option value="non_member">ไม่เป็นสมาชิก</option>
                <option value="other">อื่นๆ</option>
            </select>
        </div>

        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ชื่อบุคคล</label>
            <input type="text" placeholder="กรอกชื่อ หรือเลือกจากรายชื่อสมาชิก" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm">
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                บันทึก (ทดลอง)
            </button>
            <a href="{{ route('demo.transactions.index') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors">
                ยกเลิก
            </a>
        </div>
    </form>
</div>
@endsection
