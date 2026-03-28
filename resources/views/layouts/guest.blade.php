<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'เข้าสู่ระบบ' }} - KTB Account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #0a1128; }
        .auth-bg { background: linear-gradient(135deg, #0a1128 0%, #0f1d3a 40%, #1a2744 70%, #1e3a8a 100%); }
        .auth-orb-1 { position:fixed;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(37,99,235,0.2),transparent 70%);top:-100px;left:-100px;filter:blur(60px);animation:ao1 20s ease-in-out infinite; }
        .auth-orb-2 { position:fixed;width:350px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(220,38,38,0.15),transparent 70%);bottom:-50px;right:-50px;filter:blur(60px);animation:ao2 25s ease-in-out infinite; }
        @keyframes ao1 { 0%,100% { transform:translate(0,0); } 50% { transform:translate(60px,40px); } }
        @keyframes ao2 { 0%,100% { transform:translate(0,0); } 50% { transform:translate(-40px,-30px); } }
        .auth-card { background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);border-radius:20px; }
    </style>
</head>
<body class="min-h-screen auth-bg flex items-center justify-center p-4">

    <div class="auth-orb-1"></div>
    <div class="auth-orb-2"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-lg">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <img src="/images/logo-md.webp" alt="KTB Account" class="w-20 h-20 mx-auto mb-4" style="filter:drop-shadow(0 8px 20px rgba(212,168,67,0.3));">
            <h1 class="text-2xl font-bold text-white">ระบบบริหารกองทุนหมู่บ้าน</h1>
            <p class="text-sm text-blue-300 mt-1">Village Fund Management System</p>
        </div>

        {{-- Card --}}
        <div class="auth-card p-6 sm:p-8 overflow-hidden">
            @yield('content')
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-gray-500 mt-6">&copy; {{ date('Y') }} XMAN Studio - v{{ $appVersion ?? '1.0.0' }}</p>
    </div>

    @stack('scripts')
</body>
</html>
