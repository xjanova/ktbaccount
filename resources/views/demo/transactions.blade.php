@extends('layouts.app')

@section('page-title', 'รายรับ-รายจ่าย (โหมดทดลอง)')

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

{{-- Filter bar --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6">
    <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ชุดบัญชี</label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option>-- ทุกชุดบัญชี --</option>
                <option>บัญชีหลัก</option>
            </select>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ประเภท</label>
            <select class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 text-sm">
                <option>-- ทั้งหมด --</option>
                <option>รายรับ</option>
                <option>รายจ่าย</option>
            </select>
        </div>
        <div>
            <label class="text-sm font-medium text-gray-300 mb-1.5 block">ช่วงวันที่</label>
            <input type="text" placeholder="เลือกช่วงวันที่" class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 text-sm">
        </div>
        <div class="flex items-end gap-2">
            <button type="button" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                ค้นหา
            </button>
            <button type="button" class="px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors">ล้าง</button>
        </div>
    </form>
</div>

{{-- Table --}}
<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
        <h3 class="text-base font-semibold text-white">รายการรายรับ-รายจ่าย</h3>
        <a href="{{ route('demo.transactions.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            เพิ่มรายการ
        </a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800 text-gray-400">
                <th class="px-5 py-3 text-left">วันที่</th>
                <th class="px-5 py-3 text-left">ประเภท</th>
                <th class="px-5 py-3 text-left">รายการ</th>
                <th class="px-5 py-3 text-right">จำนวนเงิน</th>
                <th class="px-5 py-3 text-left">สมาชิก</th>
                <th class="px-5 py-3 text-left">วิธีชำระ</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800/50">
            @foreach($transactions as $tx)
            <tr class="hover:bg-gray-800/30 transition-colors">
                <td class="px-5 py-3 text-gray-400 text-xs">{{ $tx['date'] }}</td>
                <td class="px-5 py-3">
                    <span class="px-2 py-0.5 text-xs rounded-full {{ $tx['type'] === 'income' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $tx['type'] === 'income' ? 'รายรับ' : 'รายจ่าย' }}
                    </span>
                </td>
                <td class="px-5 py-3 text-gray-300">{{ $tx['category'] }}</td>
                <td class="px-5 py-3 text-right font-medium {{ $tx['type'] === 'income' ? 'text-emerald-400' : 'text-red-400' }}">
                    {{ $tx['type'] === 'income' ? '+' : '-' }}{{ number_format($tx['amount'], 2) }}
                </td>
                <td class="px-5 py-3 text-gray-400">{{ $tx['member'] }}</td>
                <td class="px-5 py-3 text-gray-400">{{ $tx['method'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
