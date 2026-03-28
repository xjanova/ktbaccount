<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมาชิก - โหมดทดลอง | KTB Account</title>
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
        .summary-bar { display: flex; align-items: center; gap: 24px; padding: 20px 24px; margin-bottom: 24px; flex-wrap: wrap; }
        .summary-item { display: flex; align-items: center; gap: 8px; }
        .summary-dot { width: 10px; height: 10px; border-radius: 50%; }
        .summary-label { font-size: 0.875rem; color: #9ca3af; }
        .summary-value { font-size: 1rem; font-weight: 700; color: #fff; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { text-align: left; padding: 12px 16px; font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid rgba(255, 255, 255, 0.06); }
        .data-table td { padding: 14px 16px; font-size: 0.875rem; border-bottom: 1px solid rgba(255, 255, 255, 0.04); }
        .data-table tr:hover td { background: rgba(255, 255, 255, 0.02); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .badge-active { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.25); }
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
                <a href="{{ url('/demo/members') }}" class="nav-link active">
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

    <div class="main-content">
        {{-- Page title --}}
        <div style="margin-bottom: 28px;">
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin: 0 0 4px 0;">สมาชิก</h1>
            <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">{{ $fund['name'] }} - รายชื่อสมาชิกทั้งหมด</p>
        </div>

        {{-- Summary --}}
        <div class="glass-card summary-bar">
            <div class="summary-item">
                <div class="summary-dot" style="background: #6366f1;"></div>
                <span class="summary-label">สมาชิกทั้งหมด</span>
                <span class="summary-value">{{ count($members) }} คน</span>
            </div>
            <div class="summary-item">
                <div class="summary-dot" style="background: #34d399;"></div>
                <span class="summary-label">สมาชิกปกติ</span>
                <span class="summary-value">{{ collect($members)->where('status', 'active')->count() }} คน</span>
            </div>
        </div>

        {{-- Members table --}}
        <div class="glass-card" style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th class="hide-mobile">โทร</th>
                        <th class="hide-mobile">วันที่เข้าร่วม</th>
                        <th style="text-align:right">หุ้น</th>
                        <th class="hide-mobile" style="text-align:right">เงินฝาก</th>
                        <th class="hide-mobile" style="text-align:right">สินเชื่อ</th>
                        <th style="text-align:center">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td style="font-weight: 600; color: #c7d2fe;">{{ $member['code'] }}</td>
                        <td>{{ $member['name'] }}</td>
                        <td class="hide-mobile" style="color: #9ca3af;">{{ $member['phone'] }}</td>
                        <td class="hide-mobile" style="color: #9ca3af;">{{ $member['joined'] }}</td>
                        <td style="text-align:right; font-variant-numeric: tabular-nums;">{{ number_format($member['shares']) }}</td>
                        <td class="hide-mobile" style="text-align:right; font-variant-numeric: tabular-nums;">{{ number_format($member['savings']) }}</td>
                        <td class="hide-mobile" style="text-align:right; font-variant-numeric: tabular-nums; color: {{ $member['loan'] > 0 ? '#fbbf24' : '#34d399' }}">{{ number_format($member['loan']) }}</td>
                        <td style="text-align:center">
                            <span class="badge badge-active">ปกติ</span>
                        </td>
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
