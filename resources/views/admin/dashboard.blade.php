@extends('layouts.admin')

@section('page-title', 'ภาพรวมระบบ')

@section('content')
    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">ภาพรวมระบบ</h2>
        <p class="text-sm text-gray-400 mt-1">ข้อมูลสรุปกองทุนหมู่บ้านทั้งหมดในระบบ &middot; {{ now()->locale('th')->translatedFormat('l j F Y') }}</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-stat-card
            label="จำนวนกองทุน"
            :value="number_format($totalFunds ?? 0) . ' กองทุน'"
            :trend="12"
            color="primary"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" /></svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            label="สมาชิกทั้งหมด"
            :value="number_format($totalMembers ?? 0) . ' คน'"
            :trend="8.5"
            color="green"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            label="สินเชื่อรวม"
            :value="number_format($totalLoans ?? 0, 2) . ' บาท'"
            :trend="-2.3"
            color="yellow"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            label="เงินฝากรวม"
            :value="number_format($totalDeposits ?? 0, 2) . ' บาท'"
            :trend="5.7"
            color="blue"
        >
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
            </x-slot:icon>
        </x-stat-card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Funds distribution chart --}}
        <x-chart-card title="การกระจายตัวของกองทุน (ตามภาค)" chartId="fundsDistributionChart" />

        {{-- System health --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-800">
                <h3 class="text-base font-semibold text-white">สถานะระบบ</h3>
            </div>
            <div class="p-5 space-y-4">
                {{-- Server status --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-sm text-gray-300">เซิร์ฟเวอร์</span>
                    </div>
                    <x-badge color="green" label="ปกติ" />
                </div>
                {{-- Database --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-sm text-gray-300">ฐานข้อมูล</span>
                    </div>
                    <x-badge color="green" label="ปกติ" />
                </div>
                {{-- Storage --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span class="text-sm text-gray-300">พื้นที่จัดเก็บ</span>
                    </div>
                    <x-badge color="yellow" label="62% ใช้แล้ว" />
                </div>
                {{-- Backup --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-sm text-gray-300">สำรองข้อมูลล่าสุด</span>
                    </div>
                    <span class="text-xs text-gray-400">{{ now()->subHours(6)->diffForHumans() }}</span>
                </div>
                {{-- Version --}}
                <div class="flex items-center justify-between pt-2 border-t border-gray-800">
                    <span class="text-sm text-gray-400">เวอร์ชัน</span>
                    <span class="text-sm text-primary-400 font-mono">v{{ file_get_contents(base_path('VERSION')) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent registrations --}}
    <x-data-table title="กองทุนที่ลงทะเบียนล่าสุด" description="กองทุนที่สมัครใช้งานล่าสุด">
        <x-slot:header>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ชื่อกองทุน</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">จังหวัด</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ผู้ดูแล</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">วันที่สมัคร</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">สถานะ</th>
        </x-slot:header>

        @forelse ($recentFunds ?? [] as $fund)
            <tr class="hover:bg-gray-800/50 transition-colors">
                <td class="px-4 py-3 text-sm text-white font-medium">{{ $fund->name }}</td>
                <td class="px-4 py-3 text-sm text-gray-300">{{ $fund->province ?? '-' }}</td>
                <td class="px-4 py-3 text-sm text-gray-300">{{ $fund->admin_name ?? '-' }}</td>
                <td class="px-4 py-3 text-sm text-gray-400">{{ $fund->created_at?->format('d/m/Y') }}</td>
                <td class="px-4 py-3 text-center">
                    @if ($fund->is_approved)
                        <x-badge color="green" label="อนุมัติแล้ว" />
                    @else
                        <x-badge color="yellow" label="รอตรวจสอบ" />
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-500">ยังไม่มีกองทุนลงทะเบียน</td>
            </tr>
        @endforelse
    </x-data-table>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const distCtx = document.getElementById('fundsDistributionChart');
    if (distCtx) {
        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: @json($regionLabels ?? ['ภาคเหนือ', 'ภาคกลาง', 'ภาคตะวันออกเฉียงเหนือ', 'ภาคใต้', 'ภาคตะวันออก', 'ภาคตะวันตก']),
                datasets: [{
                    label: 'จำนวนกองทุน',
                    data: @json($regionCounts ?? [0, 0, 0, 0, 0, 0]),
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.5)',
                        'rgba(139, 92, 246, 0.5)',
                        'rgba(167, 139, 250, 0.5)',
                        'rgba(196, 181, 253, 0.5)',
                        'rgba(79, 70, 229, 0.5)',
                        'rgba(129, 140, 248, 0.5)',
                    ],
                    borderColor: [
                        'rgb(99, 102, 241)',
                        'rgb(139, 92, 246)',
                        'rgb(167, 139, 250)',
                        'rgb(196, 181, 253)',
                        'rgb(79, 70, 229)',
                        'rgb(129, 140, 248)',
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#9ca3af' }, grid: { color: 'rgba(75, 85, 99, 0.3)' } },
                    y: { ticks: { color: '#9ca3af' }, grid: { display: false } }
                }
            }
        });
    }
});
</script>
@endpush
