@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'tooltip' => null,
    'placeholder' => '',
])

<div>
    <label for="{{ $name }}" class="flex items-center gap-1.5 text-sm font-medium text-gray-300 mb-1.5">
        {{ $label }}
        @if ($required)
            <span class="text-red-400">*</span>
        @endif
        @if ($tooltip)
            <div x-data="{ show: false }" class="relative inline-block">
                <button type="button" @mouseenter="show = true" @mouseleave="show = false" class="text-gray-500 hover:text-gray-300" title="{{ $tooltip }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                </button>
                <div x-show="show" x-transition
                     class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1.5 text-xs text-white bg-gray-700 rounded-lg shadow-lg whitespace-nowrap z-50">
                    {{ $tooltip }}
                    <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-1 w-2 h-2 bg-gray-700 rotate-45"></div>
                </div>
            </div>
        @endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-sm']) }}
    >
    @error($name)
        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
    @enderror
</div>
