<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบบริหารกองทุนหมู่บ้าน - KTB Account</title>
    <meta name="description" content="ระบบบริหารกองทุนหมู่บ้านออนไลน์ จัดการบัญชี สินเชื่อ เงินฝาก หุ้น รายงานการเงิน ใช้งานง่าย ฟรี โดย XMAN Studio">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #312e81 70%, #4338ca 100%);
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .glow-box {
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.15), 0 0 80px rgba(99, 102, 241, 0.05);
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>
<body class="antialiased bg-gray-950 text-gray-100">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-gray-950/80 backdrop-blur-xl border-b border-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-white">KTB Account</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/guide" class="text-gray-400 hover:text-white text-sm transition-colors hidden sm:block">คู่มือการใช้งาน</a>
                    <a href="/login" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-all duration-200">
                        เข้าสู่ระบบ
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
        {{-- Background decorations --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-600/5 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Left: Text --}}
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-indigo-300 text-sm mb-6">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        ใช้งานฟรี ไม่มีค่าใช้จ่าย
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        ระบบบริหาร<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">กองทุนหมู่บ้าน</span>
                    </h1>

                    <p class="text-lg text-gray-300 mb-8 leading-relaxed max-w-xl">
                        จัดการบัญชี สินเชื่อ เงินฝาก หุ้น รายงานการเงิน ครบจบในที่เดียว
                        ใช้งานง่าย ปลอดภัย พร้อมแจ้งเตือนผ่าน LINE และแอปมือถือ
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <a href="/register" class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-center transition-all duration-200 hover:shadow-lg hover:shadow-indigo-600/30">
                            ลงทะเบียนกองทุนใหม่
                        </a>
                        <a href="/guide" class="px-8 py-3.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-medium rounded-xl text-center transition-all duration-200">
                            ดูคู่มือการใช้งาน
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold text-white">ฟรี</div>
                            <div class="text-sm text-gray-400">ไม่มีค่าใช้จ่าย</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold text-white">ครบ</div>
                            <div class="text-sm text-gray-400">ทุกฟังก์ชัน</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold text-white">24/7</div>
                            <div class="text-sm text-gray-400">ใช้งานได้ตลอด</div>
                        </div>
                    </div>
                </div>

                {{-- Right: Dashboard Preview --}}
                <div class="hidden lg:block">
                    <div class="float-animation">
                        <div class="bg-gray-900/80 border border-gray-700/50 rounded-2xl p-6 glow-box">
                            {{-- Mini dashboard preview --}}
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="bg-indigo-900/30 border border-indigo-700/30 rounded-xl p-4">
                                    <div class="text-xs text-indigo-300 mb-1">เงินสด</div>
                                    <div class="text-xl font-bold text-white">฿125,430</div>
                                    <div class="text-xs text-green-400 mt-1">+12.5%</div>
                                </div>
                                <div class="bg-purple-900/30 border border-purple-700/30 rounded-xl p-4">
                                    <div class="text-xs text-purple-300 mb-1">เงินฝากธนาคาร</div>
                                    <div class="text-xl font-bold text-white">฿1,250,000</div>
                                    <div class="text-xs text-green-400 mt-1">+5.2%</div>
                                </div>
                                <div class="bg-blue-900/30 border border-blue-700/30 rounded-xl p-4">
                                    <div class="text-xs text-blue-300 mb-1">สินเชื่อคงค้าง</div>
                                    <div class="text-xl font-bold text-white">฿890,500</div>
                                    <div class="text-xs text-yellow-400 mt-1">15 สัญญา</div>
                                </div>
                                <div class="bg-emerald-900/30 border border-emerald-700/30 rounded-xl p-4">
                                    <div class="text-xs text-emerald-300 mb-1">จำนวนสมาชิก</div>
                                    <div class="text-xl font-bold text-white">127 คน</div>
                                    <div class="text-xs text-green-400 mt-1">+3 เดือนนี้</div>
                                </div>
                            </div>
                            {{-- Mini chart bars --}}
                            <div class="bg-gray-800/50 rounded-xl p-4">
                                <div class="text-xs text-gray-400 mb-3">รายรับ-รายจ่ายรายเดือน</div>
                                <div class="flex items-end gap-2 h-20">
                                    @foreach([40, 65, 45, 80, 55, 90, 70, 85, 60, 95, 75, 88] as $i => $h)
                                        <div class="flex-1 flex flex-col gap-1">
                                            <div class="bg-indigo-500/60 rounded-t" style="height: {{ $h }}%"></div>
                                            <div class="bg-red-500/40 rounded-b" style="height: {{ 100 - $h }}%"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-20 bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">ครบทุกฟังก์ชันที่กองทุนต้องการ</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">ระบบออนไลน์ที่ออกแบบมาเพื่อกองทุนหมู่บ้านโดยเฉพาะ ใช้งานง่าย ปลอดภัย</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Feature 1 --}}
                <div class="feature-card bg-gray-900/50 border border-gray-800 rounded-2xl p-6 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-600/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">บันทึกบัญชี</h3>
                    <p class="text-gray-400 text-sm">บันทึกรายรับ-รายจ่าย ระบบบัญชีแยกประเภท (VFGL) งบทดลอง งบกำไรขาดทุน งบดุล ครบถ้วน</p>
                </div>

                {{-- Feature 2 --}}
                <div class="feature-card bg-gray-900/50 border border-gray-800 rounded-2xl p-6 transition-all duration-300">
                    <div class="w-12 h-12 bg-green-600/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">สินเชื่อ</h3>
                    <p class="text-gray-400 text-sm">สร้างสัญญา อนุมัติ เบิกจ่าย รับชำระ ตารางผ่อนชำระอัตโนมัติ ติดตามหนี้ค้างชำระ</p>
                </div>

                {{-- Feature 3 --}}
                <div class="feature-card bg-gray-900/50 border border-gray-800 rounded-2xl p-6 transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-600/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">เงินฝาก & หุ้น</h3>
                    <p class="text-gray-400 text-sm">รับฝาก-ถอนเงินสมาชิก ซื้อ-ขายหุ้น คำนวณดอกเบี้ย ดูยอดคงเหลือ ประวัติทุกรายการ</p>
                </div>

                {{-- Feature 4 --}}
                <div class="feature-card bg-gray-900/50 border border-gray-800 rounded-2xl p-6 transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-600/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">รายงานการเงิน</h3>
                    <p class="text-gray-400 text-sm">งบทดลอง งบกำไรขาดทุน งบดุล บัญชีแยกประเภท ดาวน์โหลด PDF กราฟสรุปสวยงาม</p>
                </div>

                {{-- Feature 5 --}}
                <div class="feature-card bg-gray-900/50 border border-gray-800 rounded-2xl p-6 transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-600/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">แอปมือถือ</h3>
                    <p class="text-gray-400 text-sm">สมาชิกดูยอดสินเชื่อ เงินฝาก หุ้น ผ่านแอปได้เลย อัพเดทอัตโนมัติ ใช้งานสะดวก</p>
                </div>

                {{-- Feature 6 --}}
                <div class="feature-card bg-gray-900/50 border border-gray-800 rounded-2xl p-6 transition-all duration-300">
                    <div class="w-12 h-12 bg-green-600/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">LINE แจ้งเตือน</h3>
                    <p class="text-gray-400 text-sm">เชื่อมต่อ LINE OA แจ้งเตือนครบกำหนดชำระ ยืนยันฝาก-ถอน ข่าวสารกองทุน อัตโนมัติ</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 hero-gradient">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">เริ่มใช้งานวันนี้ ฟรี!</h2>
            <p class="text-gray-300 text-lg mb-8">ลงทะเบียนกองทุนหมู่บ้านของคุณ แล้วเริ่มจัดการบัญชีได้ทันที</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="px-10 py-4 bg-white text-indigo-900 font-bold rounded-xl hover:bg-gray-100 transition-all duration-200 text-lg">
                    ลงทะเบียนฟรี
                </a>
                <a href="/guide" class="px-10 py-4 bg-white/10 border border-white/20 text-white font-medium rounded-xl hover:bg-white/20 transition-all duration-200 text-lg">
                    อ่านคู่มือก่อน
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-950 border-t border-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white">KTB Account</span>
                    </div>
                    <p class="text-gray-400 text-sm">ระบบบริหารกองทุนหมู่บ้านออนไลน์<br>โดย XMAN Studio</p>
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
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} XMAN Studio - ระบบบริหารกองทุนหมู่บ้าน v{{ trim(file_get_contents(base_path('VERSION'))) }}
            </div>
        </div>
    </footer>

</body>
</html>
