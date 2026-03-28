@props([
    'type' => 'tip',
])

@php
    $config = match($type) {
        'warning' => [
            'label'   => 'ข้อควรระวัง',
            'icon'    => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>',
            'border'  => 'border-red-500',
            'bg'      => 'bg-red-950/40',
            'iconBg'  => 'text-red-400',
            'label_c' => 'text-red-400',
        ],
        'info' => [
            'label'   => 'หมายเหตุ',
            'icon'    => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>',
            'border'  => 'border-blue-500',
            'bg'      => 'bg-blue-950/40',
            'iconBg'  => 'text-blue-400',
            'label_c' => 'text-blue-400',
        ],
        'important' => [
            'label'   => 'สำคัญ',
            'icon'    => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>',
            'border'  => 'border-yellow-500',
            'bg'      => 'bg-yellow-950/40',
            'iconBg'  => 'text-yellow-400',
            'label_c' => 'text-yellow-400',
        ],
        default => [ // tip
            'label'   => 'คำแนะนำ',
            'icon'    => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" /></svg>',
            'border'  => 'border-green-500',
            'bg'      => 'bg-green-950/40',
            'iconBg'  => 'text-green-400',
            'label_c' => 'text-green-400',
        ],
    };
@endphp

<div class="my-6 rounded-xl border-l-4 {{ $config['border'] }} {{ $config['bg'] }} p-5">
    <div class="flex items-center gap-2.5 mb-2">
        <span class="{{ $config['iconBg'] }}">
            {!! $config['icon'] !!}
        </span>
        <span class="text-sm font-semibold {{ $config['label_c'] }} uppercase tracking-wide">
            {{ $config['label'] }}
        </span>
    </div>
    <div class="text-gray-300 text-[0.95rem] leading-relaxed pl-7">
        {{ $slot }}
    </div>
</div>
