@props([
    'title' => '',
    'description' => null,
    'createUrl' => null,
    'createLabel' => null,
])

<div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
    {{-- Header --}}
    @if ($title || $createUrl)
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-4 border-b border-gray-800">
            <div>
                @if ($title)
                    <h3 class="text-base font-semibold text-white">{{ $title }}</h3>
                @endif
                @if ($description)
                    <p class="text-sm text-gray-400 mt-0.5">{{ $description }}</p>
                @endif
            </div>
            @if ($createUrl)
                <a href="{{ $createUrl }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="{{ $createLabel ?? 'เพิ่มรายการ' }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ $createLabel ?? 'เพิ่มรายการ' }}
                </a>
            @endif
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-800/50">
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
