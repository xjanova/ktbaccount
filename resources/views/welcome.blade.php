<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบบริหารกองทุนหมู่บ้าน - KTB Account</title>
    <meta name="description" content="ระบบบริหารกองทุนหมู่บ้านออนไลน์ จัดการบัญชี สินเชื่อ เงินฝาก หุ้น รายงานการเงิน ฟรี โดย XMAN Studio">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { overflow-x: hidden; }

        /* Animated gradient orbs */
        .orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.4; pointer-events: none; }
        .orb-1 { width: 600px; height: 600px; background: radial-gradient(circle, #6366f1, transparent 70%); top: -200px; left: -200px; animation: orbFloat1 20s ease-in-out infinite; }
        .orb-2 { width: 500px; height: 500px; background: radial-gradient(circle, #8b5cf6, transparent 70%); top: 30%; right: -150px; animation: orbFloat2 25s ease-in-out infinite; }
        .orb-3 { width: 400px; height: 400px; background: radial-gradient(circle, #a855f7, transparent 70%); bottom: -100px; left: 30%; animation: orbFloat3 18s ease-in-out infinite; }
        @keyframes orbFloat1 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(100px,80px); } }
        @keyframes orbFloat2 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(-80px,60px); } }
        @keyframes orbFloat3 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(60px,-80px); } }

        /* Grid pattern */
        .grid-bg { background-image: linear-gradient(rgba(99,102,241,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(99,102,241,0.03) 1px, transparent 1px); background-size: 60px 60px; }

        /* Gradient text */
        .gradient-text { background: linear-gradient(135deg, #818cf8 0%, #a78bfa 30%, #c084fc 60%, #818cf8 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; animation: gradientShift 4s ease-in-out infinite; }
        @keyframes gradientShift { 0%,100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }

        /* Glass card */
        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }
        .glass-strong { background: rgba(255,255,255,0.06); backdrop-filter: blur(30px); border: 1px solid rgba(255,255,255,0.12); }

        /* Feature card hover */
        .feature-card { transition: all 0.4s cubic-bezier(0.4,0,0.2,1); }
        .feature-card:hover { transform: translateY(-8px); border-color: rgba(255,255,255,0.2); box-shadow: 0 25px 50px -12px rgba(99,102,241,0.25); }

        /* Glow button */
        .glow-btn { position: relative; overflow: hidden; transition: all 0.3s; }
        .glow-btn:hover { box-shadow: 0 0 30px rgba(99,102,241,0.4), 0 0 60px rgba(99,102,241,0.2); transform: translateY(-2px); }
        .glow-btn::after { content: ''; position: absolute; inset: -2px; background: linear-gradient(135deg, #6366f1, #a855f7, #6366f1); z-index: -1; border-radius: inherit; opacity: 0; transition: opacity 0.3s; }
        .glow-btn:hover::after { opacity: 1; }

        /* Float animation */
        .float { animation: floatAnim 6s ease-in-out infinite; }
        @keyframes floatAnim { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }

        /* Fade in on scroll */
        .fade-up { opacity: 0; transform: translateY(40px); transition: all 0.8s cubic-bezier(0.4,0,0.2,1); }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* Pulse badge */
        .pulse-glow { animation: pulseGlow 2s ease-in-out infinite; }
        @keyframes pulseGlow { 0%,100% { box-shadow: 0 0 5px rgba(99,102,241,0.3); } 50% { box-shadow: 0 0 20px rgba(99,102,241,0.6); } }

        /* Step connector */
        .step-line { position: relative; }
        .step-line::after { content: ''; position: absolute; top: 50%; left: 100%; width: 100%; height: 2px; background: linear-gradient(90deg, #6366f1, transparent); }
    </style>
</head>
<body class="antialiased" x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 50">

    {{-- Animated background orbs --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    {{-- Grid overlay --}}
    <div class="fixed inset-0 grid-bg pointer-events-none z-0"></div>

    {{-- NAV --}}
    <nav class="fixed top-0 w-full z-50 transition-all duration-500" :class="scrolled ? 'glass-strong shadow-2xl' : 'bg-transparent'">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <span class="text-lg font-bold text-white">KTB Account</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="/demo" class="text-gray-400 hover:text-white text-sm transition-colors hidden md:block">🧪 ทดลองใช้งาน</a>
                <a href="#features" class="text-gray-400 hover:text-white text-sm transition-colors hidden md:block">คุณสมบัติ</a>
                <a href="/guide" class="text-gray-400 hover:text-white text-sm transition-colors hidden md:block">คู่มือ</a>
                <a href="/login" class="glow-btn px-5 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl">เข้าสู่ระบบ</a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative min-h-screen flex items-center z-10 pt-16">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 glass rounded-full text-indigo-300 text-sm mb-8 pulse-glow">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        ใช้งานฟรีตลอดชีพ
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-tight mb-6">
                        <span class="text-white">ระบบบริหาร</span><br>
                        <span class="gradient-text">กองทุนหมู่บ้าน</span>
                    </h1>

                    <p class="text-lg text-gray-400 mb-10 leading-relaxed max-w-lg">
                        จัดการบัญชี สินเชื่อ เงินฝาก หุ้น รายงานการเงิน ครบจบในที่เดียว
                        ใช้งานง่าย ปลอดภัย พร้อมแจ้งเตือนผ่าน LINE
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-14">
                        <a href="/register" class="glow-btn px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl text-center text-lg">
                            เริ่มต้นใช้งาน
                        </a>
                        <a href="/guide" class="px-8 py-4 glass hover:bg-white/10 text-white font-medium rounded-2xl text-center text-lg transition-all">
                            ดูคู่มือการใช้งาน
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-4 gap-4" x-data="{ show: false }" x-intersect="show = true">
                        <div><div class="text-2xl font-bold text-white" x-text="show ? '77K+' : '0'">0</div><div class="text-xs text-gray-500">กองทุน</div></div>
                        <div><div class="text-2xl font-bold text-white" x-text="show ? '10M+' : '0'">0</div><div class="text-xs text-gray-500">สมาชิก</div></div>
                        <div><div class="text-2xl font-bold text-white" x-text="show ? '฿50B+' : '0'">0</div><div class="text-xs text-gray-500">บริหาร</div></div>
                        <div><div class="text-2xl font-bold text-white" x-text="show ? '99.9%' : '0'">0</div><div class="text-xs text-gray-500">ปลอดภัย</div></div>
                    </div>
                </div>

                {{-- Dashboard Preview --}}
                <div class="hidden lg:block float">
                    <div class="glass-strong rounded-3xl p-6 shadow-2xl shadow-indigo-500/10">
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-2xl p-4">
                                <div class="text-xs text-indigo-300 mb-1">เงินสด</div>
                                <div class="text-xl font-bold text-white">฿125,430</div>
                                <div class="text-xs text-emerald-400 mt-1">↑ 12.5%</div>
                            </div>
                            <div class="bg-purple-500/10 border border-purple-500/20 rounded-2xl p-4">
                                <div class="text-xs text-purple-300 mb-1">เงินฝาก</div>
                                <div class="text-xl font-bold text-white">฿1,250,000</div>
                                <div class="text-xs text-emerald-400 mt-1">↑ 5.2%</div>
                            </div>
                            <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-4">
                                <div class="text-xs text-amber-300 mb-1">สินเชื่อคงค้าง</div>
                                <div class="text-xl font-bold text-white">฿890,500</div>
                                <div class="text-xs text-amber-400 mt-1">15 สัญญา</div>
                            </div>
                            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-4">
                                <div class="text-xs text-emerald-300 mb-1">สมาชิก</div>
                                <div class="text-xl font-bold text-white">127 คน</div>
                                <div class="text-xs text-emerald-400 mt-1">+3 เดือนนี้</div>
                            </div>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-4">
                            <div class="text-xs text-gray-400 mb-3">รายรับ-รายจ่ายรายเดือน</div>
                            <div class="flex items-end gap-1.5 h-24">
                                @php $bars = [40,65,45,80,55,90,70,85,60,95,75,88]; @endphp
                                @foreach($bars as $h)
                                    <div class="flex-1 rounded-t-sm bg-gradient-to-t from-indigo-600/80 to-purple-500/60" style="height:{{ $h }}%"></div>
                                @endforeach
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-[10px] text-gray-500">ม.ค.</span>
                                <span class="text-[10px] text-gray-500">มิ.ย.</span>
                                <span class="text-[10px] text-gray-500">ธ.ค.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section id="features" class="relative z-10 py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 fade-up" x-data x-intersect="$el.classList.add('visible')">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">ทุกเครื่องมือที่กองทุนต้องการ</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">ออกแบบมาเพื่อกองทุนหมู่บ้านโดยเฉพาะ ใช้งานง่าย ปลอดภัย</p>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-auto mt-6"></div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $features = [
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>', 'color' => 'indigo', 'title' => 'บันทึกบัญชี', 'desc' => 'บันทึกรายรับ-รายจ่าย ระบบบัญชีแยกประเภท งบทดลอง งบกำไรขาดทุน งบดุล ครบถ้วน'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>', 'color' => 'emerald', 'title' => 'สินเชื่อ', 'desc' => 'สร้างสัญญา อนุมัติ เบิกจ่าย รับชำระ ตารางผ่อนชำระอัตโนมัติ ติดตามหนี้'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>', 'color' => 'blue', 'title' => 'เงินฝาก & หุ้น', 'desc' => 'รับฝาก-ถอนเงิน ซื้อ-ขายหุ้น คำนวณดอกเบี้ย ดูยอดคงเหลือ ประวัติทุกรายการ'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>', 'color' => 'purple', 'title' => 'รายงานการเงิน', 'desc' => 'งบทดลอง งบกำไรขาดทุน งบดุล บัญชีแยกประเภท ดาวน์โหลด PDF กราฟสรุป'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>', 'color' => 'cyan', 'title' => 'แอปมือถือ', 'desc' => 'สมาชิกดูยอดสินเชื่อ เงินฝาก หุ้น ผ่านแอปได้ อัพเดทอัตโนมัติ สะดวก'],
                    ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>', 'color' => 'green', 'title' => 'LINE แจ้งเตือน', 'desc' => 'เชื่อมต่อ LINE OA แจ้งเตือนครบกำหนดชำระ ยืนยันฝาก-ถอน ข่าวสาร อัตโนมัติ'],
                ];
                $colors = ['indigo'=>'99,102,241','emerald'=>'16,185,129','blue'=>'59,130,246','purple'=>'139,92,246','cyan'=>'6,182,212','green'=>'34,197,94'];
                @endphp

                @foreach($features as $i => $f)
                <div class="feature-card glass rounded-2xl p-6 fade-up" x-data x-intersect="$el.classList.add('visible')" style="border-top: 2px solid rgba({{ $colors[$f['color']] }}, 0.5); transition-delay: {{ $i * 100 }}ms">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background: rgba({{ $colors[$f['color']] }}, 0.15)">
                        <svg class="w-6 h-6" style="color: rgb({{ $colors[$f['color']] }})" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $f['icon'] !!}</svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">{{ $f['title'] }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="relative z-10 py-24">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16 fade-up" x-data x-intersect="$el.classList.add('visible')">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">เริ่มต้นง่ายใน 3 ขั้นตอน</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-auto mt-6"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8 fade-up" x-data x-intersect="$el.classList.add('visible')">
                @foreach([['1','ลงทะเบียนกองทุน','กรอกข้อมูลกองทุนและผู้ดูแล ใช้เวลาไม่ถึง 5 นาที'],['2','ตั้งค่าข้อมูล','เพิ่มชุดบัญชี บัญชีธนาคาร และสมาชิก'],['3','เริ่มใช้งาน','บันทึกบัญชี จัดการสินเชื่อ ดูรายงาน ได้ทันที']] as $step)
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold text-white shadow-lg shadow-indigo-500/30">{{ $step[0] }}</div>
                    <h3 class="text-lg font-semibold text-white mb-2">{{ $step[1] }}</h3>
                    <p class="text-gray-400 text-sm">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TRUST --}}
    <section class="relative z-10 py-24">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16 fade-up" x-data x-intersect="$el.classList.add('visible')">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">ปลอดภัยระดับสากล</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6 fade-up" x-data x-intersect="$el.classList.add('visible')">
                @foreach([['🛡️','คุ้มครอง PDPA','ปฏิบัติตามพ.ร.บ.คุ้มครองข้อมูลส่วนบุคคล ครบถ้วน'],['🔒','เข้ารหัส AES-256','ข้อมูลสำคัญเข้ารหัสระดับธนาคาร ปลอดภัยสูงสุด'],['📋','ตรวจสอบได้ทุกรายการ','ระบบ Audit Log บันทึกทุกการเปลี่ยนแปลง ย้อนดูได้']] as $item)
                <div class="glass rounded-2xl p-6 text-center">
                    <div class="text-4xl mb-4">{{ $item[0] }}</div>
                    <h3 class="text-lg font-semibold text-white mb-2">{{ $item[1] }}</h3>
                    <p class="text-gray-400 text-sm">{{ $item[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="relative z-10 py-24">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="glass-strong rounded-3xl p-12 fade-up" x-data x-intersect="$el.classList.add('visible')" style="border: 1px solid rgba(99,102,241,0.3)">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">เริ่มบริหารกองทุนวันนี้</h2>
                <p class="text-gray-400 text-lg mb-8">ฟรีตลอดชีพ ไม่มีค่าใช้จ่ายแอบแฝง</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="glow-btn px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl text-lg">
                        ลงทะเบียนฟรี
                    </a>
                    <a href="/guide" class="px-10 py-4 glass hover:bg-white/10 text-white font-medium rounded-2xl text-lg transition-all">
                        อ่านคู่มือก่อน
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="relative z-10 border-t border-white/5 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid sm:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <span class="font-bold text-white">KTB Account</span>
                    </div>
                    <p class="text-gray-500 text-sm">ระบบบริหารกองทุนหมู่บ้านออนไลน์<br>โดย XMAN Studio</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">ลิงก์</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/login" class="text-gray-400 hover:text-white transition-colors">เข้าสู่ระบบ</a></li>
                        <li><a href="/register" class="text-gray-400 hover:text-white transition-colors">ลงทะเบียน</a></li>
                        <li><a href="/guide" class="text-gray-400 hover:text-white transition-colors">คู่มือการใช้งาน</a></li>
                        <li><a href="/privacy-policy" class="text-gray-400 hover:text-white transition-colors">นโยบายความเป็นส่วนตัว</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">ติดต่อ</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>XMAN Studio</li>
                        <li><a href="https://xman4289.com" target="_blank" class="hover:text-white transition-colors">xman4289.com</a></li>
                        <li><a href="mailto:support@xman4289.com" class="hover:text-white transition-colors">support@xman4289.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/5 mt-8 pt-8 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน v{{ $appVersion }}
            </div>
        </div>
    </footer>

    <script>
    // Fade-in on scroll for browsers without x-intersect
    if (!window.Alpine) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    }
    </script>
</body>
</html>
