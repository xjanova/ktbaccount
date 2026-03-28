@props([
    'type' => 'info',
    'message' => '',
    'dismissible' => true,
])

@php
    $typeMap = [
        'success' => ['bg' => 'bg-green-900/30', 'border' => 'border-green-700/50', 'text' => 'text-green-300', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />'],
        'error'   => ['bg' => 'bg-red-900/30',   'border' => 'border-red-700/50',   'text' => 'text-red-300',   'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.303 3.376c-.866 1.5-3.032 1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />'],
        'warning' => ['bg' => 'bg-yellow-900/30', 'border' => 'border-yellow-700/50', 'text' => 'text-yellow-300', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />'],
        'info'    => ['bg' => 'bg-blue-900/30',   'border' => 'border-blue-700/50',   'text' => 'text-blue-300',   'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />'],
    ];
    $style = $typeMap[$type] ?? $typeMap['info'];
@endphp

<div x-data="{ show: true }" x-show="show" class="flex items-start gap-3 px-4 py-3 rounded-xl {{ $style['bg'] }} border {{ $style['border'] }} {{ $style['text'] }}">
    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">{!! $style['icon'] !!}</svg>
    <div class="flex-1 text-sm">
        {{ $message }}
        {{ $slot }}
    </div>
    @if ($dismissible)
        <button @click="show = false" class="shrink-0 hover:opacity-70 transition-opacity" title="ปิด">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
    @endif
</div>
