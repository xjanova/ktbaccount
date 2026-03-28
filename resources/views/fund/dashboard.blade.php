@extends('layouts.app')

@section('page-title', 'แดชบอร์ด')

@section('content')
    {{-- Welcome header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">สวัสดี, {{ auth()->user()->name ?? 'ผู้ใช้' }}</h2>
        <p class="text-sm text-gray-400 mt-1">{{ auth()->user()->fund->name ?? 'กองทุนหมู่บ้าน' }} &middot; {{ now()->locale('th')->translatedFormat('l j F Y') }}</p>
    </div>

    {{-- Quick action buttons --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('fund.transactions.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600/20 border border-green-600/30 text-green-400 hover:bg-green-600/30 rounded-xl text-sm font-medium transition-colors" title="บันทึกรายรับ">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            บันทึกรายรับ
        </a>
        <a href="{{ route('fund.transactions.create') }}?type=expense" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600/20 border border-red-600/30 text-red-400 hover:bg-red-600/30 rounded-xl text-sm font-medium transition-colors" title="บันทึกรายจ่าย">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
            บันทึกรายจ่าย
        </a>
        <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600/20 border border-primary-600/30 text-primary-400 hover:bg-primary-600/30 rounded-xl text-sm font-medium transition-colors" title="รับชำระสินเชื่อ">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
            รับชำระสินเชื่อ
        </a>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-stat-card
            label="เงินสด"
            :value="number_format($cashBalance ?? 0, 2) . ' บาท'"
            :trend="5.2"
            color="green"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            label="เงินฝากธนาคาร"
            :value="number_format($bankBalance ?? 0, 2) . ' บาท'"
            :trend="2.1"
            color="blue"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            label="สินเชื่อค้างชำระ"
            :value="number_format($outstandingLoans ?? 0, 2) . ' บาท'"
            :trend="-3.4"
            color="yellow"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            label="จำนวนสมาชิก"
            :value="number_format($memberCount ?? 0) . ' คน'"
            :trend="1.5"
            color="primary"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </x-slot:icon>
        </x-stat-card>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <x-chart-card title="รายรับ-รายจ่ายรายเดือน" chartId="monthlyChart" />
        <x-chart-card title="สัดส่วนสินเชื่อ" chartId="loanPieChart" />
    </div>

    {{-- Overdue loans alert --}}
    @if (($overdueLoans ?? 0) > 0)
        <div class="mb-6">
            <x-alert type="warning" :dismissible="false">
                <x-slot:message>
                    <strong>สินเชื่อค้างชำระเกินกำหนด:</strong> มี {{ $overdueLoans ?? 0 }} สัญญาที่เลยกำหนดชำระ
                    <a href="{{ route('fund.loans.index') }}?status=overdue" class="underline font-medium ml-1">ดูรายละเอียด</a>
                </x-slot:message>
            </x-alert>
        </div>
    @endif

    {{-- Recent transactions --}}
    <x-data-table title="รายการล่าสุด" description="5 รายการล่าสุด" :createUrl="route('fund.transactions.create')" createLabel="เพิ่มรายการ">
        <x-slot:header>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">วันที่</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ประเภท</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">รายการ</th>
            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase">จำนวนเงิน</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ลงบัญชี</th>
        </x-slot:header>

        @forelse ($recentTransactions ?? [] as $tx)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-4 py-3 text-sm text-gray-300">{{ $tx->date ?? '-' }}</td>
                <td class="px-4 py-3">
                    @if (($tx->type ?? '') === 'income')
                        <x-badge color="green" label="รายรับ" />
                    @else
                        <x-badge color="red" label="รายจ่าย" />
                    @endif
                </td>
                <td class="px-4 py-3 text-sm text-gray-300">{{ $tx->description ?? '-' }}</td>
                <td class="px-4 py-3 text-sm text-right {{ ($tx->type ?? '') === 'income' ? 'text-green-400' : 'text-red-400' }}">
                    {{ ($tx->type ?? '') === 'income' ? '+' : '-' }}{{ number_format($tx->amount ?? 0, 2) }}
                </td>
                <td class="px-4 py-3 text-sm text-gray-400">{{ $tx->account ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    <p>ยังไม่มีรายการ</p>
                    <p class="text-sm mt-1">เริ่มต้นบันทึกรายรับรายจ่ายของกองทุน</p>
                </td>
            </tr>
        @endforelse
    </x-data-table>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly income/expense chart
    const monthlyCtx = document.getElementById('monthlyChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                datasets: [
                    {
                        label: 'รายรับ',
                        data: @json($monthlyIncome ?? [0,0,0,0,0,0,0,0,0,0,0,0]),
                        backgroundColor: 'rgba(34, 197, 94, 0.5)',
                        borderColor: 'rgb(34, 197, 94)',
                        borderWidth: 1,
                        borderRadius: 6,
                    },
                    {
                        label: 'รายจ่าย',
                        data: @json($monthlyExpense ?? [0,0,0,0,0,0,0,0,0,0,0,0]),
                        backgroundColor: 'rgba(239, 68, 68, 0.5)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { labels: { color: '#9ca3af' } } },
                scales: {
                    x: { ticks: { color: '#9ca3af' }, grid: { color: 'rgba(75, 85, 99, 0.3)' } },
                    y: { ticks: { color: '#9ca3af' }, grid: { color: 'rgba(75, 85, 99, 0.3)' } }
                }
            }
        });
    }

    // Loan distribution chart
    const loanCtx = document.getElementById('loanPieChart');
    if (loanCtx) {
        new Chart(loanCtx, {
            type: 'doughnut',
            data: {
                labels: @json($loanCategories ?? ['สินเชื่อฉุกเฉิน', 'สินเชื่อทั่วไป', 'สินเชื่อเพื่อการศึกษา', 'สินเชื่อเพื่อที่อยู่อาศัย']),
                datasets: [{
                    data: @json($loanAmounts ?? [30, 40, 15, 15]),
                    backgroundColor: ['#6366f1', '#8b5cf6', '#a78bfa', '#c4b5fd'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { color: '#9ca3af', padding: 16 } } }
            }
        });
    }
});
</script>
@endpush
