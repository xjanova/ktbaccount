<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินเชื่อ - โหมดทดลอง | KTB Account</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|noto-sans-thai:300,400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', 'Noto Sans Thai', sans-serif; background: #0a0a0f; color: #e5e7eb; margin: 0; padding: 0; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(ellipse at 30% 20%, rgba(99, 102, 241, 0.08) 0%, transparent 50%), radial-gradient(ellipse at 70% 60%, rgba(139, 92, 246, 0.06) 0%, transparent 50%); z-index: 0; pointer-events: none; }
        .demo-banner { position: fixed; top: 0; left: 0; right: 0; z-index: 50; background: linear-gradient(135deg, #f59e0b, #d97706, #b45309); color: #1c1917; padding: 10px 16px; text-align: center; font-weight: 600; font-size: 0.875rem; box-shadow: 0 4px 20px rgba(245, 158, 11, 0.3); }
        .demo-banner-pulse { display: inline-block; animation: pulse-glow 2s ease-in-out infinite; }
        @keyframes pulse-glow { 0%, 100% { opacity: 1; } 50% { opacity: 0.7; } }
        .page-wrapper { position: relative; z-index: 1; padding-top: 44px; }
        .nav-bar { background: rgba(10, 10, 15, 0.85); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255, 255, 255, 0.06); position: sticky; top: 44px; z-index: 40; }
        .nav-inner { max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; height: 60px; }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link { padding: 8px 16px; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: #9ca3af; text-decoration: none; transition: all 0.2s; }
        .nav-link:hover { color: #e5e7eb; background: rgba(255, 255, 255, 0.06); }
        .nav-link.active { color: #c7d2fe; background: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.2); }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-back { font-size: 0.8125rem; color: #9ca3af; text-decoration: none; transition: color 0.2s; }
        .nav-back:hover { color: #e5e7eb; }
        .btn-login { padding: 7px 18px; border-radius: 10px; font-size: 0.8125rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(99, 102, 241, 0.4); color: #a5b4fc; transition: all 0.2s; }
        .btn-login:hover { background: rgba(99, 102, 241, 0.15); border-color: rgba(99, 102, 241, 0.6); }
        .btn-register { padding: 7px 18px; border-radius: 10px; font-size: 0.8125rem; font-weight: 600; text-decoration: none; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3); transition: all 0.2s; }
        .btn-register:hover { box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45); transform: translateY(-1px); }
        .main-content { max-width: 1280px; margin: 0 auto; padding: 32px 24px 80px; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(24px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; }
        .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 32px; }
        @media (max-width: 768px) { .stat-grid { grid-template-columns: 1fr; } }
        .stat-card { padding: 24px; transition: all 0.3s; }
        .stat-card:hover { border-color: rgba(255, 255, 255, 0.15); transform: translateY(-2px); }
        .stat-label { font-size: 0.875rem; font-weight: 500; color: #9ca3af; }
        .stat-value { font-size: 1.5rem; font-weight: 700; color: #fff; margin-top: 8px; }
        .stat-value .unit { font-size: 0.875rem; font-weight: 400; color: #9ca3af; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 24px; height: 24px; color: #fff; }
        .icon-indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3); }
        .icon-amber { background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3); }
        .icon-red { background: linear-gradient(135deg, #ef4444, #dc2626); box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3); }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { text-align: left; padding: 12px 16px; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255, 255, 255, 0.06); }
        .data-table td { padding: 14px 16px; font-size: 0.875rem; border-bottom: 1px solid rgba(255, 255, 255, 0.04); }
        .data-table tr:hover td { background: rgba(255, 255, 255, 0.02); }
        .data-table tr.overdue td { background: rgba(239, 68, 68, 0.06); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .badge-active { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.25); }
        .badge-completed { background: rgba(107, 114, 128, 0.15); color: #9ca3af; border: 1px solid rgba(107, 114, 128, 0.25); }
        .badge-overdue { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.25); }
        .demo-footer { text-align: center; padding: 32px; font-size: 0.8125rem; color: #6b7280; }
        .demo-footer a { color: #6366f1; text-decoration: none; }
        .demo-footer a:hover { color: #818cf8; }
        @media (max-width: 640px) { .hide-mobile { display: none; } .data-table { font-size: 0.8rem; } .data-table th, .data-table td { padding: 10px 8px; } }
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
                <a href="{{ url('/demo/dashboard') }}" class="nav-link">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                    แดชบอร์ด
                </a>
                <a href="{{ url('/demo/members') }}" class="nav-link">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    สมาชิก
                </a>
                <a href="{{ url('/demo/loans') }}" class="nav-link active">
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

    <div class="main-content">
        {{-- Page title --}}
        <div style="margin-bottom: 28px;">
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin: 0 0 4px 0;">สินเชื่อ</h1>
            <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">{{ $fund['name'] }} - รายการสัญญาสินเชื่อทั้งหมด</p>
        </div>

        {{-- Summary stats --}}
        @php
            $activeLoans = collect($loans)->where('status', 'active');
            $totalOutstanding = $activeLoans->sum('outstanding');
            $overdueCount = collect($loans)->where('overdue', true)->count();
        @endphp
        <div class="stat-grid">
            <div class="glass-card stat-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stat-label">สัญญาทั้งหมด</div>
                        <div class="stat-value">{{ count($loans) }} <span class="unit">สัญญา</span></div>
                    </div>
                    <div class="stat-icon icon-indigo">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    </div>
                </div>
            </div>
            <div class="glass-card stat-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stat-label">ยอดคงค้างรวม</div>
                        <div class="stat-value">{{ number_format($totalOutstanding) }} <span class="unit">บาท</span></div>
                    </div>
                    <div class="stat-icon icon-amber">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
            </div>
            <div class="glass-card stat-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stat-label">ค้างชำระ</div>
                        <div class="stat-value" style="color: {{ $overdueCount > 0 ? '#f87171' : '#34d399' }}">{{ $overdueCount }} <span class="unit">สัญญา</span></div>
                    </div>
                    <div class="stat-icon icon-red">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Loans table --}}
        <div class="glass-card" style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>สัญญา</th>
                        <th>สมาชิก</th>
                        <th class="hide-mobile" style="text-align:right">ยอดกู้</th>
                        <th class="hide-mobile" style="text-align:center">ดอกเบี้ย</th>
                        <th class="hide-mobile" style="text-align:center">งวด</th>
                        <th style="text-align:right">คงเหลือ</th>
                        <th style="text-align:center">สถานะ</th>
                        <th class="hide-mobile">งวดถัดไป</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                    <tr class="{{ $loan['overdue'] ? 'overdue' : '' }}">
                        <td style="font-weight: 600; color: #c7d2fe;">{{ $loan['code'] }}</td>
                        <td>{{ $loan['member'] }}</td>
                        <td class="hide-mobile" style="text-align:right; font-variant-numeric: tabular-nums;">{{ number_format($loan['principal']) }}</td>
                        <td class="hide-mobile" style="text-align:center">{{ $loan['rate'] }}%</td>
                        <td class="hide-mobile" style="text-align:center">{{ $loan['term'] }}</td>
                        <td style="text-align:right; font-weight: 600; font-variant-numeric: tabular-nums; color: {{ $loan['outstanding'] > 0 ? '#fbbf24' : '#34d399' }}">{{ number_format($loan['outstanding']) }}</td>
                        <td style="text-align:center">
                            @if($loan['overdue'])
                                <span class="badge badge-overdue">ค้างชำระ</span>
                            @elseif($loan['status'] === 'completed')
                                <span class="badge badge-completed">ปิดแล้ว</span>
                            @else
                                <span class="badge badge-active">ปกติ</span>
                            @endif
                        </td>
                        <td class="hide-mobile" style="color: {{ $loan['overdue'] ? '#f87171' : '#9ca3af' }}">{{ $loan['next_due'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <footer class="demo-footer">
        &copy; {{ date('Y') }} <a href="https://xman4289.com" target="_blank" rel="noopener">XMAN Studio</a> &mdash; ระบบบริหารกองทุนหมู่บ้าน KTB Account
    </footer>
</div>
</body>
</html>
