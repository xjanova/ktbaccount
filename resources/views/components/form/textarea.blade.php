@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'rows' => 3,
    'required' => false,
    'placeholder' => '',
])

<div>
    <label for="{{ $name }}" class="flex items-center gap-1.5 text-sm font-medium text-gray-300 mb-1.5">
        {{ $label }}
        @if ($required)
            <span class="text-red-400">*</span>
        @endif
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-sm resize-y']) }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
    @enderror
</div>
