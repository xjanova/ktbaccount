<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - KTB Account Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-950">

    {{-- Mobile sidebar overlay --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/60 lg:hidden" @click="sidebarOpen = false"></div>

    {{-- Admin Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-primary transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:z-auto flex flex-col">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-primary-800/50">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-red-500/20">
                <svg class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </div>
            <div>
                <span class="text-sm font-bold text-white tracking-wide">XMAN Studio</span>
                <p class="text-xs text-red-300">ผู้ดูแลระบบ</p>
            </div>
            <button @click="sidebarOpen = false" class="ml-auto lg:hidden text-primary-300 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Admin Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            <p class="px-3 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">ภาพรวม</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-900/50 text-white' : 'text-primary-200 hover:bg-primary-900/30 hover:text-white' }}" title="ภาพรวมระบบ">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>ภาพรวมระบบ</span>
            </a>

            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">จัดการ</p>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-primary-200 hover:bg-primary-900/30 hover:text-white transition-colors" title="กองทุนทั้งหมด">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" />
                </svg>
                <span>กองทุนทั้งหมด</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-primary-200 hover:bg-primary-900/30 hover:text-white transition-colors" title="ผู้ใช้ระบบ">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>ผู้ใช้ระบบ</span>
            </a>

            <p class="px-3 mt-6 mb-2 text-xs font-semibold text-primary-400 uppercase tracking-wider">ตั้งค่าระบบ</p>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-primary-200 hover:bg-primary-900/30 hover:text-white transition-colors" title="ตั้งค่าระบบ">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span>ตั้งค่าระบบ</span>
            </a>
        </nav>

        {{-- Sidebar footer --}}
        <div class="px-4 py-3 border-t border-primary-800/50">
            <p class="text-xs text-primary-400 text-center">&copy; {{ date('Y') }} XMAN Studio Admin</p>
        </div>
    </aside>

    {{-- Main content area --}}
    <div class="lg:ml-64 min-h-screen flex flex-col">

        {{-- Top bar --}}
        <header class="sticky top-0 z-30 bg-gray-900/80 backdrop-blur-xl border-b border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-6 py-3">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" title="เปิดเมนู">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-semibold text-white">@yield('page-title', 'ผู้ดูแลระบบ')</h1>
                        <p class="text-xs text-red-400">Super Admin Panel</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-800 transition-colors" title="โปรไฟล์ผู้ดูแล">
                            <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-sm font-bold text-white">
                                {{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="hidden sm:block text-sm text-gray-300">{{ auth()->user()->name ?? 'Admin' }}</span>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                             x-transition class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-xl shadow-xl py-1 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">โปรไฟล์</a>
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
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mx-4 sm:mx-6 mt-4">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-900/30 border border-green-700/50 text-green-300">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span class="text-sm">{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto text-green-400 hover:text-green-200"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" class="mx-4 sm:mx-6 mt-4">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-900/30 border border-red-700/50 text-red-300">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                    <span class="text-sm">{{ session('error') }}</span>
                    <button @click="show = false" class="ml-auto text-red-400 hover:text-red-200"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg></button>
                </div>
            </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="px-4 sm:px-6 py-4 border-t border-gray-800">
            <p class="text-xs text-gray-500 text-center">&copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน v{{ file_get_contents(base_path('VERSION')) }}</p>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
