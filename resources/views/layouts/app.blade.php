<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'KTB Account' }} - ระบบบริหารกองทุนหมู่บ้าน</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-950">

    {{-- Mobile sidebar overlay --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/60 lg:hidden" @click="sidebarOpen = false"></div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-52 bg-gradient-primary transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-primary-800/50">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary-500/20">
                <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
            </div>
            <div>
                <span class="text-sm font-bold text-white tracking-wide">XMAN Studio</span>
                <p class="text-xs text-primary-300 truncate">{{ auth()->user()->fund->name ?? 'กองทุนหมู่บ้าน' }}</p>
            </div>
            <button @click="sidebarOpen = false" class="ml-auto lg:hidden text-primary-300 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            {{-- หน้าหลัก --}}
            <p class="px-3 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">หน้าหลัก</p>
            <a href="{{ route('fund.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('fund.dashboard') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }}" title="แดชบอร์ด">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>แดชบอร์ด</span>
            </a>

            {{-- บัญชี --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">บัญชี</p>
            <a href="{{ route('fund.transactions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('fund.transactions.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }}" title="รายรับ-รายจ่าย">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>
                <span>รายรับ-รายจ่าย</span>
            </a>
            <a href="{{ route('fund.reports.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('fund.reports.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }}" title="รายงาน">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
                <span>รายงาน</span>
            </a>

            {{-- บริการการเงิน --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">บริการการเงิน</p>
            <a href="{{ route('fund.loans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('fund.loans.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }}" title="สินเชื่อ">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>สินเชื่อ</span>
            </a>
            <a href="{{ route('fund.deposits.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fund.deposits.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }} transition-colors" title="เงินฝาก">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
                <span>เงินฝาก</span>
            </a>
            <a href="{{ route('fund.shares.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fund.shares.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }} transition-colors" title="หุ้น">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                <span>หุ้น</span>
            </a>

            {{-- สมาชิก --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">สมาชิก</p>
            <a href="{{ route('fund.members.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fund.members.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }} transition-colors" title="รายชื่อสมาชิก">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>รายชื่อสมาชิก</span>
            </a>

            {{-- อนุมัติ --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">อนุมัติ</p>
            <a href="{{ route('fund.approvals.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fund.approvals.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }} transition-colors" title="รออนุมัติ">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>รออนุมัติ</span>
            </a>

            {{-- ตั้งค่า --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">ตั้งค่า</p>
            <a href="{{ route('fund.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fund.settings*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }} transition-colors" title="ตั้งค่ากองทุน">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span>ตั้งค่ากองทุน</span>
            </a>
            <a href="{{ route('fund.account-sets.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fund.account-sets.*') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }} transition-colors" title="ชุดบัญชี">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                </svg>
                <span>ชุดบัญชี</span>
            </a>
        </nav>

        {{-- Sidebar footer --}}
        <div class="px-4 py-3 border-t border-primary-800/50">
            <p class="text-xs text-primary-400 text-center">&copy; {{ date('Y') }} XMAN Studio</p>
        </div>
    </aside>

    {{-- Main content area --}}
    <div class="lg:ml-52 min-h-screen flex flex-col">

        {{-- Impersonate Banner --}}
        @if(session('impersonating_tenant_id') || session('impersonating_user_id'))
        <div class="bg-gradient-to-r from-amber-600 to-orange-600 text-white px-4 py-2 text-sm flex items-center justify-between z-50">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                <span class="font-medium">🔑 Super Admin Mode:</span>
                <span>กำลังจัดการ {{ session('impersonating_tenant_name', '') }} {{ session('impersonating_user_name') ? '(ในนาม '.session('impersonating_user_name').')' : '' }}</span>
            </div>
            <form method="POST" action="{{ session('impersonating_user_id') ? route('admin.impersonate.leave-user') : route('admin.impersonate.leave') }}">
                @csrf
                <button type="submit" class="px-3 py-1 bg-white/20 hover:bg-white/30 rounded-lg text-xs font-medium transition-colors">
                    ← กลับหน้า Admin
                </button>
            </form>
        </div>
        @endif

        {{-- Top bar --}}
        <header class="sticky top-0 z-30 bg-gray-900/80 backdrop-blur-xl border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 py-3">
                {{-- Left: hamburger + breadcrumb --}}
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" title="เปิดเมนู">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-semibold text-white">@yield('page-title', 'แดชบอร์ด')</h1>
                        <p class="text-xs text-gray-400">
                            @if(session('impersonating_tenant_name'))
                                {{ session('impersonating_tenant_name') }}
                            @else
                                กองทุนหมู่บ้าน
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Right: notifications + profile --}}
                <div class="flex items-center gap-2">
                    {{-- Notifications --}}
                    <button class="relative p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" title="การแจ้งเตือน">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    {{-- Profile dropdown --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-800 transition-colors" title="โปรไฟล์">
                            <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-sm font-bold text-white">
                                {{ mb_substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="hidden sm:block text-sm text-gray-300">{{ auth()->user()->name ?? 'ผู้ใช้' }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-xl shadow-xl py-1 z-50">
                            <a href="{{ route('fund.dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">โปรไฟล์</a>
                            <a href="{{ route('fund.settings') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">ตั้งค่า</a>
                            <hr class="my-1 border-gray-700">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 transition-colors">ออกจากระบบ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="mx-4 sm:mx-6 mt-4">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-900/30 border border-green-700/50 text-green-300">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="text-sm">{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto text-green-400 hover:text-green-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)"
                 x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="mx-4 sm:mx-6 mt-4">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-900/30 border border-red-700/50 text-red-300">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <span class="text-sm">{{ session('error') }}</span>
                    <button @click="show = false" class="ml-auto text-red-400 hover:text-red-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="px-4 sm:px-6 py-4 border-t border-gray-800">
            <p class="text-xs text-gray-500 text-center">&copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน v{{ $appVersion }}</p>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
