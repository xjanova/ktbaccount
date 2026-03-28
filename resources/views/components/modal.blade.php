@props([
    'name' => '',
    'title' => '',
    'maxWidth' => 'lg',
])

@php
    $maxWidthMap = [
        'sm'  => 'sm:max-w-sm',
        'md'  => 'sm:max-w-md',
        'lg'  => 'sm:max-w-lg',
        'xl'  => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ];
    $widthClass = $maxWidthMap[$maxWidth] ?? $maxWidthMap['lg'];
@endphp

<div x-data="{ show: false }"
     x-on:open-modal.window="if ($event.detail === '{{ $name }}') show = true"
     x-on:close-modal.window="if ($event.detail === '{{ $name }}') show = false"
     x-on:keydown.escape.window="show = false"
     x-show="show"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-{{ $name }}"
     role="dialog"
     aria-modal="true">

    {{-- Backdrop --}}
    <div x-show="show"
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm"
         @click="show = false"></div>

    {{-- Modal panel --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="show"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative w-full {{ $widthClass }} bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800">
                <h3 class="text-lg font-semibold text-white" id="modal-{{ $name }}">{{ $title }}</h3>
                <button @click="show = false" class="p-1 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 transition-colors" title="ปิด">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="px-6 py-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
