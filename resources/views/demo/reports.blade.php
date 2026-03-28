<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน - โหมดทดลอง | KTB Account</title>
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
        .report-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        @media (max-width: 768px) { .report-grid { grid-template-columns: 1fr; } }
        .report-card { padding: 28px; transition: all 0.3s; }
        .report-card:hover { border-color: rgba(255, 255, 255, 0.15); transform: translateY(-2px); }
        .report-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
        .report-icon svg { width: 24px; height: 24px; color: #fff; }
        .icon-indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3); }
        .icon-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); box-shadow: 0 8px 16px rgba(139, 92, 246, 0.3); }
        .icon-emerald { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3); }
        .icon-amber { background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3); }
        .report-title { font-size: 1.125rem; font-weight: 700; color: #fff; margin: 0 0 8px; }
        .report-desc { font-size: 0.875rem; color: #9ca3af; margin: 0 0 20px; line-height: 1.5; }
        .btn-disabled { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 10px; font-size: 0.8125rem; font-weight: 600; background: rgba(255, 255, 255, 0.05); color: #6b7280; border: 1px solid rgba(255, 255, 255, 0.06); cursor: not-allowed; }
        .note-box { padding: 20px 24px; margin-top: 28px; border-left: 3px solid #6366f1; }
        .note-box p { margin: 0; font-size: 0.875rem; color: #9ca3af; line-height: 1.6; }
        .demo-footer { text-align: center; padding: 32px; font-size: 0.8125rem; color: #6b7280; }
        .demo-footer a { color: #6366f1; text-decoration: none; }
        .demo-footer a:hover { color: #818cf8; }
        @media (max-width: 640px) { .hide-mobile { display: none; } }
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
                <a href="{{ url('/demo/loans') }}" class="nav-link">
                    <svg style="width:16px;height:16px;display:inline;vertical-align:-2px;margin-right:4px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    สินเชื่อ
                </a>
                <a href="{{ url('/demo/reports') }}" class="nav-link active">
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
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #fff; margin: 0 0 4px 0;">รายงาน</h1>
            <p style="font-size: 0.875rem; color: #9ca3af; margin: 0;">{{ $fund['name'] }} - รายงานการเงินและบัญชี</p>
        </div>

        {{-- Report cards --}}
        <div class="report-grid">
            {{-- งบทดลอง --}}
            <div class="glass-card report-card">
                <div class="report-icon icon-indigo">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" /></svg>
                </div>
                <h3 class="report-title">งบทดลอง</h3>
                <p class="report-desc">แสดงยอดคงเหลือของบัญชีทั้งหมด ตรวจสอบความถูกต้องของการบันทึกบัญชีในแต่ละงวด</p>
                <span class="btn-disabled">
                    <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    ดูตัวอย่าง (เร็วๆ นี้)
                </span>
            </div>

            {{-- งบกำไรขาดทุน --}}
            <div class="glass-card report-card">
                <div class="report-icon icon-emerald">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
                </div>
                <h3 class="report-title">งบกำไรขาดทุน</h3>
                <p class="report-desc">สรุปรายได้และค่าใช้จ่ายของกองทุน แสดงผลกำไรหรือขาดทุนสุทธิในรอบบัญชี</p>
                <span class="btn-disabled">
                    <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    ดูตัวอย่าง (เร็วๆ นี้)
                </span>
            </div>

            {{-- งบดุล --}}
            <div class="glass-card report-card">
                <div class="report-icon icon-purple">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" /></svg>
                </div>
                <h3 class="report-title">งบดุล</h3>
                <p class="report-desc">แสดงฐานะการเงินของกองทุน ประกอบด้วยสินทรัพย์ หนี้สิน และทุน ณ วันสิ้นงวด</p>
                <span class="btn-disabled">
                    <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    ดูตัวอย่าง (เร็วๆ นี้)
                </span>
            </div>

            {{-- บัญชีแยกประเภท --}}
            <div class="glass-card report-card">
                <div class="report-icon icon-amber">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                </div>
                <h3 class="report-title">บัญชีแยกประเภท</h3>
                <p class="report-desc">รายละเอียดการเคลื่อนไหวของแต่ละบัญชี แสดงรายการเดบิต-เครดิตและยอดคงเหลือ</p>
                <span class="btn-disabled">
                    <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    ดูตัวอย่าง (เร็วๆ นี้)
                </span>
            </div>
        </div>

        {{-- Note --}}
        <div class="glass-card note-box">
            <p>หน้ารายงานจะแสดงข้อมูลจริงเมื่อลงทะเบียนกองทุน รายงานทั้งหมดสามารถส่งออกเป็น PDF และ Excel ได้</p>
        </div>
    </div>

    <footer class="demo-footer">
        &copy; {{ date('Y') }} <a href="https://xman4289.com" target="_blank" rel="noopener">XMAN Studio</a> &mdash; ระบบบริหารกองทุนหมู่บ้าน KTB Account
    </footer>
</div>
</body>
</html>
