@extends('layouts.app')

@section('page-title', 'รายละเอียดสินเชื่อ')

@section('content')
    <div class="max-w-4xl">

        {{-- Back link --}}
        <a href="{{ route('fund.loans.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors" title="กลับไปรายการสินเชื่อ">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            กลับไปรายการสินเชื่อ
        </a>

        {{-- Summary card --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $loan->loan_code }}</h2>
                    <p class="text-sm text-gray-400 mt-1">{{ $loan->member?->full_name ?? '-' }}</p>
                </div>
                <div>
                    @php
                        $statusColorMap = [
                            'pending' => 'yellow',
                            'approved' => 'blue',
                            'disbursed' => 'indigo',
                            'active' => 'green',
                            'completed' => 'gray',
                            'defaulted' => 'red',
                            'rejected' => 'red',
                        ];
                        $badgeColor = $statusColorMap[$loan->status->value ?? 'pending'] ?? 'gray';
                    @endphp
                    <x-badge :color="$badgeColor" :label="$loan->status->label()" />
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <p class="text-xs text-gray-500">ยอดกู้</p>
                    <p class="text-lg font-semibold text-white">{{ number_format((float) $loan->principal, 2) }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">อัตราดอกเบี้ย</p>
                    <p class="text-lg font-semibold text-white">{{ number_format((float) $loan->interest_rate, 2) }}%</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">จำนวนงวด</p>
                    <p class="text-lg font-semibold text-white">{{ $loan->term_months }} เดือน</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">ยอดคงเหลือ</p>
                    <p class="text-lg font-semibold text-yellow-400">{{ number_format((float) $loan->outstanding_balance, 2) }}</p>
                </div>
            </div>

            {{-- Progress bar --}}
            @php
                $principal = (float) $loan->principal;
                $outstanding = (float) $loan->outstanding_balance;
                $paid = $principal - $outstanding;
                $paidPercent = $principal > 0 ? min(100, round(($paid / $principal) * 100)) : 0;
            @endphp
            <div class="mt-6">
                <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                    <span>ชำระแล้ว {{ number_format($paid, 2) }} บาท ({{ $paidPercent }}%)</span>
                    <span>คงเหลือ {{ number_format($outstanding, 2) }} บาท</span>
                </div>
                <div class="w-full bg-gray-800 rounded-full h-3">
                    <div class="bg-gradient-to-r from-green-500 to-green-400 h-3 rounded-full transition-all duration-500" style="width: {{ $paidPercent }}%"></div>
                </div>
            </div>

            {{-- Guarantors --}}
            @if ($loan->guarantor1 || $loan->guarantor2)
                <div class="mt-4 pt-4 border-t border-gray-800">
                    <p class="text-xs text-gray-500 mb-2">ผู้ค้ำประกัน</p>
                    <div class="flex flex-wrap gap-3">
                        @if ($loan->guarantor1)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-800 rounded-lg text-sm text-gray-300">
                                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" /></svg>
                                {{ $loan->guarantor1->full_name }}
                            </span>
                        @endif
                        @if ($loan->guarantor2)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-800 rounded-lg text-sm text-gray-300">
                                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" /></svg>
                                {{ $loan->guarantor2->full_name }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Schedule table --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden mb-6">
            <div class="px-5 py-4 border-b border-gray-800">
                <h3 class="text-base font-semibold text-white">ตารางผ่อนชำระ</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-800/50">
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">งวดที่</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">วันครบกำหนด</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">เงินต้น</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">ดอกเบี้ย</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">รวม</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($loan->schedules ?? [] as $schedule)
                            <tr class="hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 py-3 text-center text-gray-300">{{ $schedule->installment_no }}</td>
                                <td class="px-4 py-3 text-gray-300">{{ \Carbon\Carbon::parse($schedule->due_date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 text-right text-gray-300">{{ number_format((float) $schedule->principal_amount, 2) }}</td>
                                <td class="px-4 py-3 text-right text-gray-300">{{ number_format((float) $schedule->interest_amount, 2) }}</td>
                                <td class="px-4 py-3 text-right font-medium text-white">{{ number_format((float) $schedule->total_amount, 2) }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if ($schedule->status === 'paid')
                                        <x-badge color="green" label="ชำระแล้ว" />
                                    @elseif ($schedule->due_date < now() && $schedule->status === 'pending')
                                        <x-badge color="red" label="เลยกำหนด" />
                                    @else
                                        <x-badge color="yellow" label="รอชำระ" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">ยังไม่มีตารางผ่อนชำระ</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Action buttons --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('fund.loans.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="กลับ">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                กลับ
            </a>
        </div>
    </div>
@endsection
