@props([
    'number',
    'title',
])

<div class="relative flex gap-5 pb-8 last:pb-0 group">
    {{-- Vertical connecting line --}}
    <div class="absolute left-5 top-12 bottom-0 w-0.5 bg-gray-800 group-last:hidden"></div>

    {{-- Step number circle --}}
    <div class="relative z-10 flex items-center justify-center shrink-0 w-10 h-10 rounded-full bg-primary-600 text-white font-bold text-sm shadow-lg shadow-primary-900/30">
        {{ $number }}
    </div>

    {{-- Step content --}}
    <div class="flex-1 min-w-0 pt-1">
        <h4 class="text-lg font-semibold text-white mb-3 leading-relaxed">
            {{ $title }}
        </h4>
        <div class="text-gray-300 leading-relaxed space-y-3">
            {{ $slot }}
        </div>
    </div>
</div>
