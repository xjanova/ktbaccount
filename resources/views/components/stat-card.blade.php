@props([
    'icon' => '',
    'label' => '',
    'value' => '0',
    'trend' => null,
    'color' => 'primary',
])

@php
    $colorMap = [
        'primary' => ['bg' => 'bg-primary-500/20', 'text' => 'text-primary-400', 'border' => 'border-primary-500/20'],
        'green'   => ['bg' => 'bg-green-500/20',   'text' => 'text-green-400',   'border' => 'border-green-500/20'],
        'red'     => ['bg' => 'bg-red-500/20',     'text' => 'text-red-400',     'border' => 'border-red-500/20'],
        'yellow'  => ['bg' => 'bg-yellow-500/20',  'text' => 'text-yellow-400',  'border' => 'border-yellow-500/20'],
        'blue'    => ['bg' => 'bg-blue-500/20',    'text' => 'text-blue-400',    'border' => 'border-blue-500/20'],
    ];
    $colors = $colorMap[$color] ?? $colorMap['primary'];
@endphp

<div class="bg-gradient-card rounded-2xl p-5 hover:border-primary-400/30 transition-all duration-300 group">
    <div class="flex items-start justify-between">
        <div class="flex-1 min-w-0">
            <p class="text-sm text-gray-400 mb-1">{{ $label }}</p>
            <p class="text-2xl font-bold text-white truncate">{{ $value }}</p>
            @if ($trend !== null)
                <div class="flex items-center gap-1 mt-2">
                    @if ($trend >= 0)
                        <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>
                        <span class="text-xs text-green-400">+{{ $trend }}%</span>
                    @else
                        <svg class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                        </svg>
                        <span class="text-xs text-red-400">{{ $trend }}%</span>
                    @endif
                </div>
            @endif
        </div>
        <div class="shrink-0 w-12 h-12 rounded-xl {{ $colors['bg'] }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
            <div class="{{ $colors['text'] }}">
                {!! $icon !!}
            </div>
        </div>
    </div>
</div>
