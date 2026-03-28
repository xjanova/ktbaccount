<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โหมดทดลอง - กองทุนหมู่บ้านบ้านสวนสวรรค์ | KTB Account</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|noto-sans-thai:300,400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Noto Sans Thai', sans-serif;
            background: #0a0a0f;
            color: #e5e7eb;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Background ambient glow */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 30% 20%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 70% 60%, rgba(139, 92, 246, 0.06) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 80%, rgba(168, 85, 247, 0.04) 0%, transparent 40%);
            z-index: 0;
            pointer-events: none;
        }

        /* Demo banner */
        .demo-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: linear-gradient(135deg, #f59e0b, #d97706, #b45309);
            color: #1c1917;
            padding: 10px 16px;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.3);
        }

        .demo-banner-pulse {
            display: inline-block;
            animation: pulse-glow 2s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Layout */
        .page-wrapper {
            position: relative;
            z-index: 1;
            padding-top: 44px; /* banner height */
        }

        .nav-bar {
            background: rgba(10, 10, 15, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            position: sticky;
            top: 44px;
            z-index: 40;
        }

        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }

        .nav-links { display: flex; align-items: center; gap: 4px; }

        .nav-link {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link:hover { color: #e5e7eb; background: rgba(255, 255, 255, 0.06); }
        .nav-link.active {
            color: #c7d2fe;
            background: rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .nav-right { display: flex; align-items: center; gap: 12px; }

        .nav-back {
            font-size: 0.8125rem;
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-back:hover { color: #e5e7eb; }

        .btn-login {
            padding: 7px 18px;
            border-radius: 10px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid rgba(99, 102, 241, 0.4);
            color: #a5b4fc;
            transition: all 0.2s;
        }
        .btn-login:hover {
            background: rgba(99, 102, 241, 0.15);
            border-color: rgba(99, 102, 241, 0.6);
        }

        .btn-register {
            padding: 7px 18px;
            border-radius: 10px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-decoration: none;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3);
            transition: all 0.2s;
        }
        .btn-register:hover {
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
            transform: translateY(-1px);
        }

        /* Main content */
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 24px 80px;
        }

        /* Glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
        }

        /* Stat cards */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .stat-grid { grid-template-columns: 1fr; } }

        .stat-card {
            padding: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        .stat-header { display: flex; align-items: flex-start; justify-content: space-between; }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #9ca3af;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-top: 8px;
            font-variant-numeric: tabular-nums;
        }

        .stat-value .unit {
            font-size: 0.875rem;
            font-weight: 400;
            color: #9ca3af;
        }

        .stat-sub {
            font-size: 0.75rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg { width: 24px; height: 24px; color: #fff; }

        .icon-indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3); }
        .icon-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); box-shadow: 0 8px 16px rgba(139, 92, 246, 0.3); }
        .icon-amber { background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3); }
        .icon-emerald { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3); }

        .text-emerald { color: #34d399; }
        .text-red { color: #f87171; }

        /* Charts */
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1024px) { .chart-grid { grid-template-columns: 1fr; } }

        .chart-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .chart-title { font-size: 0.9375rem; font-weight: 600; color: #fff; }
        .chart-sub { font-size: 0.75rem; color: #6b7280; margin-top: 4px; }
        .chart-body { padding: 24px; }
        .chart-canvas { height: 260px; position: relative; }

        /* Tables */
        .section-card { margin-bottom: 32px; }

        .section-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-title { font-size: 0.9375rem; font-weight: 600; color: #fff; }
        .section-sub { font-size: 0.75rem; color: #6b7280; margin-top: 4px; }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            padding: 12px 24px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .data-table td {
            padding: 14px 24px;
            font-size: 0.875rem;
            color: #d1d5db;
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            transition: background 0.15s;
        }

        .data-table tbody tr:hover { background: rgba(255, 255, 255, 0.04); }
        .data-table tbody tr:nth-child(even) { background: rgba(255, 255, 255, 0.015); }
        .data-table tbody tr:nth-child(even):hover { background: rgba(255, 255, 255, 0.04); }

        .data-table .text-right { text-align: right; }

        .data-table .row-overdue {
            background: rgba(239, 68, 68, 0.06) !important;
            border-left: 3px solid #ef4444;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .badge-green { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); }
        .badge-red { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); }
        .badge-amber { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.2); }
        .badge-blue { background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-purple { background: rgba(139, 92, 246, 0.15); color: #a78bfa; border: 1px solid rgba(139, 92, 246, 0.2); }
        .badge-gray { background: rgba(107, 114, 128, 0.15); color: #9ca3af; border: 1px solid rgba(107, 114, 128, 0.2); }

        .badge-demo {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.25);
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 3px 8px;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Fund header */
        .fund-header { margin-bottom: 32px; }
        .fund-name { font-size: 1.75rem; font-weight: 800; color: #fff; }
        .fund-info { display: flex; flex-wrap: wrap; gap: 16px; margin-top: 10px; }
        .fund-info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8125rem;
            color: #9ca3af;
        }
        .fund-info-item svg { width: 16px; height: 16px; opacity: 0.6; }

        /* Money formatting */
        .money { font-variant-numeric: tabular-nums; font-family: 'Inter', monospace; }
        .money-green { color: #34d399; }
        .money-red { color: #f87171; }

        /* CTA section */
        .cta-section {
            text-align: center;
            padding: 48px 24px;
            margin-top: 16px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.08));
            border: 1px solid rgba(99, 102, 241, 0.15);
        }

        .cta-title { font-size: 1.5rem; font-weight: 700; color: #fff; }
        .cta-sub { font-size: 0.9375rem; color: #9ca3af; margin-top: 8px; max-width: 500px; margin-left: auto; margin-right: auto; }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            padding: 14px 32px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.35);
            transition: all 0.3s;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(99, 102, 241, 0.5);
        }

        .cta-btn svg { width: 20px; height: 20px; }

        /* Overdue alert */
        .alert-overdue {
            border-left: 4px solid #ef4444;
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 32px;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(239, 68, 68, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .alert-icon svg { width: 20px; height: 20px; color: #f87171; }

        .alert-title { font-size: 0.875rem; font-weight: 600; color: #fca5a5; }
        .alert-text { font-size: 0.8125rem; color: #9ca3af; margin-top: 4px; }

        /* Responsive table wrapper */
        .table-wrap { overflow-x: auto; }

        /* Footer */
        .demo-footer {
            text-align: center;
            padding: 24px;
            font-size: 0.75rem;
            color: #4b5563;
            border-top: 1px solid rgba(255, 255, 255, 0.04);
            margin-top: 40px;
        }

        .demo-footer a { color: #6366f1; text-decoration: none; }
        .demo-footer a:hover { color: #818cf8; }

        /* Mobile nav */
        @media (max-width: 768px) {
            .nav-inner { flex-wrap: wrap; height: auto; padding: 12px 16px; gap: 8px; }
            .nav-links { width: 100%; order: 2; overflow-x: auto; padding-bottom: 4px; }
            .nav-right { order: 1; margin-left: auto; }
            .fund-name { font-size: 1.375rem; }
            .main-content { padding: 20px 16px 60px; }
            .stat-value { font-size: 1.25rem; }
            .hide-mobile { display: none; }
        }
    </style>
</head>
<body>

{{-- Demo Banner --}}
<div class="demo-banner">
    <span class="demo-banner-pulse">&#x1F9EA;</span>
    โหมดทดลองใช้งาน - กองทุนหมู่บ้านบ้านสวนสวรรค์ (ข้อมูลตัวอย่าง)
</div>

{{-- Navigation --}}
<div class="page-wrapper">
    <nav class="nav-bar">
        <div class="nav-inner">
            <div class="nav-links">
                <a href="{{ url('/demo/dashboard') }}" class="nav-link active">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    แดชบอร์ด
                </a>
                <a href="{{ url('/demo/members') }}" class="nav-link">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    สมาชิก
                </a>
                <a href="{{ url('/demo/loans') }}" class="nav-link">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    สินเชื่อ
                </a>
                <a href="{{ url('/demo/reports') }}" class="nav-link">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                    รายงาน
                </a>
            </div>
            <div class="nav-right">
                <a href="{{ url('/') }}" class="nav-back hide-mobile">&larr; กลับหน้าหลัก</a>
                <a href="{{ route('login') }}" class="btn-login">เข้าสู่ระบบ</a>
                <a href="{{ route('register') }}" class="btn-register hide-mobile">ลงทะเบียนกองทุนใหม่</a>
            </div>
        </div>
    </nav>

    <main class="main-content">

        {{-- Fund Header --}}
        <div class="fund-header">
            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
                <h1 class="fund-name gradient-text">{{ $fund['name'] }}</h1>
                <span class="badge badge-demo">&#x1F9EA; โหมดทดลอง</span>
            </div>
            <div class="fund-info">
                <div class="fund-info-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 0 1 15 0Z" /></svg>
                    {{ $fund['province'] }}
                </div>
                <div class="fund-info-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>
                    รหัส: {{ $fund['code'] }}
                </div>
                <div class="fund-info-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    ปีบัญชี {{ date('Y') + 543 }}
                </div>
                <div class="fund-info-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    {{ $fund['total_members'] }} สมาชิก
                </div>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="stat-grid">
            {{-- Cash --}}
            <div class="glass-card stat-card">
                <div class="stat-header">
                    <div>
                        <p class="stat-label">เงินสด</p>
                        <p class="stat-value money">&#3647;{{ number_format($fund['total_cash'], 2) }}</p>
                        <p class="stat-sub text-emerald">
                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                            +5.2% จากเดือนก่อน
                        </p>
                    </div>
                    <div class="stat-icon icon-indigo">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Bank --}}
            <div class="glass-card stat-card">
                <div class="stat-header">
                    <div>
                        <p class="stat-label">เงินฝากธนาคาร</p>
                        <p class="stat-value money">&#3647;{{ number_format($fund['total_bank'], 2) }}</p>
                        <p class="stat-sub text-emerald">
                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                            +2.1% จากเดือนก่อน
                        </p>
                    </div>
                    <div class="stat-icon icon-purple">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Loans Outstanding --}}
            <div class="glass-card stat-card">
                <div class="stat-header">
                    <div>
                        <p class="stat-label">สินเชื่อค้างชำระ</p>
                        <p class="stat-value money">&#3647;{{ number_format($fund['total_loans_outstanding'], 2) }}</p>
                        <p class="stat-sub text-red">
                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                            {{ $fund['active_loans'] }} สัญญา
                        </p>
                    </div>
                    <div class="stat-icon icon-amber">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Members --}}
            <div class="glass-card stat-card">
                <div class="stat-header">
                    <div>
                        <p class="stat-label">จำนวนสมาชิก</p>
                        <p class="stat-value">{{ number_format($fund['total_members']) }} <span class="unit">คน</span></p>
                        <p class="stat-sub text-emerald">
                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                            +3 คนจากเดือนก่อน
                        </p>
                    </div>
                    <div class="stat-icon icon-emerald">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Overdue Alert --}}
        @if ($fund['overdue_loans'] > 0)
        <div class="glass-card alert-overdue">
            <div class="alert-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
            </div>
            <div>
                <p class="alert-title">สินเชื่อค้างชำระเกินกำหนด</p>
                <p class="alert-text">มี {{ $fund['overdue_loans'] }} สัญญาที่เลยกำหนดชำระ กรุณาติดตามการชำระเงินโดยเร็ว</p>
            </div>
        </div>
        @endif

        {{-- Charts --}}
        <div class="chart-grid">
            {{-- Income/Expense Bar Chart --}}
            <div class="glass-card">
                <div class="chart-header">
                    <p class="chart-title">รายรับ-รายจ่ายรายเดือน</p>
                    <p class="chart-sub">ข้อมูลย้อนหลัง 6 เดือน (ข้อมูลตัวอย่าง)</p>
                </div>
                <div class="chart-body">
                    <div class="chart-canvas">
                        <canvas id="incomeExpenseChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Loan Distribution Doughnut --}}
            <div class="glass-card">
                <div class="chart-header">
                    <p class="chart-title">สัดส่วนสินเชื่อ</p>
                    <p class="chart-sub">แยกตามประเภทสินเชื่อ</p>
                </div>
                <div class="chart-body">
                    <div class="chart-canvas">
                        <canvas id="loanDistChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Transactions --}}
        <div class="glass-card section-card">
            <div class="section-header">
                <div>
                    <p class="section-title">รายการล่าสุด</p>
                    <p class="section-sub">{{ count($transactions) }} รายการล่าสุด</p>
                </div>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>วันที่</th>
                            <th>ประเภท</th>
                            <th>รายการ</th>
                            <th class="text-right">จำนวนเงิน</th>
                            <th>สมาชิก</th>
                            <th>ช่องทาง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $tx)
                        <tr>
                            <td>{{ $tx['date'] }}</td>
                            <td>
                                @if ($tx['type'] === 'income')
                                    <span class="badge badge-green">รายรับ</span>
                                @else
                                    <span class="badge badge-red">รายจ่าย</span>
                                @endif
                            </td>
                            <td>{{ $tx['category'] }}</td>
                            <td class="text-right money {{ $tx['type'] === 'income' ? 'money-green' : 'money-red' }}">
                                {{ $tx['type'] === 'income' ? '+' : '-' }}{{ number_format($tx['amount'], 2) }}
                            </td>
                            <td>{{ $tx['member'] }}</td>
                            <td><span class="badge badge-gray">{{ $tx['method'] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Active Loans --}}
        <div class="glass-card section-card">
            <div class="section-header">
                <div>
                    <p class="section-title">สินเชื่อที่อยู่ระหว่างผ่อนชำระ</p>
                    <p class="section-sub">{{ $fund['active_loans'] }} สัญญา &middot; ค้างชำระรวม &#3647;{{ number_format($fund['total_loans_outstanding'], 2) }}</p>
                </div>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>สัญญา</th>
                            <th>สมาชิก</th>
                            <th class="text-right">ยอดกู้</th>
                            <th class="text-right">คงเหลือ</th>
                            <th>สถานะ</th>
                            <th>งวดถัดไป</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                        <tr class="{{ $loan['overdue'] ? 'row-overdue' : '' }}">
                            <td style="font-weight:600;color:#c7d2fe">{{ $loan['code'] }}</td>
                            <td>{{ $loan['member'] }}</td>
                            <td class="text-right money">{{ number_format($loan['principal'], 2) }}</td>
                            <td class="text-right money">{{ number_format($loan['outstanding'], 2) }}</td>
                            <td>
                                @if ($loan['status'] === 'active')
                                    <span class="badge badge-blue">ปกติ</span>
                                @elseif ($loan['status'] === 'overdue')
                                    <span class="badge badge-red">ค้างชำระ</span>
                                @elseif ($loan['status'] === 'paid')
                                    <span class="badge badge-green">ชำระครบ</span>
                                @else
                                    <span class="badge badge-gray">{{ $loan['status'] }}</span>
                                @endif
                            </td>
                            <td>{{ $loan['next_due'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Savings Summary --}}
        <div class="glass-card section-card">
            <div class="section-header">
                <div>
                    <p class="section-title">สรุปเงินออม</p>
                    <p class="section-sub">ยอดรวม &#3647;{{ number_format($fund['total_savings'], 2) }} &middot; หุ้นรวม &#3647;{{ number_format($fund['total_shares'], 2) }}</p>
                </div>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>บัญชี</th>
                            <th>สมาชิก</th>
                            <th class="text-right">ยอดคงเหลือ</th>
                            <th class="text-right">อัตราดอกเบี้ย</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($savings as $sav)
                        <tr>
                            <td style="font-weight:600;color:#c7d2fe">{{ $sav['account'] }}</td>
                            <td>{{ $sav['member'] }}</td>
                            <td class="text-right money">&#3647;{{ number_format($sav['balance'], 2) }}</td>
                            <td class="text-right">{{ $sav['rate'] }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CTA --}}
        <div class="cta-section">
            <p class="cta-title">พร้อมใช้งานจริง?</p>
            <p class="cta-sub">ลงทะเบียนกองทุนของคุณวันนี้ ใช้งานฟรีไม่มีค่าใช้จ่าย บริหารจัดการกองทุนหมู่บ้านได้ง่ายและมืออาชีพ</p>
            <a href="{{ route('register') }}" class="cta-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                ลงทะเบียนกองทุนใหม่
            </a>
        </div>

    </main>

    {{-- Footer --}}
    <footer class="demo-footer">
        &copy; {{ date('Y') }} <a href="https://xman4289.com" target="_blank" rel="noopener">XMAN Studio</a> &mdash; ระบบบริหารกองทุนหมู่บ้าน KTB Account
    </footer>
</div>

{{-- Chart.js Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartFont = { family: "'Inter', 'Noto Sans Thai', sans-serif" };
    const gridColor = 'rgba(255, 255, 255, 0.05)';
    const tickColor = '#6b7280';

    // Income/Expense bar chart
    @php
        $incomeData = array_slice($fund['monthly_income'], 0, 6);
        $expenseData = array_slice($fund['monthly_expense'], 0, 6);
    @endphp

    const ieCtx = document.getElementById('incomeExpenseChart');
    if (ieCtx) {
        new Chart(ieCtx, {
            type: 'bar',
            data: {
                labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.'],
                datasets: [
                    {
                        label: 'รายรับ',
                        data: @json($incomeData),
                        backgroundColor: 'rgba(99, 102, 241, 0.7)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: 'รายจ่าย',
                        data: @json($expenseData),
                        backgroundColor: 'rgba(239, 68, 68, 0.5)',
                        borderColor: 'rgba(239, 68, 68, 0.8)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#9ca3af',
                            font: chartFont,
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'roundRect'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                return ctx.dataset.label + ': \u0E3F' + ctx.parsed.y.toLocaleString('th-TH');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: tickColor, font: chartFont },
                        grid: { color: gridColor }
                    },
                    y: {
                        ticks: {
                            color: tickColor,
                            font: chartFont,
                            callback: function(v) { return '\u0E3F' + (v / 1000) + 'k'; }
                        },
                        grid: { color: gridColor }
                    }
                }
            }
        });
    }

    // Loan distribution doughnut
    const ldCtx = document.getElementById('loanDistChart');
    if (ldCtx) {
        @php
            $loanStatuses = [];
            $statusCounts = [];
            foreach ($loans as $loan) {
                $s = $loan['status'];
                if (!isset($statusCounts[$s])) { $statusCounts[$s] = 0; }
                $statusCounts[$s]++;
            }
            $loanLabels = [];
            $loanValues = [];
            $statusMap = ['active' => 'ปกติ', 'overdue' => 'ค้างชำระ', 'paid' => 'ชำระครบ'];
            foreach ($statusCounts as $k => $v) {
                $loanLabels[] = $statusMap[$k] ?? $k;
                $loanValues[] = $v;
            }
        @endphp

        new Chart(ldCtx, {
            type: 'doughnut',
            data: {
                labels: @json($loanLabels),
                datasets: [{
                    data: @json($loanValues),
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(245, 158, 11, 0.7)'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#9ca3af',
                            font: chartFont,
                            padding: 16,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = Math.round((ctx.parsed / total) * 100);
                                return ctx.label + ': ' + ctx.parsed + ' สัญญา (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>

</body>
</html>
