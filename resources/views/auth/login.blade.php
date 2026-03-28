<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>เข้าสู่ระบบ - ระบบบริหารกองทุนหมู่บ้าน</title>
    @vite(['resources/css/app.css'])
    <style>
        @keyframes float-orb-1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(120px, -80px) scale(1.1); }
            50% { transform: translate(-60px, -160px) scale(0.95); }
            75% { transform: translate(-120px, 60px) scale(1.05); }
        }
        @keyframes float-orb-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(-100px, 100px) scale(1.15); }
            50% { transform: translate(80px, 40px) scale(0.9); }
            75% { transform: translate(60px, -120px) scale(1.1); }
        }
        @keyframes float-orb-3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(80px, 120px) scale(1.08); }
            66% { transform: translate(-100px, -60px) scale(0.92); }
        }
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.3), 0 0 80px rgba(99, 102, 241, 0.1); }
            50% { box-shadow: 0 0 60px rgba(99, 102, 241, 0.5), 0 0 120px rgba(99, 102, 241, 0.2); }
        }
        .orb-1 {
            position: absolute;
            top: 10%;
            left: 15%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.35), rgba(99, 102, 241, 0) 70%);
            filter: blur(60px);
            mix-blend-mode: screen;
            animation: float-orb-1 20s ease-in-out infinite;
            pointer-events: none;
        }
        .orb-2 {
            position: absolute;
            bottom: 15%;
            right: 10%;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.3), rgba(139, 92, 246, 0) 70%);
            filter: blur(60px);
            mix-blend-mode: screen;
            animation: float-orb-2 25s ease-in-out infinite;
            pointer-events: none;
        }
        .orb-3 {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.25), rgba(168, 85, 247, 0) 70%);
            filter: blur(60px);
            mix-blend-mode: screen;
            animation: float-orb-3 18s ease-in-out infinite;
            pointer-events: none;
        }
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }
        .glass-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            color: #fff;
            font-size: 0.875rem;
            width: 100%;
            transition: all 0.3s ease;
            outline: none;
        }
        .glass-input::placeholder { color: rgba(156, 163, 175, 0.6); }
        .glass-input:focus {
            border-color: rgba(99, 102, 241, 0.6);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            background: rgba(255, 255, 255, 0.08);
        }
        .logo-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center overflow-hidden relative" style="background: linear-gradient(135deg, #030712 0%, #1e1b4b 50%, #312e81 100%); background-size: 200% 200%; animation: gradient-shift 15s ease infinite;">

    {{-- Animated orbs --}}
    <div class="orb-1"></div>
    <div class="orb-2"></div>
    <div class="orb-3"></div>

    {{-- Grid overlay --}}
    <div class="grid-overlay"></div>

    {{-- Main content --}}
    <div class="relative z-10 w-full max-w-md mx-4">

        {{-- Logo & branding --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 logo-glow mb-4">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3H21m-3.75 3H21" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-white/90 tracking-tight">ระบบบริหารกองทุนหมู่บ้าน</h1>
            <p class="text-sm text-gray-400 mt-1">Village Fund Management System</p>
        </div>

        {{-- Glass card --}}
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl shadow-black/20">

            <h2 class="text-lg font-semibold text-white text-center mb-6">เข้าสู่ระบบ</h2>

            {{-- Error display --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 backdrop-blur border border-red-500/20 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <ul class="text-sm text-red-300 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="flex items-center gap-2 text-sm font-medium text-gray-300 mb-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        อีเมล
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="example@email.com"
                            class="glass-input"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="flex items-center gap-2 text-sm font-medium text-gray-300 mb-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        รหัสผ่าน
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="กรอกรหัสผ่าน"
                            class="glass-input"
                        >
                    </div>
                </div>

                {{-- Remember me + Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="remember" class="peer sr-only">
                            <div class="w-5 h-5 rounded-md bg-white/5 border border-white/10 peer-checked:bg-indigo-600 peer-checked:border-indigo-500 transition-all flex items-center justify-center">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors">จดจำฉัน</span>
                    </label>
                    <span class="text-sm text-gray-500 cursor-not-allowed" title="เร็วๆ นี้">ลืมรหัสผ่าน?</span>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:translate-y-0"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    เข้าสู่ระบบ
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/10"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-4 text-gray-500 bg-white/5 backdrop-blur rounded-full">หรือ</span>
                </div>
            </div>

            {{-- LINE Login --}}
            <button
                type="button"
                class="w-full flex items-center justify-center gap-2.5 px-6 py-3.5 bg-[#06c755] hover:bg-[#05b84e] text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-[#06c755]/30 hover:-translate-y-0.5 active:translate-y-0"
            >
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314" />
                </svg>
                เข้าสู่ระบบด้วย LINE
            </button>

            {{-- Register link --}}
            <p class="text-center text-sm text-gray-400 mt-6">
                ยังไม่มีบัญชี?
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">ลงทะเบียนกองทุนใหม่</a>
            </p>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-gray-600 mt-8">
            &copy; {{ date('Y') }} XMAN Studio &middot; v1.0
        </p>
    </div>
</body>
</html>
