@extends('layouts.app')

@section('page-title', 'สินเชื่อ')

@section('content')
    {{-- Filter bar --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6">
        <form method="GET" action="{{ route('fund.loans.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <x-form.select
                name="status"
                label="สถานะ"
                :options="['active' => 'กำลังผ่อนชำระ', 'overdue' => 'ค้างชำระ', 'completed' => 'ชำระครบ', 'defaulted' => 'ผิดนัดชำระ']"
                :selected="request('status')"
                placeholder="-- ทุกสถานะ --"
                tooltip="กรองตามสถานะสินเชื่อ"
            />
            <x-form.input
                name="member"
                label="ค้นหาสมาชิก"
                placeholder="ชื่อหรือรหัสสมาชิก"
                :value="request('member')"
                tooltip="ค้นหาจากชื่อหรือรหัสสมาชิก"
            />
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ค้นหา">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    ค้นหา
                </button>
                <a href="{{ route('fund.loans.index') }}" class="px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ล้างตัวกรอง">ล้าง</a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <x-data-table title="รายการสินเชื่อ" createLabel="สร้างสัญญาใหม่">
        <x-slot:header>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">รหัสสัญญา</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">สมาชิก</th>
            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">ยอดกู้</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">อัตราดอกเบี้ย</th>
            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">คงเหลือ</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">สถานะ</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">ดำเนินการ</th>
        </x-slot:header>

        @forelse ($loans ?? [] as $loan)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-4 py-3 text-sm text-primary-400 font-medium">{{ $loan->contract_number ?? '-' }}</td>
                <td class="px-4 py-3 text-sm text-gray-300">{{ $loan->member->name ?? '-' }}</td>
                <td class="px-4 py-3 text-sm text-right text-gray-300">{{ number_format($loan->amount ?? 0, 2) }}</td>
                <td class="px-4 py-3 text-sm text-center text-gray-400">{{ $loan->interest_rate ?? 0 }}%</td>
                <td class="px-4 py-3 text-sm text-right font-medium text-yellow-400">{{ number_format($loan->remaining ?? 0, 2) }}</td>
                <td class="px-4 py-3 text-center">
                    @php
                        $statusMap = [
                            'active'    => ['color' => 'green',  'label' => 'กำลังผ่อนชำระ'],
                            'overdue'   => ['color' => 'red',    'label' => 'ค้างชำระ'],
                            'completed' => ['color' => 'blue',   'label' => 'ชำระครบ'],
                            'defaulted' => ['color' => 'orange', 'label' => 'ผิดนัดชำระ'],
                        ];
                        $status = $statusMap[$loan->status ?? 'active'] ?? $statusMap['active'];
                    @endphp
                    <x-badge :color="$status['color']" :label="$status['label']" />
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <a href="#" class="p-1.5 rounded-lg text-gray-400 hover:text-primary-400 hover:bg-gray-800 transition-colors" title="ดูรายละเอียด">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </a>
                        <a href="#" class="p-1.5 rounded-lg text-gray-400 hover:text-green-400 hover:bg-gray-800 transition-colors" title="รับชำระ">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                        </a>
                        <a href="#" class="p-1.5 rounded-lg text-gray-400 hover:text-primary-400 hover:bg-gray-800 transition-colors" title="แก้ไข">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <p>ยังไม่มีรายการสินเชื่อ</p>
                </td>
            </tr>
        @endforelse
    </x-data-table>

    {{-- Pagination --}}
    @if (isset($loans) && $loans->hasPages())
        <div class="mt-6">
            {{ $loans->withQueryString()->links() }}
        </div>
    @endif
@endsection
