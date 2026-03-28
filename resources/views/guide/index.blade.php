@extends('layouts.guide')

@php
    $isIndex = true;
@endphp

@section('guide-content')
<div class="-mt-8">

    {{-- Hero Section --}}
    <div class="text-center py-12 sm:py-16">
        <div class="text-5xl mb-6">📚</div>
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4 leading-relaxed">
            คู่มือการใช้งาน
        </h1>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
            ระบบบริหารกองทุนหมู่บ้าน - เรียนรู้การใช้งานทุกฟีเจอร์แบบง่ายๆ
        </p>

        {{-- Search bar --}}
        <div class="max-w-lg mx-auto mt-8">
            <form action="{{ route('guide.search') }}" method="GET" class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text" name="q"
                       placeholder="พิมพ์เพื่อค้นหา เช่น สินเชื่อ, เงินฝาก, รายงาน..."
                       class="w-full pl-12 pr-4 py-3.5 bg-gray-800 border border-gray-700 rounded-xl text-base text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent shadow-lg transition-all">
            </form>
        </div>
    </div>

    {{-- Featured: Getting Started --}}
    @if(isset($categories['getting-started']))
        @php $feat = $categories['getting-started']; @endphp
        <div class="mb-10">
            <div class="relative overflow-hidden rounded-2xl border border-primary-700/50 bg-gradient-to-br from-primary-950/80 via-gray-900 to-gray-900 p-6 sm:p-8">
                {{-- Decorative glow --}}
                <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary-600/10 rounded-full blur-3xl"></div>

                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">{{ $feat['icon'] }}</span>
                        <div>
                            <h2 class="text-xl font-bold text-white">{{ $feat['title'] }}</h2>
                            <p class="text-sm text-primary-300">เริ่มจากตรงนี้ถ้าใช้งานเป็นครั้งแรก</p>
                        </div>
                        <span class="ml-auto hidden sm:inline-flex items-center px-3 py-1 rounded-full bg-primary-600/20 text-primary-300 text-xs font-medium border border-primary-700/50">
                            {{ count($feat['pages']) }} บทเรียน
                        </span>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-3 mt-4">
                        @foreach($feat['pages'] as $pageKey => $pageTitle)
                            <a href="{{ route('guide.show', ['getting-started', $pageKey]) }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-800/50 border border-gray-700/50 hover:border-primary-600 hover:bg-primary-900/20 transition-all group">
                                <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary-600/20 text-primary-400 text-sm font-bold shrink-0">
                                    {{ $loop->iteration }}
                                </span>
                                <span class="text-sm text-gray-300 group-hover:text-white transition-colors">{{ $pageTitle }}</span>
                                <svg class="w-4 h-4 text-gray-600 group-hover:text-primary-400 ml-auto shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Category Grid --}}
    <div class="grid sm:grid-cols-2 gap-5">
        @foreach($categories as $catKey => $cat)
            @if($catKey === 'getting-started') @continue @endif

            <div class="group relative rounded-2xl border border-gray-800 bg-gray-900/50 p-6 hover:border-primary-700/50 transition-all duration-300 hover:shadow-lg hover:shadow-primary-900/10">
                {{-- Hover glow --}}
                <div class="absolute -inset-px rounded-2xl bg-gradient-to-br from-primary-600/0 to-primary-600/0 group-hover:from-primary-600/5 group-hover:to-transparent transition-all duration-300 pointer-events-none"></div>

                <div class="relative">
                    {{-- Category header --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">{{ $cat['icon'] }}</span>
                            <h3 class="text-lg font-semibold text-white">{{ $cat['title'] }}</h3>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-800 text-gray-400 text-xs font-medium">
                            {{ count($cat['pages']) }}
                        </span>
                    </div>

                    {{-- Page links --}}
                    <ul class="space-y-1.5">
                        @foreach($cat['pages'] as $pageKey => $pageTitle)
                            <li>
                                <a href="{{ route('guide.show', [$catKey, $pageKey]) }}"
                                   class="flex items-center gap-2 px-3 py-2 -mx-1 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-gray-800/70 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-gray-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    {{ $pageTitle }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Bottom help text --}}
    <div class="text-center mt-14 mb-4">
        <p class="text-sm text-gray-500">
            มีข้อสงสัย? ติดต่อทีมงาน XMAN Studio ได้ทุกช่องทาง
        </p>
    </div>
</div>
@endsection
