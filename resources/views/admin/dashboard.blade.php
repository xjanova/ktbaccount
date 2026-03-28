@extends('layouts.admin')

@section('page-title', 'ภาพรวมระบบ')

@section('content')
    @php
        // Demo data - ข้อมูลตัวอย่าง (ใช้ค่าจาก controller ถ้ามี หรือใช้ค่า demo)
        $totalFunds = $totalFunds ?? 3;
        $totalMembers = $totalMembers ?? 347;
        $totalLoans = $totalLoans ?? 4250000.00;
        $totalDeposits = $totalDeposits ?? 2180500.00;
        $totalShares = $totalShares ?? 865000.00;

        // Sample village funds
        $sampleFunds = $sampleFunds ?? [
            ['name' => 'กองทุนหมู่บ้านบ้านสวนสวรรค์', 'code' => 'VF-001', 'province' => 'เชียงใหม่', 'members' => 127, 'loans' => 1500000, 'status' => 'active', 'registered' => '15 ม.ค. 2569'],
            ['name' => 'กองทุนหมู่บ้านบ้านนาทราย', 'code' => 'VF-002', 'province' => 'ขอนแก่น', 'members' => 98, 'loans' => 1200000, 'status' => 'active', 'registered' => '22 ก.พ. 2569'],
            ['name' => 'กองทุนหมู่บ้านบ้านท่าเรือ', 'code' => 'VF-003', 'province' => 'สุราษฎร์ธานี', 'members' => 122, 'loans' => 1550000, 'status' => 'active', 'registered' => '10 มี.ค. 2569'],
        ];

        // Recent activities
        $recentActivities = $recentActivities ?? [
            ['action' => 'ลงทะเบียนกองทุนใหม่', 'fund' => 'กองทุนหมู่บ้านบ้านท่าเรือ', 'time' => '2 ชั่วโมงที่แล้ว', 'type' => 'register'],
            ['action' => 'รับชำระสินเชื่อ', 'fund' => 'กองทุนหมู่บ้านบ้านสวนสวรรค์', 'time' => '5 ชั่วโมงที่แล้ว', 'type' => 'payment'],
            ['action' => 'สร้างสัญญาสินเชื่อใหม่', 'fund' => 'กองทุนหมู่บ้านบ้านนาทราย', 'time' => 'เมื่อวาน', 'type' => 'loan'],
            ['action' => 'ฝากเงินสมาชิก', 'fund' => 'กองทุนหมู่บ้านบ้านสวนสวรรค์', 'time' => 'เมื่อวาน', 'type' => 'deposit'],
            ['action' => 'จัดสรรกำไรประจำปี', 'fund' => 'กองทุนหมู่บ้านบ้านนาทราย', 'time' => '3 วันที่แล้ว', 'type' => 'profit'],
        ];

        $regionLabels = ['ภาคเหนือ', 'ภาคกลาง', 'ภาคอีสาน', 'ภาคใต้', 'ภาคตะวันออก', 'ภาคตะวันตก'];
        $regionCounts = [45, 78, 92, 56, 34, 28];
    @endphp

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
        .activity-line::before {
            content: '';
            position: absolute;
            left: 17px;
            top: 40px;
            bottom: 0;
            width: 2px;
            background: rgba(255, 255, 255, 0.06);
        }
        .activity-line:last-child::before {
            display: none;
        }
    </style>

    <div class="space-y-6">
        {{-- Header with greeting --}}
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold">
                <span class="gradient-text-admin">ภาพรวมระบบ</span>
            </h2>
            <p class="text-sm text-gray-400 mt-1">สรุปข้อมูลกองทุนหมู่บ้านทั้งหมดในระบบ &middot; {{ now()->locale('th')->translatedFormat('l j F Y') }}</p>
        </div>

        {{-- 4 Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            {{-- Total funds --}}
            <div class="stat-card-admin glass-card-admin rounded-2xl p-5">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-400">จำนวนกองทุน</p>
                        <p class="text-2xl font-bold text-white mt-1.5">{{ number_format($totalFunds) }} <span class="text-sm font-normal text-gray-400">กองทุน</span></p>
                        <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                            <span>+12% จากเดือนก่อน</span>
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/30 shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" /></svg>
                    </div>
                </div>
            </div>

            {{-- Total members --}}
            <div class="stat-card-admin glass-card-admin rounded-2xl p-5">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-400">สมาชิกทั้งหมด</p>
                        <p class="text-2xl font-bold text-white mt-1.5">{{ number_format($totalMembers) }} <span class="text-sm font-normal text-gray-400">คน</span></p>
                        <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                            <span>+8.5% จากเดือนก่อน</span>
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Total loans --}}
            <div class="stat-card-admin glass-card-admin rounded-2xl p-5">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-400">สินเชื่อรวม</p>
                        <p class="text-2xl font-bold text-white mt-1.5"><span class="text-base text-gray-400">&#3647;</span>{{ number_format($totalLoans, 2) }}</p>
                        <p class="text-xs mt-2 flex items-center gap-1 text-red-400">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" /></svg>
                            <span>-2.3% จากเดือนก่อน</span>
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30 shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Total deposits --}}
            <div class="stat-card-admin glass-card-admin rounded-2xl p-5">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-400">เงินฝากรวม</p>
                        <p class="text-2xl font-bold text-white mt-1.5"><span class="text-base text-gray-400">&#3647;</span>{{ number_format($totalDeposits, 2) }}</p>
                        <p class="text-xs mt-2 flex items-center gap-1 text-emerald-400">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                            <span>+5.7% จากเดือนก่อน</span>
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/30 shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts + System Health (2 columns) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Regional distribution chart --}}
            <div class="glass-card-admin rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5">
                    <h3 class="text-base font-semibold text-white">กองทุนตามภูมิภาค</h3>
                    <p class="text-xs text-gray-500 mt-0.5">การกระจายตัวของกองทุนตามภาค</p>
                </div>
                <div class="p-5">
                    <div class="h-72">
                        <canvas id="fundsDistributionChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- System health --}}
            <div class="glass-card-admin rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5">
                    <h3 class="text-base font-semibold text-white">สถานะระบบ</h3>
                    <p class="text-xs text-gray-500 mt-0.5">การตรวจสอบสุขภาพระบบแบบเรียลไทม์</p>
                </div>
                <div class="p-5 space-y-4">
                    {{-- Server --}}
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] border border-white/5">
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
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] border border-white/5">
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
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] border border-white/5">
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
                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.02] border border-white/5">
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

        {{-- Village Funds Table --}}
        <div class="glass-card-admin rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-white">กองทุนในระบบ</h3>
                    <p class="text-xs text-gray-500 mt-0.5">รายชื่อกองทุนหมู่บ้านทั้งหมดที่ลงทะเบียน</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-500/15 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                    {{ $totalFunds }} กองทุน
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">ชื่อกองทุน</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">รหัส</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">จังหวัด</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">สมาชิก</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">สินเชื่อรวม</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">สถานะ</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">วันที่ลงทะเบียน</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($sampleFunds as $index => $fund)
                            <tr class="table-row-admin hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-white">{{ $fund['name'] }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-indigo-400 font-mono">{{ $fund['code'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-300">{{ $fund['province'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-300 text-right">{{ number_format($fund['members']) }} คน</td>
                                <td class="px-6 py-4 text-sm text-white text-right font-medium">&#3647;{{ number_format($fund['loans'], 2) }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($fund['status'] === 'active')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">ใช้งาน</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-500/15 text-amber-400 ring-1 ring-inset ring-amber-500/20">รอตรวจสอบ</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $fund['registered'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="glass-card-admin rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5">
                <h3 class="text-base font-semibold text-white">กิจกรรมล่าสุด</h3>
                <p class="text-xs text-gray-500 mt-0.5">การดำเนินการล่าสุดในระบบ</p>
            </div>
            <div class="p-5">
                <div class="space-y-0">
                    @foreach ($recentActivities as $activity)
                        <div class="relative activity-line flex items-start gap-4 pb-5">
                            {{-- Icon --}}
                            @php
                                $iconColors = [
                                    'register' => 'from-indigo-500 to-indigo-600 shadow-indigo-500/30',
                                    'payment'  => 'from-emerald-500 to-green-600 shadow-emerald-500/30',
                                    'loan'     => 'from-amber-500 to-orange-500 shadow-amber-500/30',
                                    'deposit'  => 'from-blue-500 to-blue-600 shadow-blue-500/30',
                                    'profit'   => 'from-purple-500 to-purple-600 shadow-purple-500/30',
                                ];
                                $colorClass = $iconColors[$activity['type']] ?? 'from-gray-500 to-gray-600 shadow-gray-500/30';
                            @endphp
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br {{ $colorClass }} flex items-center justify-center shadow-lg shrink-0 z-10">
                                @switch($activity['type'])
                                    @case('register')
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                        @break
                                    @case('payment')
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                        @break
                                    @case('loan')
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                        @break
                                    @case('deposit')
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                                        @break
                                    @case('profit')
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                                        @break
                                @endswitch
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0 pt-1">
                                <p class="text-sm text-white">
                                    <span class="font-medium">{{ $activity['action'] }}</span>
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $activity['fund'] }}</p>
                            </div>

                            {{-- Time --}}
                            <span class="text-xs text-gray-500 shrink-0 pt-1.5">{{ $activity['time'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartFont = { family: "'Inter', 'Noto Sans Thai', sans-serif" };

    @php
        $chartLabels = $regionLabels;
        $chartData = $regionCounts;
    @endphp

    const distCtx = document.getElementById('fundsDistributionChart');
    if (distCtx) {
        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'จำนวนกองทุน',
                    data: @json($chartData),
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
