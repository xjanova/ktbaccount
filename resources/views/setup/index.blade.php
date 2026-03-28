<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตั้งค่าระบบ - KTB Account</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
            min-height: 100vh;
            font-family: 'Noto Sans Thai', 'Inter', system-ui, sans-serif;
        }
        .setup-card {
            background: rgba(30, 27, 75, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.3);
            backdrop-filter: blur(20px);
        }
        .glow {
            box-shadow: 0 0 60px rgba(99, 102, 241, 0.15), 0 0 120px rgba(99, 102, 241, 0.05);
        }
        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-lg">

            {{-- Logo & Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-600 rounded-2xl mb-4 glow">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white">ตั้งค่าระบบ</h1>
                <p class="text-gray-400 mt-2">ระบบบริหารกองทุนหมู่บ้าน - KTB Account</p>
                <p class="text-indigo-400 text-sm mt-1">สร้างบัญชีผู้ดูแลระบบ (Super Admin) คนแรก</p>
            </div>

            {{-- Setup Form --}}
            <div class="setup-card rounded-2xl p-8 glow">

                {{-- Progress Steps --}}
                <div class="flex items-center justify-center gap-3 mb-8">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                        <span class="text-gray-300 text-sm hidden sm:inline">ติดตั้ง Server</span>
                    </div>
                    <div class="w-8 h-px bg-indigo-600"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-sm font-bold ring-2 ring-indigo-400 ring-offset-2 ring-offset-gray-900">2</div>
                        <span class="text-white text-sm font-semibold hidden sm:inline">สร้าง Admin</span>
                    </div>
                    <div class="w-8 h-px bg-gray-600"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-gray-400 text-sm font-bold">3</div>
                        <span class="text-gray-500 text-sm hidden sm:inline">เริ่มใช้งาน</span>
                    </div>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="bg-red-900/40 border border-red-700 rounded-xl p-4 mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span class="text-red-300 font-medium">กรุณาตรวจสอบข้อมูล</span>
                        </div>
                        <ul class="text-sm text-red-300 space-y-1 pl-7">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/setup" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">
                            ชื่อ-นามสกุล <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full bg-gray-900/60 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none transition-all"
                            placeholder="เช่น สมชาย ใจดี">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">
                            อีเมล <span class="text-red-400">*</span>
                            <span class="text-gray-500 text-xs">(ใช้เข้าสู่ระบบ)</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', 'admin@xman4289.com') }}" required
                            class="w-full bg-gray-900/60 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none transition-all"
                            placeholder="admin@xman4289.com">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-1.5">
                            เบอร์โทรศัพท์
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full bg-gray-900/60 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none transition-all"
                            placeholder="08x-xxx-xxxx">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">
                            รหัสผ่าน <span class="text-red-400">*</span>
                            <span class="text-gray-500 text-xs">(อย่างน้อย 8 ตัวอักษร)</span>
                        </label>
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full bg-gray-900/60 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1.5">
                            ยืนยันรหัสผ่าน <span class="text-red-400">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full bg-gray-900/60 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3.5 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-indigo-600/30 mt-2">
                        สร้างบัญชี Super Admin
                    </button>
                </form>

                {{-- Info --}}
                <div class="mt-6 bg-indigo-900/30 border border-indigo-800/50 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-indigo-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-sm text-indigo-300">
                            <p class="font-medium mb-1">Super Admin คืออะไร?</p>
                            <p class="text-indigo-400/80">คือผู้ดูแลระบบสูงสุด สามารถจัดการกองทุนทุกแห่ง ดูข้อมูลภาพรวมทั้งระบบ และจัดการผู้ใช้ทุกคนได้ หน้านี้จะแสดงเฉพาะครั้งแรกเท่านั้น</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <p class="text-center text-gray-500 text-xs mt-6">
                &copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน v{{ trim(file_get_contents(base_path('VERSION'))) }}
            </p>
        </div>
    </div>
</body>
</html>
