@props([
    'src' => null,
    'alt' => '',
    'caption' => '',
    'number' => null,
    'type' => 'web',
])

@php
    // Auto-number: use provided number or fall back to a counter
    static $screenshotCounter = 0;
    $screenshotCounter++;
    $displayNumber = $number ?? $screenshotCounter;

    // Check if the image file actually exists
    $imageExists = $src && file_exists(public_path('images/guide/' . $src));
    $imagePath = $imageExists ? asset('images/guide/' . $src) : null;

    $uniqueId = 'screenshot-' . $displayNumber . '-' . Str::random(6);
@endphp

<figure class="my-8 max-w-2xl mx-auto" x-data="{ lightboxOpen: false }">
    @if($imageExists)
        {{-- Real image --}}
        <div class="relative group cursor-pointer" @click="lightboxOpen = true">
            <img src="{{ $imagePath }}"
                 alt="{{ $alt ?: $caption }}"
                 class="w-full rounded-xl border border-gray-700 shadow-lg transition-transform duration-200 group-hover:scale-[1.01] group-hover:shadow-primary-900/20"
                 loading="lazy">
            {{-- Zoom overlay hint --}}
            <div class="absolute inset-0 rounded-xl bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-opacity bg-black/60 rounded-full p-3">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Lightbox --}}
        <div x-show="lightboxOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="lightboxOpen = false"
             @keydown.escape.window="lightboxOpen = false"
             class="fixed inset-0 z-[60] flex items-center justify-center bg-black/90 p-4 sm:p-8"
             style="display: none;">
            {{-- Close button --}}
            <button @click="lightboxOpen = false"
                    class="absolute top-4 right-4 text-white/80 hover:text-white bg-black/40 rounded-full p-2 transition-colors z-10">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            {{-- Full image --}}
            <img src="{{ $imagePath }}"
                 alt="{{ $alt ?: $caption }}"
                 class="max-w-full max-h-full rounded-lg shadow-2xl object-contain"
                 @click.stop>
        </div>
    @else
        {{-- Placeholder --}}
        <div class="flex flex-col items-center justify-center min-h-[200px] rounded-xl border-2 border-dashed border-gray-600 bg-gray-800/50 px-6 py-8">
            @if($type === 'app')
                {{-- Phone/app icon --}}
                <div class="mb-4 p-4 rounded-2xl bg-gray-700/50">
                    <svg class="w-10 h-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>
            @else
                {{-- Camera/web icon --}}
                <div class="mb-4 p-4 rounded-2xl bg-gray-700/50">
                    <svg class="w-10 h-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                </div>
            @endif

            <p class="text-sm font-medium text-gray-400 text-center">
                ภาพประกอบที่ {{ $displayNumber }}: {{ $caption }}
            </p>
            <p class="text-xs text-gray-600 mt-2 text-center">
                @if($type === 'app')
                    (จำลองหน้าจอแอป - รูปจริงจะถูกเพิ่มภายหลัง)
                @else
                    (รูปภาพจะถูกเพิ่มเร็วๆ นี้)
                @endif
            </p>
        </div>
    @endif

    {{-- Caption --}}
    @if($caption)
        <figcaption class="mt-3 text-sm text-gray-400 text-center">
            <span class="text-gray-500">ภาพที่ {{ $displayNumber }}:</span> {{ $caption }}
        </figcaption>
    @endif
</figure>
