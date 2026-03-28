@extends('layouts.guide')

@section('guide-content')
<div class="-mt-8">
    {{-- Search header --}}
    <div class="py-8 sm:py-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            ผลการค้นหา
        </h1>

        {{-- Search form --}}
        <form action="{{ route('guide.search') }}" method="GET" class="max-w-lg relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" name="q" value="{{ $query }}"
                   placeholder="พิมพ์เพื่อค้นหา..."
                   autofocus
                   class="w-full pl-12 pr-4 py-3 bg-gray-800 border border-gray-700 rounded-xl text-base text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
        </form>

        @if($query)
            <p class="text-sm text-gray-500 mt-3">
                ค้นหา "<span class="text-gray-300">{{ $query }}</span>" พบ {{ count($results) }} ผลลัพธ์
            </p>
        @endif
    </div>

    {{-- Results --}}
    @if(count($results) > 0)
        <div class="space-y-3">
            @foreach($results as $result)
                <a href="{{ $result['url'] }}"
                   class="group flex items-start gap-4 p-5 rounded-xl border border-gray-800 bg-gray-900/50 hover:border-primary-700/50 hover:bg-gray-900 transition-all duration-200">
                    <span class="text-2xl shrink-0 mt-0.5">{{ $result['icon'] }}</span>
                    <div class="min-w-0">
                        <p class="text-base font-medium text-white group-hover:text-primary-300 transition-colors">
                            {{ $result['title'] }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            หมวด: {{ $result['category'] }}
                        </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-primary-400 ml-auto shrink-0 mt-1 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @endforeach
        </div>
    @elseif($query)
        {{-- No results --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-5">
                <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-300 mb-2">ไม่พบผลลัพธ์</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto">
                ไม่พบหัวข้อที่ตรงกับ "<span class="text-gray-400">{{ $query }}</span>"
                ลองใช้คำค้นหาอื่น หรือเลือกจากสารบัญด้านล่าง
            </p>
            <a href="{{ route('guide.index') }}"
               class="inline-flex items-center gap-2 mt-6 px-5 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                </svg>
                ดูสารบัญทั้งหมด
            </a>
        </div>
    @else
        {{-- Empty state before searching --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-5">
                <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-300 mb-2">ค้นหาในคู่มือ</h3>
            <p class="text-sm text-gray-500">
                พิมพ์คำค้นหาด้านบนเพื่อค้นหาบทเรียนที่ต้องการ
            </p>
        </div>
    @endif
</div>
@endsection
