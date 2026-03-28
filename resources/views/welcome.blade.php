<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบบริหารกองทุนหมู่บ้าน - KTB Account by XMAN Studio</title>
    <meta name="description" content="ระบบบริหารกองทุนหมู่บ้านออนไลน์ จัดการบัญชี สินเชื่อ เงินฝาก หุ้น รายงานการเงิน ฟรี โดย XMAN Studio">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Noto Sans Thai', 'Inter', system-ui, sans-serif; background: #0a1128; color: #e2e8f0; overflow-x: hidden; line-height: 1.7; }
        a { text-decoration: none; color: inherit; }

        /* ── Animated Background ── */
        .hero-bg { position: relative; min-height: 100vh; background: linear-gradient(160deg, #0a1128 0%, #0f1d3a 30%, #1a2744 60%, #1e3a8a 100%); }
        .hero-bg::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h60v60H0z' fill='none'/%3E%3Cpath d='M0 60V0h1v60zm60 0V0h1v60zM0 0h60v1H0zm0 60h60v1H0z' fill='%232563eb' fill-opacity='0.04'/%3E%3C/svg%3E"); pointer-events: none; }

        /* Floating Orbs */
        .orb { position: absolute; border-radius: 50%; pointer-events: none; }
        .orb-1 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(37,99,235,0.3), transparent 70%); top: -100px; left: -100px; animation: float1 20s ease-in-out infinite; filter: blur(60px); }
        .orb-2 { width: 400px; height: 400px; background: radial-gradient(circle, rgba(220,38,38,0.2), transparent 70%); top: 40%; right: -80px; animation: float2 25s ease-in-out infinite; filter: blur(60px); }
        .orb-3 { width: 350px; height: 350px; background: radial-gradient(circle, rgba(212,168,67,0.15), transparent 70%); bottom: 10%; left: 20%; animation: float3 18s ease-in-out infinite; filter: blur(60px); }
        @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(80px,60px) scale(1.1); } }
        @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-60px,40px) scale(0.9); } }
        @keyframes float3 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(40px,-50px); } }

        /* Gradient Text */
        .grad-text { background: linear-gradient(135deg, #dc2626 0%, #ffffff 40%, #ffffff 60%, #2563eb 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; animation: gradMove 4s ease-in-out infinite; }
        @keyframes gradMove { 0%,100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }

        /* Glass */
        .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; }
        .glass-strong { background: rgba(255,255,255,0.07); backdrop-filter: blur(30px); border: 1px solid rgba(255,255,255,0.12); border-radius: 24px; }

        /* Card Hover */
        .hover-card { transition: all 0.4s cubic-bezier(0.4,0,0.2,1); }
        .hover-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 30px 60px -15px rgba(37,99,235,0.3); border-color: rgba(255,255,255,0.2); }

        /* Glow Button */
        .glow-btn { transition: all 0.3s; position: relative; }
        .glow-btn:hover { box-shadow: 0 0 30px rgba(220,38,38,0.5), 0 0 60px rgba(220,38,38,0.2); transform: translateY(-2px); }
        .glow-btn-blue { transition: all 0.3s; position: relative; }
        .glow-btn-blue:hover { box-shadow: 0 0 30px rgba(37,99,235,0.5), 0 0 60px rgba(37,99,235,0.2); transform: translateY(-2px); }

        /* Pulse Glow */
        .pulse-glow { animation: pulseG 2s ease-in-out infinite; }
        @keyframes pulseG { 0%,100% { box-shadow: 0 0 5px rgba(212,168,67,0.3); } 50% { box-shadow: 0 0 25px rgba(212,168,67,0.6), 0 0 50px rgba(212,168,67,0.2); } }

        /* Float Animation */
        .float-anim { animation: floatUp 6s ease-in-out infinite; }
        @keyframes floatUp { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }

        /* Slide In */
        .slide-up { opacity: 0; transform: translateY(50px); transition: all 0.8s cubic-bezier(0.4,0,0.2,1); }
        .slide-up.visible { opacity: 1; transform: translateY(0); }

        /* Counter */
        .counter { font-variant-numeric: tabular-nums; }

        /* Nav */
        .nav-glass { background: rgba(10,17,40,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05); }

        /* Feature Icon Glow */
        .icon-glow { box-shadow: 0 0 20px var(--glow-color, rgba(37,99,235,0.3)); }

        /* Responsive */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        @media (max-width: 768px) {
            .hero-grid { grid-template-columns: 1fr !important; }
            .hero-right { display: none; }
            .features-grid { grid-template-columns: 1fr !important; }
            .steps-grid { grid-template-columns: 1fr !important; }
            .trust-grid { grid-template-columns: 1fr !important; }
            .footer-grid { grid-template-columns: 1fr !important; }
            .hero-logo { width: 90px !important; height: 90px !important; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav class="nav-glass" style="position:fixed;top:0;width:100%;z-index:100;">
    <div class="container" style="display:flex;align-items:center;justify-content:space-between;height:64px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <img src="/images/logo-sm.webp" alt="KTB Account" style="width:38px;height:38px;border-radius:10px;box-shadow:0 4px 15px rgba(212,168,67,0.3);">
            <span style="font-size:18px;font-weight:800;color:white;letter-spacing:-0.5px;">KTB Account</span>
        </div>
        <div style="display:flex;align-items:center;gap:24px;">
            <a href="/demo" style="color:#93c5fd;font-size:14px;font-weight:500;">&#x1F9EA; ทดลองใช้</a>
            <a href="#features" style="color:#9ca3af;font-size:14px;">คุณสมบัติ</a>
            <a href="/guide" style="color:#9ca3af;font-size:14px;">คู่มือ</a>
            <a href="/login" class="glow-btn-blue" style="padding:8px 24px;background:linear-gradient(135deg,#2563eb,#1e3a8a);color:white;font-size:14px;font-weight:600;border-radius:12px;">เข้าสู่ระบบ</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-bg">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="container" style="position:relative;z-index:10;padding-top:120px;padding-bottom:80px;">
        <div class="hero-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;">

            <!-- Left -->
            <div>
                <div style="margin-bottom:24px;">
                    <img src="/images/logo-md.webp" alt="KTB Account" class="hero-logo" style="width:120px;height:120px;filter:drop-shadow(0 10px 30px rgba(212,168,67,0.3));">
                </div>

                <div class="pulse-glow" style="display:inline-flex;align-items:center;gap:8px;padding:6px 18px;border-radius:50px;border:1px solid rgba(212,168,67,0.4);background:rgba(212,168,67,0.1);margin-bottom:32px;">
                    <span style="width:8px;height:8px;background:#34d399;border-radius:50%;animation:pulseG 1.5s infinite;"></span>
                    <span style="color:#d4a843;font-size:14px;font-weight:600;">ใช้งานฟรีตลอดชีพ ไม่มีค่าใช้จ่าย</span>
                </div>

                <h1 style="font-size:clamp(40px,6vw,72px);font-weight:900;line-height:1.1;margin-bottom:24px;">
                    <span style="color:white;">ระบบบริหาร</span><br>
                    <span class="grad-text">กองทุนหมู่บ้าน</span>
                </h1>

                <p style="font-size:18px;color:#94a3b8;margin-bottom:40px;max-width:500px;line-height:1.8;">
                    จัดการบัญชี สินเชื่อ เงินฝาก หุ้น รายงานการเงิน
                    <strong style="color:#93c5fd;">ครบจบในที่เดียว</strong>
                    ใช้งานง่าย ปลอดภัย พร้อมแจ้งเตือนผ่าน LINE
                </p>

                <div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:48px;">
                    <a href="/register" class="glow-btn" style="padding:16px 36px;background:linear-gradient(135deg,#dc2626,#b91c1c);color:white;font-size:17px;font-weight:700;border-radius:16px;display:inline-flex;align-items:center;gap:8px;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        เริ่มต้นใช้งาน
                    </a>
                    <a href="/demo" class="glass glow-btn-blue" style="padding:16px 36px;color:white;font-size:17px;font-weight:500;display:inline-flex;align-items:center;gap:8px;transition:all 0.3s;">
                        &#x1F9EA; ทดลองใช้งาน
                    </a>
                </div>

                <!-- Stats -->
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">
                    <div><div class="counter" style="font-size:28px;font-weight:800;color:white;">77K+</div><div style="font-size:12px;color:#64748b;">กองทุน</div></div>
                    <div><div class="counter" style="font-size:28px;font-weight:800;color:white;">10M+</div><div style="font-size:12px;color:#64748b;">สมาชิก</div></div>
                    <div><div class="counter" style="font-size:28px;font-weight:800;color:white;">&#x0E3F;50B+</div><div style="font-size:12px;color:#64748b;">บริหาร</div></div>
                    <div><div class="counter" style="font-size:28px;font-weight:800;color:white;">99.9%</div><div style="font-size:12px;color:#64748b;">ปลอดภัย</div></div>
                </div>
            </div>

            <!-- Right: SVG Illustration Dashboard -->
            <div class="hero-right float-anim">
                <div class="glass-strong" style="padding:28px;box-shadow:0 40px 80px -20px rgba(37,99,235,0.3);">

                    <!-- Mini Nav Bar -->
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,0.06);">
                        <div style="width:10px;height:10px;border-radius:50%;background:#ef4444;"></div>
                        <div style="width:10px;height:10px;border-radius:50%;background:#eab308;"></div>
                        <div style="width:10px;height:10px;border-radius:50%;background:#22c55e;"></div>
                        <div style="flex:1;height:24px;background:rgba(255,255,255,0.05);border-radius:6px;margin-left:8px;display:flex;align-items:center;padding:0 10px;">
                            <span style="font-size:10px;color:#64748b;">ktbaccount.xman4289.com</span>
                        </div>
                    </div>

                    <!-- Stat Cards -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;">
                        <div style="background:linear-gradient(135deg,rgba(37,99,235,0.15),rgba(37,99,235,0.05));border:1px solid rgba(37,99,235,0.2);border-radius:14px;padding:14px;">
                            <div style="font-size:10px;color:#93c5fd;margin-bottom:4px;">&#x1F4B0; เงินสด</div>
                            <div style="font-size:20px;font-weight:800;color:white;">&#x0E3F;125,430</div>
                            <div style="font-size:10px;color:#34d399;margin-top:2px;">&#x2191; 12.5%</div>
                        </div>
                        <div style="background:linear-gradient(135deg,rgba(212,168,67,0.15),rgba(212,168,67,0.05));border:1px solid rgba(212,168,67,0.2);border-radius:14px;padding:14px;">
                            <div style="font-size:10px;color:#d4a843;margin-bottom:4px;">&#x1F3E6; เงินฝาก</div>
                            <div style="font-size:20px;font-weight:800;color:white;">&#x0E3F;1.25M</div>
                            <div style="font-size:10px;color:#34d399;margin-top:2px;">&#x2191; 5.2%</div>
                        </div>
                        <div style="background:linear-gradient(135deg,rgba(220,38,38,0.15),rgba(220,38,38,0.05));border:1px solid rgba(220,38,38,0.2);border-radius:14px;padding:14px;">
                            <div style="font-size:10px;color:#fca5a5;margin-bottom:4px;">&#x1F4CB; สินเชื่อ</div>
                            <div style="font-size:20px;font-weight:800;color:white;">&#x0E3F;890K</div>
                            <div style="font-size:10px;color:#fbbf24;margin-top:2px;">15 สัญญา</div>
                        </div>
                        <div style="background:linear-gradient(135deg,rgba(16,185,129,0.15),rgba(16,185,129,0.05));border:1px solid rgba(16,185,129,0.2);border-radius:14px;padding:14px;">
                            <div style="font-size:10px;color:#6ee7b7;margin-bottom:4px;">&#x1F465; สมาชิก</div>
                            <div style="font-size:20px;font-weight:800;color:white;">127</div>
                            <div style="font-size:10px;color:#34d399;margin-top:2px;">+3 เดือนนี้</div>
                        </div>
                    </div>

                    <!-- SVG Chart -->
                    <div style="background:rgba(255,255,255,0.03);border-radius:14px;padding:16px;">
                        <div style="font-size:11px;color:#64748b;margin-bottom:12px;">&#x1F4CA; รายรับ-รายจ่ายรายเดือน</div>
                        <svg viewBox="0 0 400 120" style="width:100%;height:auto;">
                            <!-- Grid lines -->
                            <line x1="0" y1="30" x2="400" y2="30" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                            <line x1="0" y1="60" x2="400" y2="60" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                            <line x1="0" y1="90" x2="400" y2="90" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                            <!-- Income bars (blue gradient) -->
                            <rect x="10" y="55" width="22" height="55" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="55" dur="1s" fill="freeze"/><animate attributeName="y" from="110" to="55" dur="1s" fill="freeze"/></rect>
                            <rect x="44" y="30" width="22" height="80" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="80" dur="1.2s" fill="freeze"/><animate attributeName="y" from="110" to="30" dur="1.2s" fill="freeze"/></rect>
                            <rect x="78" y="45" width="22" height="65" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="65" dur="1.1s" fill="freeze"/><animate attributeName="y" from="110" to="45" dur="1.1s" fill="freeze"/></rect>
                            <rect x="112" y="20" width="22" height="90" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="90" dur="1.3s" fill="freeze"/><animate attributeName="y" from="110" to="20" dur="1.3s" fill="freeze"/></rect>
                            <rect x="146" y="35" width="22" height="75" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="75" dur="1.15s" fill="freeze"/><animate attributeName="y" from="110" to="35" dur="1.15s" fill="freeze"/></rect>
                            <rect x="180" y="15" width="22" height="95" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="95" dur="1.35s" fill="freeze"/><animate attributeName="y" from="110" to="15" dur="1.35s" fill="freeze"/></rect>
                            <rect x="214" y="40" width="22" height="70" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="70" dur="1.1s" fill="freeze"/><animate attributeName="y" from="110" to="40" dur="1.1s" fill="freeze"/></rect>
                            <rect x="248" y="25" width="22" height="85" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="85" dur="1.25s" fill="freeze"/><animate attributeName="y" from="110" to="25" dur="1.25s" fill="freeze"/></rect>
                            <rect x="282" y="38" width="22" height="72" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="72" dur="1.12s" fill="freeze"/><animate attributeName="y" from="110" to="38" dur="1.12s" fill="freeze"/></rect>
                            <rect x="316" y="10" width="22" height="100" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="100" dur="1.4s" fill="freeze"/><animate attributeName="y" from="110" to="10" dur="1.4s" fill="freeze"/></rect>
                            <rect x="350" y="28" width="22" height="82" rx="4" fill="url(#barGrad1)" opacity="0.9"><animate attributeName="height" from="0" to="82" dur="1.22s" fill="freeze"/><animate attributeName="y" from="110" to="28" dur="1.22s" fill="freeze"/></rect>
                            <!-- Expense bars (red) -->
                            <rect x="18" y="75" width="14" height="35" rx="3" fill="rgba(239,68,68,0.5)"><animate attributeName="height" from="0" to="35" dur="1s" fill="freeze"/><animate attributeName="y" from="110" to="75" dur="1s" fill="freeze"/></rect>
                            <rect x="52" y="68" width="14" height="42" rx="3" fill="rgba(239,68,68,0.5)"><animate attributeName="height" from="0" to="42" dur="1.2s" fill="freeze"/><animate attributeName="y" from="110" to="68" dur="1.2s" fill="freeze"/></rect>
                            <rect x="86" y="72" width="14" height="38" rx="3" fill="rgba(239,68,68,0.5)"><animate attributeName="height" from="0" to="38" dur="1.1s" fill="freeze"/><animate attributeName="y" from="110" to="72" dur="1.1s" fill="freeze"/></rect>
                            <rect x="120" y="78" width="14" height="32" rx="3" fill="rgba(239,68,68,0.5)"><animate attributeName="height" from="0" to="32" dur="1.3s" fill="freeze"/><animate attributeName="y" from="110" to="78" dur="1.3s" fill="freeze"/></rect>
                            <rect x="154" y="74" width="14" height="36" rx="3" fill="rgba(239,68,68,0.5)"><animate attributeName="height" from="0" to="36" dur="1.15s" fill="freeze"/><animate attributeName="y" from="110" to="74" dur="1.15s" fill="freeze"/></rect>
                            <rect x="188" y="65" width="14" height="45" rx="3" fill="rgba(239,68,68,0.5)"><animate attributeName="height" from="0" to="45" dur="1.35s" fill="freeze"/><animate attributeName="y" from="110" to="65" dur="1.35s" fill="freeze"/></rect>
                            <!-- Gradient definition -->
                            <defs>
                                <linearGradient id="barGrad1" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#3b82f6"/>
                                    <stop offset="100%" stop-color="#2563eb"/>
                                </linearGradient>
                            </defs>
                            <!-- Labels -->
                            <text x="20" y="118" fill="#4b5563" font-size="8" font-family="Inter">ม.ค.</text>
                            <text x="120" y="118" fill="#4b5563" font-size="8" font-family="Inter">เม.ย.</text>
                            <text x="250" y="118" fill="#4b5563" font-size="8" font-family="Inter">ส.ค.</text>
                            <text x="350" y="118" fill="#4b5563" font-size="8" font-family="Inter">พ.ย.</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" style="padding:100px 0;background:#0a1128;">
    <div class="container">
        <div style="text-align:center;margin-bottom:64px;">
            <h2 style="font-size:36px;font-weight:800;color:white;margin-bottom:12px;">ทุกเครื่องมือที่กองทุนต้องการ</h2>
            <p style="color:#64748b;font-size:16px;">ระบบออนไลน์ที่ออกแบบมาเพื่อกองทุนหมู่บ้านโดยเฉพาะ</p>
            <div style="width:80px;height:4px;background:linear-gradient(90deg,#dc2626,#2563eb);border-radius:2px;margin:20px auto 0;"></div>
        </div>

        <div class="features-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
            <!-- Feature Cards -->
            <div class="glass hover-card" style="padding:32px;border-top:3px solid rgba(37,99,235,0.6);">
                <div class="icon-glow" style="--glow-color:rgba(37,99,235,0.4);width:56px;height:56px;background:linear-gradient(135deg,rgba(37,99,235,0.2),rgba(37,99,235,0.05));border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="28" height="28" fill="none" stroke="#60a5fa" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">บันทึกบัญชี</h3>
                <p style="font-size:14px;color:#94a3b8;line-height:1.7;">บันทึกรายรับ-รายจ่าย ระบบบัญชีแยกประเภท (VFGL) งบทดลอง งบกำไรขาดทุน งบดุล ครบถ้วน</p>
            </div>
            <div class="glass hover-card" style="padding:32px;border-top:3px solid rgba(16,185,129,0.5);">
                <div class="icon-glow" style="--glow-color:rgba(16,185,129,0.4);width:56px;height:56px;background:linear-gradient(135deg,rgba(16,185,129,0.2),rgba(16,185,129,0.05));border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="28" height="28" fill="none" stroke="#34d399" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">สินเชื่อ</h3>
                <p style="font-size:14px;color:#94a3b8;line-height:1.7;">สร้างสัญญา อนุมัติ เบิกจ่าย รับชำระ ตารางผ่อนชำระอัตโนมัติ ติดตามหนี้ค้างชำระ แจ้งเตือน LINE</p>
            </div>
            <div class="glass hover-card" style="padding:32px;border-top:3px solid rgba(220,38,38,0.5);">
                <div class="icon-glow" style="--glow-color:rgba(220,38,38,0.4);width:56px;height:56px;background:linear-gradient(135deg,rgba(220,38,38,0.2),rgba(220,38,38,0.05));border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="28" height="28" fill="none" stroke="#f87171" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">เงินฝาก & หุ้น</h3>
                <p style="font-size:14px;color:#94a3b8;line-height:1.7;">รับฝาก-ถอนเงินสมาชิก ซื้อ-ขายหุ้น คำนวณดอกเบี้ย ดูยอดคงเหลือ ประวัติทุกรายการ</p>
            </div>
            <div class="glass hover-card" style="padding:32px;border-top:3px solid rgba(212,168,67,0.5);">
                <div class="icon-glow" style="--glow-color:rgba(212,168,67,0.4);width:56px;height:56px;background:linear-gradient(135deg,rgba(212,168,67,0.2),rgba(212,168,67,0.05));border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="28" height="28" fill="none" stroke="#d4a843" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">รายงานการเงิน</h3>
                <p style="font-size:14px;color:#94a3b8;line-height:1.7;">งบทดลอง งบกำไรขาดทุน งบดุล บัญชีแยกประเภท ดาวน์โหลด PDF กราฟสรุปสวยงาม</p>
            </div>
            <div class="glass hover-card" style="padding:32px;border-top:3px solid rgba(37,99,235,0.5);">
                <div class="icon-glow" style="--glow-color:rgba(37,99,235,0.4);width:56px;height:56px;background:linear-gradient(135deg,rgba(37,99,235,0.2),rgba(37,99,235,0.05));border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="28" height="28" fill="none" stroke="#60a5fa" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">แอปมือถือ</h3>
                <p style="font-size:14px;color:#94a3b8;line-height:1.7;">สมาชิกดูยอดสินเชื่อ เงินฝาก หุ้น ผ่านแอปได้เลย อัพเดทอัตโนมัติ ใช้งานสะดวก</p>
            </div>
            <div class="glass hover-card" style="padding:32px;border-top:3px solid rgba(34,197,94,0.5);">
                <div class="icon-glow" style="--glow-color:rgba(34,197,94,0.4);width:56px;height:56px;background:linear-gradient(135deg,rgba(34,197,94,0.2),rgba(34,197,94,0.05));border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <svg width="28" height="28" fill="none" stroke="#4ade80" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">LINE แจ้งเตือน</h3>
                <p style="font-size:14px;color:#94a3b8;line-height:1.7;">เชื่อมต่อ LINE OA แจ้งเตือนครบกำหนดชำระ ยืนยันฝาก-ถอน ข่าวสารกองทุน อัตโนมัติ</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section style="padding:100px 0;background:linear-gradient(180deg,#0a1128,#0f1d3a);">
    <div class="container">
        <div style="text-align:center;margin-bottom:64px;">
            <h2 style="font-size:36px;font-weight:800;color:white;">เริ่มต้นง่ายใน 3 ขั้นตอน</h2>
            <div style="width:80px;height:4px;background:linear-gradient(90deg,#dc2626,#d4a843,#2563eb);border-radius:2px;margin:20px auto 0;"></div>
        </div>
        <div class="steps-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:40px;text-align:center;">
            <div>
                <div style="width:72px;height:72px;background:linear-gradient(135deg,#dc2626,#ef4444);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:28px;font-weight:900;color:white;box-shadow:0 10px 30px rgba(220,38,38,0.4);">1</div>
                <h3 style="font-size:20px;font-weight:700;color:white;margin-bottom:8px;">ลงทะเบียนกองทุน</h3>
                <p style="color:#94a3b8;font-size:14px;">กรอกข้อมูลกองทุนและผู้ดูแล ใช้เวลาไม่ถึง 5 นาที</p>
            </div>
            <div>
                <div style="width:72px;height:72px;background:linear-gradient(135deg,#2563eb,#3b82f6);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:28px;font-weight:900;color:white;box-shadow:0 10px 30px rgba(37,99,235,0.4);">2</div>
                <h3 style="font-size:20px;font-weight:700;color:white;margin-bottom:8px;">ตั้งค่าข้อมูล</h3>
                <p style="color:#94a3b8;font-size:14px;">เพิ่มชุดบัญชี บัญชีธนาคาร และสมาชิก</p>
            </div>
            <div>
                <div style="width:72px;height:72px;background:linear-gradient(135deg,#d4a843,#f59e0b);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:28px;font-weight:900;color:white;box-shadow:0 10px 30px rgba(212,168,67,0.4);">3</div>
                <h3 style="font-size:20px;font-weight:700;color:white;margin-bottom:8px;">เริ่มใช้งาน</h3>
                <p style="color:#94a3b8;font-size:14px;">บันทึกบัญชี จัดการสินเชื่อ ดูรายงาน ได้ทันที</p>
            </div>
        </div>
    </div>
</section>

<!-- TRUST -->
<section style="padding:100px 0;background:#0a1128;">
    <div class="container">
        <div style="text-align:center;margin-bottom:64px;">
            <h2 style="font-size:36px;font-weight:800;color:white;">ปลอดภัยระดับสากล</h2>
        </div>
        <div class="trust-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
            <div class="glass" style="padding:32px;text-align:center;">
                <div style="font-size:48px;margin-bottom:16px;">&#x1F6E1;&#xFE0F;</div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">คุ้มครอง PDPA</h3>
                <p style="font-size:14px;color:#94a3b8;">ปฏิบัติตามพ.ร.บ.คุ้มครองข้อมูลส่วนบุคคล ครบถ้วน</p>
            </div>
            <div class="glass" style="padding:32px;text-align:center;">
                <div style="font-size:48px;margin-bottom:16px;">&#x1F512;</div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">เข้ารหัส AES-256</h3>
                <p style="font-size:14px;color:#94a3b8;">ข้อมูลสำคัญเข้ารหัสระดับธนาคาร ปลอดภัยสูงสุด</p>
            </div>
            <div class="glass" style="padding:32px;text-align:center;">
                <div style="font-size:48px;margin-bottom:16px;">&#x1F4CB;</div>
                <h3 style="font-size:18px;font-weight:700;color:white;margin-bottom:8px;">ตรวจสอบได้ทุกรายการ</h3>
                <p style="font-size:14px;color:#94a3b8;">ระบบ Audit Log บันทึกทุกการเปลี่ยนแปลง ย้อนดูได้</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="padding:100px 0;background:linear-gradient(135deg,#0f1d3a,#1e3a8a);">
    <div class="container" style="text-align:center;">
        <div class="glass-strong" style="padding:60px 40px;max-width:800px;margin:0 auto;border:1px solid rgba(37,99,235,0.3);box-shadow:0 0 60px rgba(37,99,235,0.15);">
            <h2 style="font-size:36px;font-weight:800;color:white;margin-bottom:12px;">เริ่มบริหารกองทุนวันนี้</h2>
            <p style="color:#93c5fd;font-size:18px;margin-bottom:32px;">ฟรีตลอดชีพ ไม่มีค่าใช้จ่ายแอบแฝง</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
                <a href="/register" class="glow-btn" style="padding:16px 40px;background:linear-gradient(135deg,#dc2626,#b91c1c);color:white;font-size:18px;font-weight:700;border-radius:16px;">ลงทะเบียนฟรี</a>
                <a href="/guide" class="glass glow-btn-blue" style="padding:16px 40px;color:white;font-size:18px;font-weight:500;">อ่านคู่มือก่อน</a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer style="padding:60px 0;background:#070d1f;border-top:1px solid rgba(255,255,255,0.05);">
    <div class="container">
        <div class="footer-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:40px;">
            <div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
                    <img src="/images/logo-sm.webp" alt="KTB Account" style="width:36px;height:36px;border-radius:8px;">
                    <span style="font-weight:700;color:white;">KTB Account</span>
                </div>
                <p style="color:#64748b;font-size:13px;">ระบบบริหารกองทุนหมู่บ้านออนไลน์<br>โดย XMAN Studio</p>
            </div>
            <div>
                <h4 style="color:white;font-weight:600;margin-bottom:16px;">ลิงก์</h4>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:8px;font-size:14px;">
                    <li><a href="/login" style="color:#64748b;transition:color 0.2s;">เข้าสู่ระบบ</a></li>
                    <li><a href="/register" style="color:#64748b;">ลงทะเบียน</a></li>
                    <li><a href="/demo" style="color:#64748b;">ทดลองใช้งาน</a></li>
                    <li><a href="/guide" style="color:#64748b;">คู่มือการใช้งาน</a></li>
                    <li><a href="/privacy-policy" style="color:#64748b;">นโยบายความเป็นส่วนตัว</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color:white;font-weight:600;margin-bottom:16px;">ติดต่อ</h4>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:8px;font-size:14px;color:#64748b;">
                    <li>XMAN Studio</li>
                    <li><a href="https://xman4289.com" target="_blank" style="color:#60a5fa;">xman4289.com</a></li>
                    <li><a href="mailto:support@xman4289.com" style="color:#60a5fa;">support@xman4289.com</a></li>
                </ul>
            </div>
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.05);margin-top:40px;padding-top:24px;text-align:center;color:#374151;font-size:12px;">
            &copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน v{{ $appVersion ?? '1.0.0' }}
        </div>
    </div>
</footer>

</body>
</html>
