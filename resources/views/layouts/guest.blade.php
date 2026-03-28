<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'เข้าสู่ระบบ' }} - KTB Account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-950 flex items-center justify-center p-4">

    {{-- Background pattern --}}
    <div class="fixed inset-0 bg-gradient-primary opacity-50"></div>
    <div class="fixed inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.15) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-600/20 border border-primary-500/30 mb-4">
                <svg class="w-8 h-8 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">XMAN Studio</h1>
            <p class="text-sm text-primary-300 mt-1">ระบบบริหารกองทุนหมู่บ้าน</p>
        </div>

        {{-- Card --}}
        <div class="gradient-border">
            <div class="bg-gray-900/90 backdrop-blur-xl rounded-2xl p-6 sm:p-8 relative z-10">
                @yield('content')
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-gray-500 mt-6">&copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน</p>
    </div>

    @stack('scripts')
</body>
</html>
