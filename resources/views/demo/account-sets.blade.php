@extends('layouts.app')

@section('page-title', 'ชุดบัญชี (โหมดทดลอง)')

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

<div class="mb-6">
    <h2 class="text-xl font-bold text-white">ชุดบัญชี (ผังบัญชี)</h2>
    <p class="text-sm text-gray-400 mt-1">จัดการชุดบัญชีสำหรับบันทึกรายการบัญชีกองทุน</p>
</div>

{{-- Account Sets --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
        <h3 class="text-base font-semibold text-white">รายการชุดบัญชี</h3>
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            สร้างชุดบัญชีใหม่
        </button>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400">
                <th class="px-5 py-3 text-left">ชื่อชุดบัญชี</th>
                <th class="px-5 py-3 text-center">จำนวนบัญชี</th>
                <th class="px-5 py-3 text-left">สถานะ</th>
                <th class="px-5 py-3 text-left">สร้างเมื่อ</th>
                <th class="px-5 py-3 text-center">ดำเนินการ</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800/50">
            <tr class="hover:bg-gray-800/30 transition-colors">
                <td class="px-5 py-3 text-gray-300 font-medium">บัญชีหลัก - กองทุนตัวอย่าง</td>
                <td class="px-5 py-3 text-center text-gray-400">25</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 text-xs rounded-full bg-emerald-500/20 text-emerald-400">ใช้งาน</span></td>
                <td class="px-5 py-3 text-gray-400 text-xs">1 ม.ค. 2569</td>
                <td class="px-5 py-3 text-center">
                    <button class="p-1.5 rounded-lg text-gray-400 hover:text-primary-400 hover:bg-gray-800 transition-colors" title="ดูรายละเอียด">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Sample Accounts --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-800">
        <h3 class="text-base font-semibold text-white">ตัวอย่างผังบัญชี - บัญชีหลัก</h3>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400">
                <th class="px-5 py-3 text-left">รหัสบัญชี</th>
                <th class="px-5 py-3 text-left">ชื่อบัญชี</th>
                <th class="px-5 py-3 text-left">หมวด</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800/50">
            @foreach([
                ['11000', 'เงินสด', 'สินทรัพย์'],
                ['11100', 'เงินฝากธนาคาร', 'สินทรัพย์'],
                ['12000', 'ลูกหนี้เงินกู้', 'สินทรัพย์'],
                ['21000', 'เงินรับฝากจากสมาชิก', 'หนี้สิน'],
                ['31000', 'ทุนหุ้น', 'ส่วนของทุน'],
                ['41000', 'ดอกเบี้ยรับ', 'รายได้'],
                ['42000', 'ค่าธรรมเนียม', 'รายได้'],
                ['51000', 'ค่าตอบแทนกรรมการ', 'ค่าใช้จ่าย'],
                ['52000', 'ค่าสาธารณูปโภค', 'ค่าใช้จ่าย'],
            ] as $account)
            <tr class="hover:bg-gray-800/30 transition-colors">
                <td class="px-5 py-3 text-gray-300 font-mono">{{ $account[0] }}</td>
                <td class="px-5 py-3 text-gray-300">{{ $account[1] }}</td>
                <td class="px-5 py-3">
                    @php
                        $colors = ['สินทรัพย์' => 'blue', 'หนี้สิน' => 'red', 'ส่วนของทุน' => 'purple', 'รายได้' => 'emerald', 'ค่าใช้จ่าย' => 'amber'];
                        $c = $colors[$account[2]] ?? 'gray';
                    @endphp
                    <span class="px-2 py-0.5 text-xs rounded-full bg-{{ $c }}-500/20 text-{{ $c }}-400">{{ $account[2] }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
