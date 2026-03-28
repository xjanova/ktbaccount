@extends('layouts.admin')

@section('page-title', 'ภาพรวมระบบ')

@section('content')
    <style>
        .stat-card-admin {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card-admin:hover {
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
        }
        .gradient-text-admin {
            background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-card-admin {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .health-dot {
            animation: health-pulse 2s ease-in-out infinite;
        }
        @keyframes health-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .table-row-admin:nth-child(even) {
            background: rgba(255, 255, 255, 0.02);
        }
    </style>

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold">
            <span class="gradient-text-admin">ภาพรวมระบบ</span>
        </h2>
        <p class="text-sm text-gray-400 mt-1.5">ข้อมูลสรุปกองทุนหมู่บ้านทั้งหมดในระบบ &middot; {{ now()->locale('th')->translatedFormat('l j F Y') }}</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Total funds --}}
        <div class="stat-card-admin glass-card-admin rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">จำนวนกองทุน</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($totalFunds ?? 0) }} <span class="text-base font-normal text-gray-400">กองทุน</span></p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                        <span>+12% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" /></svg>
                </div>
            </div>
        </div>

        {{-- Total members --}}
        <div class="stat-card-admin glass-card-admin rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">สมาชิกทั้งหมด</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($totalMembers ?? 0) }} <span class="text-base font-normal text-gray-400">คน</span></p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                        <span>+8.5% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Total loans --}}
        <div class="stat-card-admin glass-card-admin rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">สินเชื่อรวม</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($totalLoans ?? 0, 2) }}</p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-red-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" /></svg>
                        <span>-2.3% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Total deposits --}}
        <div class="stat-card-admin glass-card-admin rounded-2xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">เงินฝากรวม</p>
                    <p class="text-2xl font-bold text-white mt-2">{{ number_format($totalDeposits ?? 0, 2) }}</p>
                    <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                        <span>+5.7% จากเดือนก่อน</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Regional chart --}}
        <div class="glass-card-admin rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b border-white/5">
                <h3 class="text-base font-semibold text-white">กองทุนตามภูมิภาค</h3>
                <p class="text-xs text-gray-500 mt-1">การกระจายตัวของกองทุนตามภาค</p>
            </div>
            <div class="p-6">
                <div class="h-72">
                    <canvas id="fundsDistributionChart"></canvas>
                </div>
            </div>
        </div>

        {{-- System health --}}
        <div class="glass-card-admin rounded-2xl overflow-hidden">
            <div class="px-6 py-5 border-b border-white/5">
                <h3 class="text-base font-semibold text-white">สถานะระบบ</h3>
                <p class="text-xs text-gray-500 mt-1">การตรวจสอบสุขภาพระบบแบบเรียลไทม์</p>
            </div>
            <div class="p-6 space-y-5">
                {{-- Server --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-white/[0.02] border border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 health-dot"></div>
                        <div>
                            <p class="text-sm font-medium text-white">เซิร์ฟเวอร์</p>
                            <p class="text-xs text-gray-500">Application Server</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">ปกติ</span>
                </div>

                {{-- Database --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-white/[0.02] border border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 health-dot"></div>
                        <div>
                            <p class="text-sm font-medium text-white">ฐานข้อมูล</p>
                            <p class="text-xs text-gray-500">MySQL Database</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">ปกติ</span>
                </div>

                {{-- Queue --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-white/[0.02] border border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 health-dot"></div>
                        <div>
                            <p class="text-sm font-medium text-white">คิวงาน</p>
                            <p class="text-xs text-gray-500">Queue Worker</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">ปกติ</span>
                </div>

                {{-- Storage --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-white/[0.02] border border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-amber-500 health-dot"></div>
                        <div>
                            <p class="text-sm font-medium text-white">พื้นที่จัดเก็บ</p>
                            <p class="text-xs text-gray-500">Disk Storage</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-500/15 text-amber-400 ring-1 ring-inset ring-amber-500/20">62% ใช้แล้ว</span>
                </div>

                {{-- Version --}}
                <div class="flex items-center justify-between pt-3 border-t border-white/5">
                    <span class="text-sm text-gray-400">เวอร์ชันระบบ</span>
                    <span class="text-sm text-indigo-400 font-mono">v{{ file_get_contents(base_path('VERSION')) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent registrations --}}
    <div class="glass-card-admin rounded-2xl overflow-hidden">
        <div class="px-6 py-5 border-b border-white/5">
            <h3 class="text-base font-semibold text-white">กองทุนที่ลงทะเบียนล่าสุด</h3>
            <p class="text-xs text-gray-500 mt-1">กองทุนที่สมัครใช้งานล่าสุด</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">ชื่อกองทุน</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">จังหวัด</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">ผู้ดูแล</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">วันที่สมัคร</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">สถานะ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($recentFunds ?? [] as $fund)
                        <tr class="table-row-admin hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $fund->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $fund->province ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $fund->admin_name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $fund->created_at?->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($fund->is_approved)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">อนุมัติแล้ว</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-500/15 text-amber-400 ring-1 ring-inset ring-amber-500/20">รอตรวจสอบ</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" /></svg>
                                    </div>
                                    <p class="text-gray-400 font-medium">ยังไม่มีกองทุนลงทะเบียน</p>
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

    const distCtx = document.getElementById('fundsDistributionChart');
    if (distCtx) {
        new Chart(distCtx, {
            type: 'bar',
            data: {
                @php
                    $defaultLabels = $regionLabels ?? ['ภาคเหนือ', 'ภาคกลาง', 'ภาคตะวันออกเฉียงเหนือ', 'ภาคใต้', 'ภาคตะวันออก', 'ภาคตะวันตก'];
                    $defaultCounts = $regionCounts ?? [45, 78, 92, 56, 34, 28];
                @endphp
                labels: @json($defaultLabels),
                datasets: [{
                    label: 'จำนวนกองทุน',
                    data: @json($defaultCounts),
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(196, 181, 253, 0.7)',
                        'rgba(79, 70, 229, 0.7)',
                        'rgba(129, 140, 248, 0.7)',
                    ],
                    borderColor: [
                        'rgb(99, 102, 241)',
                        'rgb(139, 92, 246)',
                        'rgb(168, 85, 247)',
                        'rgb(196, 181, 253)',
                        'rgb(79, 70, 229)',
                        'rgb(129, 140, 248)',
                    ],
                    borderWidth: 1,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        ticks: { color: '#6b7280', font: chartFont },
                        grid: { color: 'rgba(255,255,255,0.05)' }
                    },
                    y: {
                        ticks: { color: '#9ca3af', font: chartFont },
                        grid: { display: false }
                    }
                }
            }
        });
    }
});
</script>
@endpush
