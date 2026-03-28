@extends('layouts.app')

@section('title', 'ตั้งค่า LINE OA')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">ตั้งค่า LINE Official Account</h1>
        <p class="mt-1 text-gray-400">เชื่อมต่อ LINE OA ของกองทุนเพื่อส่งแจ้งเตือนให้สมาชิก</p>
    </div>

    {{-- Status Card --}}
    <div class="mb-6 rounded-xl p-4 {{ $config->webhook_verified ? 'bg-green-900/30 border border-green-700' : 'bg-yellow-900/30 border border-yellow-700' }}">
        <div class="flex items-center gap-3">
            @if($config->webhook_verified)
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-green-300 font-medium">เชื่อมต่อ LINE OA สำเร็จ</span>
            @else
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <span class="text-yellow-300 font-medium">ยังไม่ได้เชื่อมต่อ LINE OA</span>
            @endif
        </div>
    </div>

    {{-- Webhook URL --}}
    <div class="mb-6 bg-gray-800/50 rounded-xl border border-gray-700 p-5">
        <label class="block text-sm font-medium text-gray-300 mb-2">
            Webhook URL
            <span class="ml-1 text-gray-500">(นำไปตั้งค่าใน LINE Developers Console)</span>
        </label>
        <div class="flex items-center gap-2">
            <input type="text" value="{{ $webhookUrl }}" readonly
                class="flex-1 bg-gray-900 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-300 text-sm font-mono"
                id="webhookUrl">
            <button onclick="navigator.clipboard.writeText(document.getElementById('webhookUrl').value); this.textContent='คัดลอกแล้ว!'; setTimeout(() => this.textContent='คัดลอก', 2000)"
                class="px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition-colors">
                คัดลอก
            </button>
        </div>
    </div>

    {{-- Settings Form --}}
    <form method="POST" action="{{ route('fund.settings.line.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-gray-800/50 rounded-xl border border-gray-700 p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-gray-700 pb-3">ข้อมูล LINE Messaging API</h2>

            {{-- Channel ID --}}
            <div>
                <label for="channel_id" class="block text-sm font-medium text-gray-300 mb-1">
                    Channel ID
                    <span class="text-gray-500 text-xs ml-1">(จาก LINE Developers Console)</span>
                </label>
                <input type="text" name="channel_id" id="channel_id" value="{{ old('channel_id', $config->channel_id) }}"
                    class="w-full bg-gray-900 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                    placeholder="1234567890">
                @error('channel_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Channel Secret --}}
            <div>
                <label for="channel_secret" class="block text-sm font-medium text-gray-300 mb-1">
                    Channel Secret
                </label>
                <input type="password" name="channel_secret" id="channel_secret" value="{{ old('channel_secret', $config->channel_secret) }}"
                    class="w-full bg-gray-900 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                    placeholder="••••••••••••">
                @error('channel_secret')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Access Token --}}
            <div>
                <label for="access_token" class="block text-sm font-medium text-gray-300 mb-1">
                    Channel Access Token (Long-lived)
                </label>
                <textarea name="access_token" id="access_token" rows="3"
                    class="w-full bg-gray-900 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 text-sm font-mono"
                    placeholder="Channel Access Token">{{ old('access_token', $config->access_token) }}</textarea>
                @error('access_token')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="bg-gray-800/50 rounded-xl border border-gray-700 p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-gray-700 pb-3">ข้อความต้อนรับ</h2>

            <div>
                <label for="greeting_message" class="block text-sm font-medium text-gray-300 mb-1">
                    ข้อความต้อนรับสมาชิกใหม่
                    <span class="text-gray-500 text-xs ml-1">(ส่งเมื่อสมาชิก add friend)</span>
                </label>
                <textarea name="greeting_message" id="greeting_message" rows="4"
                    class="w-full bg-gray-900 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500"
                    placeholder="ยินดีต้อนรับสู่กองทุนหมู่บ้าน...">{{ old('greeting_message', $config->greeting_message) }}</textarea>
                @error('greeting_message')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('fund.settings') }}" class="px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                ยกเลิก
            </a>
            <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
                บันทึกการตั้งค่า
            </button>
        </div>
    </form>

    {{-- Setup Guide --}}
    <div class="mt-8 bg-gray-800/30 rounded-xl border border-gray-700/50 p-6">
        <h3 class="text-lg font-semibold text-white mb-4">วิธีตั้งค่า LINE OA</h3>
        <ol class="space-y-3 text-gray-300 text-sm">
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center text-xs font-bold text-white">1</span>
                <span>เข้า <a href="https://developers.line.biz/console/" target="_blank" class="text-primary-400 hover:underline">LINE Developers Console</a> และสร้าง Messaging API Channel</span>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center text-xs font-bold text-white">2</span>
                <span>คัดลอก Channel ID, Channel Secret และ Channel Access Token มาใส่ด้านบน</span>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center text-xs font-bold text-white">3</span>
                <span>คัดลอก Webhook URL ด้านบนไปตั้งค่าใน LINE Developers Console > Messaging API > Webhook URL</span>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center text-xs font-bold text-white">4</span>
                <span>เปิดใช้งาน "Use webhook" ใน LINE Developers Console</span>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center text-xs font-bold text-white">5</span>
                <span>กดบันทึกการตั้งค่า ระบบจะตรวจสอบการเชื่อมต่ออัตโนมัติ</span>
            </li>
        </ol>
    </div>
</div>
@endsection
