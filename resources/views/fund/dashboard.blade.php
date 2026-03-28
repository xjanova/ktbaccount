@extends('layouts.app')

@section('page-title', 'แดชบอร์ด')

@section('content')
    <style>
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
        }
        .gradient-text {
            background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .action-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .action-btn:hover {
            transform: translateY(-2px);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .table-row-alt:nth-child(even) {
            background: rgba(255, 255, 255, 0.02);
        }
    </style>

    {{-- Welcome header --}}
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold">
                    <span class="text-white">สวัสดี, </span>
                    <span class="gradient-text">{{ auth()->user()->name ?? 'ผู้ใช้' }}</span>
                </h2>
                <p class="text-sm text-gray-400 mt-1.5">{{ now()->locale('th')->translatedFormat('l j F Y') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 rounded-xl text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" />
                    </svg>
                    {{ auth()->user()->fund->name ?? 'กองทุนหมู่บ้าน' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Cash balance --}}
        <div class="stat-card glass-card rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">เงินสด</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($cashBalance ?? 0, 2) }}</p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                        <span>+5.2% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Bank balance --}}
        <div class="stat-card glass-card rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">เงินฝากธนาคาร</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($bankBalance ?? 0, 2) }}</p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                        <span>+2.1% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Outstanding loans --}}
        <div class="stat-card glass-card rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">สินเชื่อค้างชำระ</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($outstandingLoans ?? 0, 2) }}</p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-red-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" /></svg>
                        <span>-3.4% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Members --}}
        <div class="stat-card glass-card rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">จำนวนสมาชิก</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($memberCount ?? 0) }} <span class="text-base font-normal text-gray-400">คน</span></p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                        <span>+1.5% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <a href="{{ route('fund.transactions.create') }}" class="action-btn flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-emerald-600 to-green-600 text-white font-semibold rounded-xl shadow-lg shadow-emerald-600/25 hover:shadow-emerald-500/40">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            บันทึกรายรับ
        </a>
        <a href="{{ route('fund.transactions.create') }}?type=expense" class="action-btn flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold rounded-xl shadow-lg shadow-red-600/25 hover:shadow-red-500/40">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
            บันทึกรายจ่าย
        </a>
        <a href="{{ route('fund.loans.index') }}" class="action-btn flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/25 hover:shadow-blue-500/40">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
            รับชำระสินเชื่อ
        </a>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Income/Expense Chart --}}
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b border-white/5">
                <h3 class="text-base font-semibold text-white">รายรับ-รายจ่ายรายเดือน</h3>
                <p class="text-xs text-gray-500 mt-1">ข้อมูลย้อนหลัง 6 เดือน</p>
            </div>
            <div class="p-6">
                <div class="h-64">
                    <canvas id="incomeExpenseChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Loan Distribution Chart --}}
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b border-white/5">
                <h3 class="text-base font-semibold text-white">สัดส่วนสินเชื่อ</h3>
                <p class="text-xs text-gray-500 mt-1">แยกตามประเภทสินเชื่อ</p>
            </div>
            <div class="p-6">
                <div class="h-64">
                    <canvas id="loanDistChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Overdue alert --}}
    @if (($overdueLoans ?? 0) > 0)
        <div class="mb-8">
            <div class="glass-card rounded-2xl border-l-4 border-red-500 p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-500/15 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-red-300">สินเชื่อค้างชำระเกินกำหนด</p>
                    <p class="text-sm text-gray-400 mt-1">มี {{ $overdueLoans ?? 0 }} สัญญาที่เลยกำหนดชำระ
                        <a href="{{ route('fund.loans.index') }}?status=overdue" class="text-red-400 hover:text-red-300 underline underline-offset-2 font-medium ml-1 transition-colors">ดูรายละเอียด</a>
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- Recent transactions --}}
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-white/5 flex items-center justify-between">
            <div>
                <h3 class="text-base font-semibold text-white">รายการล่าสุด</h3>
                <p class="text-xs text-gray-500 mt-1">5 รายการล่าสุด</p>
            </div>
            <a href="{{ route('fund.transactions.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 text-sm text-gray-300 rounded-xl transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                เพิ่มรายการ
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">วันที่</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">รายการ</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">ประเภท</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($recentTransactions ?? [] as $tx)
                        <tr class="table-row-alt hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $tx->date ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $tx->description ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if (($tx->type ?? '') === 'income')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">รายรับ</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/15 text-red-400 ring-1 ring-inset ring-red-500/20">รายจ่าย</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-right font-mono whitespace-nowrap {{ ($tx->type ?? '') === 'income' ? 'text-emerald-400' : 'text-red-400' }}">
                                {{ ($tx->type ?? '') === 'income' ? '+' : '-' }}{{ number_format($tx->amount ?? 0, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                    </div>
                                    <p class="text-gray-400 font-medium">ยังไม่มีรายการ</p>
                                    <p class="text-sm text-gray-600 mt-1">เริ่มต้นบันทึกรายรับรายจ่ายของกองทุน</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartFont = { family: "'Inter', 'Noto Sans Thai', sans-serif" };

    // Income/Expense bar chart
    const ieCtx = document.getElementById('incomeExpenseChart');
    if (ieCtx) {
        new Chart(ieCtx, {
            type: 'bar',
            data: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.'],
                datasets: [
                    {
                        label: 'รายรับ',
                        @php $incomeData = array_slice(($monthlyIncome ?? [45000,52000,48000,61000,55000,67000,0,0,0,0,0,0]), 0, 6); @endphp
                        data: @json($incomeData),
                        backgroundColor: 'rgba(99, 102, 241, 0.7)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: 'รายจ่าย',
                        @php $expenseData = array_slice(($monthlyExpense ?? [32000,28000,35000,29000,31000,38000,0,0,0,0,0,0]), 0, 6); @endphp
                        data: @json($expenseData),
                        backgroundColor: 'rgba(239, 68, 68, 0.5)',
                        borderColor: 'rgba(239, 68, 68, 0.8)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: { color: '#9ca3af', font: chartFont, padding: 20, usePointStyle: true, pointStyle: 'roundRect' }
                    }
                },
                scales: {
                    x: { ticks: { color: '#6b7280', font: chartFont }, grid: { color: 'rgba(255,255,255,0.05)' } },
                    y: { ticks: { color: '#6b7280', font: chartFont }, grid: { color: 'rgba(255,255,255,0.05)' } }
                }
            }
        });
    }

    // Loan distribution doughnut chart
    const ldCtx = document.getElementById('loanDistChart');
    if (ldCtx) {
        new Chart(ldCtx, {
            type: 'doughnut',
            @php
                $defaultLoanCats = $loanCategories ?? ['สินเชื่อฉุกเฉิน', 'สินเชื่อทั่วไป', 'สินเชื่อเพื่อการศึกษา', 'สินเชื่อเพื่อที่อยู่อาศัย'];
                $defaultLoanAmts = $loanAmounts ?? [30, 40, 15, 15];
            @endphp
            data: {
                labels: @json($defaultLoanCats),
                datasets: [{
                    data: @json($defaultLoanAmts),
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(196, 181, 253, 0.8)'
                    ],
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#9ca3af', font: chartFont, padding: 16, usePointStyle: true, pointStyle: 'circle' }
                    }
                }
            }
        });
    }
});
</script>
@endpush
