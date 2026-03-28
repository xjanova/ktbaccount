@extends('layouts.app')

@section('page-title', 'รายรับ-รายจ่าย')

@section('content')
    {{-- Filter bar --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6">
        <form method="GET" action="{{ route('fund.transactions.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-form.select
                name="account_set"
                label="ชุดบัญชี"
                :options="$accountSets ?? []"
                :selected="request('account_set')"
                placeholder="-- ทุกชุดบัญชี --"
                tooltip="เลือกชุดบัญชีที่ต้องการดู"
            />
            <x-form.select
                name="type"
                label="ประเภท"
                :options="['income' => 'รายรับ', 'expense' => 'รายจ่าย']"
                :selected="request('type')"
                placeholder="-- ทั้งหมด --"
                tooltip="กรองตามประเภทรายการ"
            />
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">ช่วงวันที่</label>
                <input type="text" name="date_range" id="dateRange" value="{{ request('date_range') }}"
                       placeholder="เลือกช่วงวันที่"
                       class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ค้นหา">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    ค้นหา
                </button>
                <a href="{{ route('fund.transactions.index') }}" class="px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ล้างตัวกรอง">ล้าง</a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <x-data-table title="รายการรายรับ-รายจ่าย" :createUrl="route('fund.transactions.create')" createLabel="เพิ่มรายการ">
        <x-slot:header>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">วันที่</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ประเภท</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">รายการ</th>
            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">จำนวนเงิน</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ลงบัญชี</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">ดำเนินการ</th>
        </x-slot:header>

        @forelse ($transactions ?? [] as $tx)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-4 py-3 text-sm text-gray-300">{{ $tx->transaction_date?->format('d/m/Y') ?? '-' }}</td>
                <td class="px-4 py-3">
                    @if ($tx->type === 'income')
                        <x-badge color="green" label="รายรับ" />
                    @else
                        <x-badge color="red" label="รายจ่าย" />
                    @endif
                </td>
                <td class="px-4 py-3 text-sm text-gray-300">{{ $tx->description }}</td>
                <td class="px-4 py-3 text-sm text-right font-medium {{ $tx->type === 'income' ? 'text-green-400' : 'text-red-400' }}">
                    {{ $tx->type === 'income' ? '+' : '-' }}{{ number_format($tx->amount, 2) }}
                </td>
                <td class="px-4 py-3 text-sm text-gray-400">{{ $tx->payment_method === 'cash' ? 'เงินสด' : 'ธนาคาร' }}</td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <a href="{{ route('fund.transactions.index') }}" class="p-1.5 rounded-lg text-gray-400 hover:text-primary-400 hover:bg-gray-800 transition-colors" title="แก้ไขรายการ">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        </a>
                        <button class="p-1.5 rounded-lg text-gray-400 hover:text-red-400 hover:bg-gray-800 transition-colors" title="ลบรายการ">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    <p>ยังไม่มีรายการ</p>
                </td>
            </tr>
        @endforelse
    </x-data-table>

    {{-- Pagination --}}
    @if (isset($transactions) && $transactions->hasPages())
        <div class="mt-6">
            {{ $transactions->withQueryString()->links() }}
        </div>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateRange = document.getElementById('dateRange');
    if (dateRange) {
        flatpickr(dateRange, {
            mode: 'range',
            dateFormat: 'd/m/Y',
            allowInput: true,
        });
    }
});
</script>
@endpush
