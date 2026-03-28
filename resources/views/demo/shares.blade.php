@extends('layouts.app')

@section('page-title', 'หุ้น (โหมดทดลอง)')

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

{{-- Summary --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <p class="text-sm text-gray-400">มูลค่าหุ้นรวม</p>
        <p class="text-2xl font-bold text-white mt-1">{{ number_format(array_sum(array_column($members, 'shares')) * 1000, 2) }}</p>
        <p class="text-xs text-gray-400 mt-1">หุ้นละ 1,000 บาท</p>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <p class="text-sm text-gray-400">จำนวนหุ้นทั้งหมด</p>
        <p class="text-2xl font-bold text-white mt-1">{{ number_format(array_sum(array_column($members, 'shares'))) }} <span class="text-base font-normal text-gray-400">หุ้น</span></p>
        <p class="text-xs text-gray-400 mt-1">{{ count($members) }} ผู้ถือหุ้น</p>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <p class="text-sm text-gray-400">เฉลี่ยต่อสมาชิก</p>
        <p class="text-2xl font-bold text-white mt-1">{{ number_format(array_sum(array_column($members, 'shares')) / count($members)) }} <span class="text-base font-normal text-gray-400">หุ้น</span></p>
        <p class="text-xs text-emerald-400 mt-1">~ {{ number_format(array_sum(array_column($members, 'shares')) / count($members) * 1000, 2) }} บาท</p>
    </div>
</div>

{{-- Table --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-800">
        <h3 class="text-base font-semibold text-white">รายชื่อผู้ถือหุ้น</h3>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400">
                <th class="px-5 py-3 text-left">รหัสสมาชิก</th>
                <th class="px-5 py-3 text-left">ชื่อ-สกุล</th>
                <th class="px-5 py-3 text-right">จำนวนหุ้น</th>
                <th class="px-5 py-3 text-right">มูลค่า (บาท)</th>
                <th class="px-5 py-3 text-left">วันที่เข้าเป็นสมาชิก</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800/50">
            @foreach($members as $m)
            <tr class="hover:bg-gray-800/30 transition-colors">
                <td class="px-5 py-3 text-gray-400 font-mono text-xs">{{ $m['code'] }}</td>
                <td class="px-5 py-3 text-gray-300">{{ $m['name'] }}</td>
                <td class="px-5 py-3 text-right font-medium text-white">{{ number_format($m['shares']) }}</td>
                <td class="px-5 py-3 text-right font-medium text-emerald-400">{{ number_format($m['shares'] * 1000, 2) }}</td>
                <td class="px-5 py-3 text-gray-400 text-xs">{{ $m['joined'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
