<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $currentTitle ?? 'คู่มือการใช้งาน' }} - KTB Account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Guide-specific styles */
        .guide-content {
            font-size: 1rem;
            line-height: 1.8;
        }
        .guide-content p {
            margin-bottom: 1rem;
        }
        .guide-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #c7d2fe;
            border-bottom: 1px solid rgba(99, 102, 241, 0.3);
            padding-bottom: 0.5rem;
        }
        .guide-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: #a5b4fc;
        }
        .guide-content ul, .guide-content ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }
        .guide-content ul { list-style-type: disc; }
        .guide-content ol { list-style-type: decimal; }
        .guide-content li {
            margin-bottom: 0.5rem;
        }
        .guide-content strong {
            color: #e0e7ff;
            font-weight: 600;
        }
        .guide-content code {
            background: rgba(99, 102, 241, 0.15);
            color: #a5b4fc;
            padding: 0.15rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.9em;
        }
        .guide-sidebar::-webkit-scrollbar { width: 4px; }
        .guide-sidebar::-webkit-scrollbar-track { background: transparent; }
        .guide-sidebar::-webkit-scrollbar-thumb { background: #4338ca; border-radius: 2px; }
    </style>
</head>
<body class="min-h-screen bg-gray-950 text-gray-100 font-sans antialiased">
    <div x-data="{
        sidebarOpen: false,
        searchOpen: false,
        searchQuery: '',
        expandedCategories: { '{{ $category ?? '' }}': true }
    }">

        {{-- ========== Top Header Bar ========== --}}
        <header class="fixed top-0 left-0 right-0 z-40 bg-gray-900/95 backdrop-blur-sm border-b border-gray-800">
            <div class="flex items-center justify-between h-16 px-4 lg:px-6">
                {{-- Left: Logo + Title --}}
                <div class="flex items-center gap-3">
                    {{-- Mobile hamburger --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 -ml-2 text-gray-400 hover:text-white rounded-lg hover:bg-gray-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <a href="{{ route('guide.index') }}" class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-600">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div class="hidden sm:block">
                            <span class="text-sm font-bold text-white tracking-wide">XMAN Studio</span>
                            <span class="text-gray-500 mx-1.5">|</span>
                            <span class="text-sm text-primary-300">คู่มือการใช้งาน</span>
                        </div>
                    </a>
                </div>

                {{-- Center: Search --}}
                <div class="hidden md:flex items-center flex-1 max-w-md mx-8">
                    <form action="{{ route('guide.search') }}" method="GET" class="w-full relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="text" name="q" value="{{ $query ?? '' }}"
                               placeholder="ค้นหาในคู่มือ..."
                               class="w-full pl-10 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    </form>
                </div>

                {{-- Right: Links --}}
                <div class="flex items-center gap-2">
                    {{-- Mobile search toggle --}}
                    <button @click="searchOpen = !searchOpen"
                            class="md:hidden p-2 text-gray-400 hover:text-white rounded-lg hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    <a href="/"
                       class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-gray-400 hover:text-white rounded-lg hover:bg-gray-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>กลับหน้าหลัก</span>
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm bg-primary-600 hover:bg-primary-500 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        <span class="hidden sm:inline">เข้าสู่ระบบ</span>
                    </a>
                </div>
            </div>

            {{-- Mobile search bar (expandable) --}}
            <div x-show="searchOpen" x-collapse class="md:hidden px-4 pb-3">
                <form action="{{ route('guide.search') }}" method="GET" class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text" name="q" value="{{ $query ?? '' }}"
                           placeholder="ค้นหาในคู่มือ..."
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </form>
            </div>
        </header>

        {{-- ========== Mobile Sidebar Overlay ========== --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black/60 lg:hidden" @click="sidebarOpen = false">
        </div>

        <div class="flex pt-16">
            {{-- ========== Left Sidebar ========== --}}
            @unless(isset($isIndex) && $isIndex)
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 top-16 z-40 w-64 bg-gray-900 border-r border-gray-800 transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col shrink-0">

                {{-- Sidebar header --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-800">
                    <a href="{{ route('guide.index') }}" class="text-sm font-medium text-primary-300 hover:text-primary-200 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                        </svg>
                        สารบัญทั้งหมด
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white p-1 rounded">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Category navigation --}}
                <nav class="flex-1 overflow-y-auto guide-sidebar px-3 py-4 space-y-1">
                    @foreach($categories as $catKey => $cat)
                        <div x-data="{ open: expandedCategories['{{ $catKey }}'] || false }">
                            {{-- Category header --}}
                            <button @click="open = !open"
                                    class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                                           {{ ($category ?? '') === $catKey ? 'bg-primary-900/40 text-primary-200' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                                <span class="flex items-center gap-2.5">
                                    <span class="text-lg leading-none">{{ $cat['icon'] }}</span>
                                    <span>{{ $cat['title'] }}</span>
                                </span>
                                <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>

                            {{-- Child pages --}}
                            <div x-show="open" x-collapse class="ml-4 mt-1 space-y-0.5 border-l-2 border-gray-800 pl-3">
                                @foreach($cat['pages'] as $pageKey => $pageTitle)
                                    <a href="{{ route('guide.show', [$catKey, $pageKey]) }}"
                                       class="block px-3 py-2 rounded-md text-sm transition-colors
                                              {{ ($category ?? '') === $catKey && ($slug ?? '') === $pageKey
                                                  ? 'bg-primary-700 text-white font-medium'
                                                  : 'text-gray-400 hover:bg-gray-800 hover:text-gray-200' }}">
                                        {{ $pageTitle }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </nav>
            </aside>
            @endunless

            {{-- ========== Main Content Area ========== --}}
            <main class="flex-1 min-w-0 {{ isset($isIndex) && $isIndex ? '' : 'lg:ml-64' }}">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                    {{-- Breadcrumb --}}
                    @if(isset($category) && isset($currentCategory))
                    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                        <a href="{{ route('guide.index') }}" class="hover:text-primary-400 transition-colors">คู่มือ</a>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                        <span class="text-gray-400">{{ $currentCategory['icon'] }} {{ $currentCategory['title'] }}</span>
                        @if(isset($currentTitle))
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                        <span class="text-gray-200">{{ $currentTitle }}</span>
                        @endif
                    </nav>
                    @endif

                    {{-- Page title --}}
                    @if(isset($currentTitle))
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-8 leading-relaxed">
                        {{ $currentTitle }}
                    </h1>
                    @endif

                    {{-- Content --}}
                    <div class="guide-content text-gray-300">
                        @yield('guide-content')
                    </div>

                    {{-- Bottom navigation --}}
                    @if(isset($prevPage) || isset($nextPage))
                        <div class="mt-12">
                            <x-guide-nav :prevPage="$prevPage ?? null" :nextPage="$nextPage ?? null" />
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <footer class="border-t border-gray-800 mt-12">
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                        <p class="text-center text-sm text-gray-600">
                            &copy; XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน
                        </p>
                    </div>
                </footer>
            </main>
        </div>
    </div>
</body>
</html>
