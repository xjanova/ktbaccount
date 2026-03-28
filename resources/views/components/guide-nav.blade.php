@props([
    'prevPage' => null,
    'nextPage' => null,
])

<nav class="flex items-stretch gap-4 border-t border-gray-800 pt-8">
    {{-- Previous page --}}
    <div class="flex-1">
        @if($prevPage)
            <a href="{{ $prevPage['url'] }}"
               class="group flex flex-col h-full p-4 rounded-xl border border-gray-800 hover:border-primary-700 hover:bg-gray-900/50 transition-all duration-200">
                <span class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    ก่อนหน้า
                </span>
                <span class="text-sm font-medium text-gray-300 group-hover:text-primary-300 transition-colors leading-snug">
                    {{ $prevPage['title'] }}
                </span>
            </a>
        @endif
    </div>

    {{-- Next page --}}
    <div class="flex-1">
        @if($nextPage)
            <a href="{{ $nextPage['url'] }}"
               class="group flex flex-col items-end h-full p-4 rounded-xl border border-gray-800 hover:border-primary-700 hover:bg-gray-900/50 transition-all duration-200">
                <span class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    ถัดไป
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </span>
                <span class="text-sm font-medium text-gray-300 group-hover:text-primary-300 transition-colors leading-snug text-right">
                    {{ $nextPage['title'] }}
                </span>
            </a>
        @endif
    </div>
</nav>
