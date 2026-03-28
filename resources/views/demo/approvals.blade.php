@extends('layouts.app')

@section('page-title', 'รออนุมัติ (โหมดทดลอง)')

@section('content')
{{-- Demo Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-600/20 to-orange-600/20 border border-amber-500/30">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div class="flex items-center gap-2">
            <span class="text-lg">🧪</span>
            <span class="text-amber-300 font-semibold text-sm">โหมดทดลองใช้งาน</span>
            <span class="text-amber-400/70 text-xs">- ข้อมูลตัวอย่าง ไม่ได้บัน���ึกจริง</span>
        </div>
        <a href="/register" class="px-4 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-medium rounded-lg transition-colors">ลงทะเบียนกองทุนจริง &rarr;</a>
    </div>
</div>

{{-- Summary --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <p class="text-sm text-gray-400">รอการอนุมัติ</p>
        <p class="text-2xl font-bold text-amber-400 mt-1">2 <span class="text-base font-normal text-gray-400">รายการ</span></p>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <p class="text-sm text-gray-400">อนุมัติแล้วเดือนนี้</p>
        <p class="text-2xl font-bold text-emerald-400 mt-1">5 <span class="text-base font-normal text-gray-400">รายการ</span></p>
    </div>
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
        <p class="text-sm text-gray-400">ปฏิเสธเดือนนี้</p>
        <p class="text-2xl font-bold text-red-400 mt-1">1 <span class="text-base font-normal text-gray-400">รายการ</span></p>
    </div>
</div>

{{-- Pending Approvals --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-800">
        <h3 class="text-base font-semibold text-white">รายการรออนุมัติ</h3>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400">
                <th class="px-5 py-3 text-left">ประเภท</th>
                <th class="px-5 py-3 text-left">รายละเอียด</th>
                <th class="px-5 py-3 text-left">ผู้ขอ</th>
                <th class="px-5 py-3 text-right">จำนวนเงิน</th>
                <th class="px-5 py-3 text-left">วันที่ขอ</th>
                <th class="px-5 py-3 text-center">สถานะ</th>
                <th class="px-5 py-3 text-center">ดำเนินการ</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800/50">
            <tr class="hover:bg-gray-800/30 transition-colors">
                <td class="px-5 py-3"><span class="px-2 py-0.5 text-xs rounded-full bg-blue-500/20 text-blue-400">สินเชื่อ</span></td>
                <td class="px-5 py-3 text-gray-300">ขอกู้สินเชื่อทั่วไป 12 ง��ด</td>
                <td class="px-5 py-3 text-gray-400">นายสมชาย ใจดี</td>
                <td class="px-5 py-3 text-right font-medium text-white">50,000.00</td>
                <td class="px-5 py-3 text-gray-400 text-xs">25 มี.ค. 2569</td>
                <td class="px-5 py-3 text-center"><span class="px-2 py-0.5 text-xs rounded-full bg-amber-500/20 text-amber-400">รออนุมัติ</span></td>
                <td class="px-5 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <button class="px-3 py-1 bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600/30 rounded-lg text-xs font-medium transition-colors">อนุมัติ</button>
                        <button class="px-3 py-1 bg-red-600/20 text-red-400 hover:bg-red-600/30 rounded-lg text-xs font-medium transition-colors">ปฏิเสธ</button>
                    </div>
                </td>
            </tr>
            <tr class="hover:bg-gray-800/30 transition-colors">
                <td class="px-5 py-3"><span class="px-2 py-0.5 text-xs rounded-full bg-purple-500/20 text-purple-400">สมาชิกใหม่</span></td>
                <td class="px-5 py-3 text-gray-300">สมัครสมาชิกใหม่ - ซื้อหุ้น 50 หุ้น</td>
                <td class="px-5 py-3 text-gray-400">นางสาวสุภาพร เรืองศรี</td>
                <td class="px-5 py-3 text-right font-medium text-white">50,000.00</td>
                <td class="px-5 py-3 text-gray-400 text-xs">27 มี.��. 2569</td>
                <td class="px-5 py-3 text-center"><span class="px-2 py-0.5 text-xs rounded-full bg-amber-500/20 text-amber-400">รออนุมัติ</span></td>
                <td class="px-5 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <button class="px-3 py-1 bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600/30 rounded-lg text-xs font-medium transition-colors">อนุมัติ</button>
                        <button class="px-3 py-1 bg-red-600/20 text-red-400 hover:bg-red-600/30 rounded-lg text-xs font-medium transition-colors">ปฏิเสธ</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
