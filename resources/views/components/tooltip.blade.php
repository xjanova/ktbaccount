@props([
    'text' => '',
])

<div x-data="{ show: false }" class="relative inline-block" @mouseenter="show = true" @mouseleave="show = false">
    {{ $slot }}
    <div x-show="show" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
         class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1.5 text-xs text-white bg-gray-700 rounded-lg shadow-lg whitespace-nowrap z-50 pointer-events-none">
        {{ $text }}
        <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-1 w-2 h-2 bg-gray-700 rotate-45"></div>
    </div>
</div>
