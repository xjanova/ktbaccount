@props([
    'title' => '',
    'chartId' => 'chart',
    'height' => '300px',
])

<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-800">
        <h3 class="text-base font-semibold text-white">{{ $title }}</h3>
    </div>
    <div class="p-5">
        <div style="height: {{ $height }}">
            <canvas id="{{ $chartId }}"></canvas>
        </div>
    </div>
    @if (isset($footer))
        <div class="px-5 py-3 border-t border-gray-800 bg-gray-800/30">
            {{ $footer }}
        </div>
    @endif
</div>
