@extends('layouts.app')

@section('page-title', 'หน้าหลักสมาชิก')

@section('content')
    {{-- Welcome header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">สวัสดี, {{ $member->name ?? 'สมาชิก' }}</h2>
        <p class="text-sm text-gray-400 mt-1">รหัสสมาชิก: {{ $member->member_code ?? '-' }} &middot; {{ auth()->user()->fund->name ?? 'กองทุนหมู่บ้าน' }}</p>
    </div>

    {{-- Summary cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        {{-- ยอดสินเชื่อ --}}
        <div class="bg-gradient-card rounded-2xl p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">ยอดสินเชื่อคงเหลือ</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($loanBalance ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">บาท</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
        </div>

        {{-- ยอดเงินฝาก --}}
        <div class="bg-gradient-card rounded-2xl p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">ยอดเงินฝาก</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($depositBalance ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">บาท</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
                </div>
            </div>
        </div>

        {{-- ยอดหุ้น --}}
        <div class="bg-gradient-card rounded-2xl p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-400 mb-1">ยอดหุ้นสะสม</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($shareBalance ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">บาท ({{ number_format($shareCount ?? 0) }} หุ้น)</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Next payment alert --}}
    @if ($nextPayment ?? null)
        <div class="mb-6">
            <div class="bg-gradient-card rounded-2xl p-5 border-l-4 border-primary-500">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-white mb-1">งวดชำระถัดไป</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
                            <div>
                                <span class="text-gray-400">วันครบกำหนด:</span>
                                <span class="text-white font-medium ml-1">{{ $nextPayment->due_date ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">จำนวนเงิน:</span>
                                <span class="text-primary-400 font-medium ml-1">{{ number_format($nextPayment->amount ?? 0, 2) }} บาท</span>
                            </div>
                            <div>
                                <span class="text-gray-400">สัญญา:</span>
                                <span class="text-white font-medium ml-1">{{ $nextPayment->contract_number ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Recent activity --}}
    <x-data-table title="ประวัติรายการล่าสุด" description="รายการเคลื่อนไหวล่าสุดของท่าน">
        <x-slot:header>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">วันที่</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ประเภท</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">รายละเอียด</th>
            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">จำนวนเงิน</th>
        </x-slot:header>

        @forelse ($recentActivity ?? [] as $activity)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-4 py-3 text-sm text-gray-300">{{ $activity->date ?? '-' }}</td>
                <td class="px-4 py-3">
                    @php
                        $typeMap = [
                            'loan_payment'  => ['color' => 'green',   'label' => 'ชำระสินเชื่อ'],
                            'deposit'       => ['color' => 'blue',    'label' => 'ฝากเงิน'],
                            'withdrawal'    => ['color' => 'red',     'label' => 'ถอนเงิน'],
                            'share_buy'     => ['color' => 'primary', 'label' => 'ซื้อหุ้น'],
                            'loan_disburse' => ['color' => 'yellow',  'label' => 'รับสินเชื่อ'],
                        ];
                        $type = $typeMap[$activity->type ?? ''] ?? ['color' => 'gray', 'label' => $activity->type ?? '-'];
                    @endphp
                    <x-badge :color="$type['color']" :label="$type['label']" />
                </td>
                <td class="px-4 py-3 text-sm text-gray-300">{{ $activity->description ?? '-' }}</td>
                <td class="px-4 py-3 text-sm text-right font-medium {{ in_array($activity->type ?? '', ['deposit', 'loan_disburse']) ? 'text-green-400' : 'text-red-400' }}">
                    {{ in_array($activity->type ?? '', ['deposit', 'loan_disburse']) ? '+' : '-' }}{{ number_format($activity->amount ?? 0, 2) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <p>ยังไม่มีรายการเคลื่อนไหว</p>
                </td>
            </tr>
        @endforelse
    </x-data-table>
@endsection
