@extends('layouts.app')

@section('page-title', 'แดชบอร์ด (โหมดทดลอง)')

@section('content')
@php
    $cashBalance = $fund['total_cash'] ?? 125430;
    $bankBalance = $fund['total_bank'] ?? 1250000;
    $outstandingLoans = $fund['total_loans_outstanding'] ?? 890500;
    $memberCount = $fund['total_members'] ?? 127;
    $overdueCount = $fund['overdue_loans'] ?? 2;
    $activeLoans = $fund['active_loans'] ?? 15;
    $incomeData = array_slice($fund['monthly_income'] ?? [45000,52000,48000,61000,55000,67000], 0, 6);
    $expenseData = array_slice($fund['monthly_expense'] ?? [32000,28000,35000,29000,31000,38000], 0, 6);
    $loanCats = ['สินเชื่อฉุกเฉิน', 'สินเชื่อทั่วไป', 'สินเชื่อเพื่อการศึกษา', 'สินเชื่อเพื่อที่อยู่อาศัย'];
    $loanAmts = [30, 40, 15, 15];
@endphp

<style>
    .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { border-color: rgba(255,255,255,0.2); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.4); transform: translateY(-2px); }
    .gradient-text { background: linear-gradient(135deg, #818cf8, #a78bfa, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .glass-card { background: rgba(255,255,255,0.03); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.08); }
    .action-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .action-btn:hover { transform: translateY(-2px); }
</style>

{{-- Demo Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-600/20 to-orange-600/20 border border-amber-500/30">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div class="flex items-center gap-2">
            <span class="text-lg">🧪</span>
            <span class="text-amber-300 font-semibold text-sm">โหมดทดลองใช้งาน</span>
            <span class="text-amber-400/70 text-xs">- กองทุนหมู่บ้านบ้านสวนสวรรค์ (ข้อมูลตัวอย่าง)</span>
        </div>
        <a href="/register" class="px-4 py-1.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-medium rounded-lg transition-colors">ลงทะเบียนกองทุนจริง →</a>
    </div>
</div>

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold">
            สวัสดี, <span class="gradient-text">ผู้ทดลองใช้งาน</span>
        </h2>
        <p class="text-sm text-gray-400 mt-1">กองทุนหมู่บ้านบ้านสวนสวรรค์ · {{ now()->locale('th')->translatedFormat('l j F Y') }}</p>
    </div>
    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300">🏦 กองทุนหมู่บ้านบ้านสวนสวรรค์</span>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    <div class="stat-card glass-card rounded-2xl p-5">
        <div class="flex items-start justify-between">
            <div><p class="text-sm text-gray-400">เงินสด</p><p class="text-2xl font-bold text-white mt-1">{{ number_format($cashBalance, 2) }}</p><p class="text-xs text-emerald-400 mt-1">↑ +5.2% จากเดือนก่อน</p></div>
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg></div>
        </div>
    </div>
    <div class="stat-card glass-card rounded-2xl p-5">
        <div class="flex items-start justify-between">
            <div><p class="text-sm text-gray-400">เงินฝากธนาคาร</p><p class="text-2xl font-bold text-white mt-1">{{ number_format($bankBalance, 2) }}</p><p class="text-xs text-emerald-400 mt-1">↑ +2.1% จากเดือนก่อน</p></div>
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg></div>
        </div>
    </div>
    <div class="stat-card glass-card rounded-2xl p-5">
        <div class="flex items-start justify-between">
            <div><p class="text-sm text-gray-400">สินเชื่อค้างชำระ</p><p class="text-2xl font-bold text-white mt-1">{{ number_format($outstandingLoans, 2) }}</p><p class="text-xs text-amber-400 mt-1">⊙ {{ $activeLoans }} สัญญา</p></div>
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
        </div>
    </div>
    <div class="stat-card glass-card rounded-2xl p-5">
        <div class="flex items-start justify-between">
            <div><p class="text-sm text-gray-400">จำนวนสมาชิก</p><p class="text-2xl font-bold text-white mt-1">{{ $memberCount }} <span class="text-base font-normal text-gray-400">คน</span></p><p class="text-xs text-emerald-400 mt-1">↑ +3 คนจากเดือนก่อน</p></div>
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg></div>
        </div>
    </div>
</div>

{{-- Overdue Alert --}}
@if($overdueCount > 0)
<div class="mb-6 glass-card rounded-2xl p-5 border-l-4 border-red-500">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center"><svg class="w-5 h-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg></div>
        <div><p class="text-sm font-semibold text-red-300">สินเชื่อค้างชำระเกินกำหนด</p><p class="text-xs text-gray-400">มี {{ $overdueCount }} สัญญาที่เลยกำหนดชำระ กรุณาติดตามการชำระเงินโดยเร็ว</p></div>
    </div>
</div>
@endif

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="glass-card rounded-2xl p-5">
        <h3 class="text-base font-semibold text-white mb-1">รายรับ-รายจ่ายรายเดือน</h3>
        <p class="text-xs text-gray-500 mb-4">ข้อมูลย้อนหลัง 6 เดือน (ข้อมูลตัวอย่าง)</p>
        <div style="height:250px"><canvas id="demoIncomeExpenseChart"></canvas></div>
    </div>
    <div class="glass-card rounded-2xl p-5">
        <h3 class="text-base font-semibold text-white mb-1">สัดส่วนสินเชื่อ</h3>
        <p class="text-xs text-gray-500 mb-4">แยกตามประเภทสินเชื่อ</p>
        <div style="height:250px"><canvas id="demoLoanDistChart"></canvas></div>
    </div>
</div>

{{-- Recent Transactions --}}
<div class="glass-card rounded-2xl overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-white/5"><h3 class="text-base font-semibold text-white">รายการล่าสุด</h3></div>
    <table class="w-full text-sm">
        <thead><tr class="border-b border-white/5 text-gray-400"><th class="px-5 py-3 text-left">วันที่</th><th class="px-5 py-3 text-left">ประเภท</th><th class="px-5 py-3 text-left">รายการ</th><th class="px-5 py-3 text-right">จำนวนเงิน</th><th class="px-5 py-3 text-left">สมาชิก</th></tr></thead>
        <tbody class="divide-y divide-white/5">
            @foreach($transactions as $tx)
            <tr class="hover:bg-white/[0.02]">
                <td class="px-5 py-3 text-gray-400 text-xs">{{ $tx['date'] }}</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 text-xs rounded-full {{ $tx['type'] === 'income' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">{{ $tx['type'] === 'income' ? 'รายรับ' : 'รายจ่าย' }}</span></td>
                <td class="px-5 py-3 text-gray-300">{{ $tx['category'] }}</td>
                <td class="px-5 py-3 text-right font-medium {{ $tx['type'] === 'income' ? 'text-emerald-400' : 'text-red-400' }}">{{ $tx['type'] === 'income' ? '+' : '-' }}{{ number_format($tx['amount'], 2) }}</td>
                <td class="px-5 py-3 text-gray-400">{{ $tx['member'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- CTA --}}
<div class="glass-card rounded-2xl p-8 text-center border border-indigo-500/20">
    <h3 class="text-xl font-bold text-white mb-2">พร้อมใช้งานจริง?</h3>
    <p class="text-gray-400 text-sm mb-4">ลงทะเบียนกองทุนของคุณวันนี้ ใช้งานฟรีไม่มีค่าใช้จ่าย</p>
    <a href="/register" class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/30 transition-all">+ ลงทะเบียนกองทุนใหม่</a>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Income/Expense Chart
    new Chart(document.getElementById('demoIncomeExpenseChart'), {
        type: 'bar',
        data: {
            labels: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.'],
            datasets: [
                { label: 'รายรับ', data: @json($incomeData), backgroundColor: 'rgba(99,102,241,0.7)', borderRadius: 6 },
                { label: 'รายจ่าย', data: @json($expenseData), backgroundColor: 'rgba(239,68,68,0.5)', borderRadius: 6 }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { labels: { color: '#9ca3af' }}}, scales: { x: { ticks: { color: '#6b7280' }, grid: { color: 'rgba(255,255,255,0.03)' }}, y: { ticks: { color: '#6b7280', callback: v => '฿'+v.toLocaleString() }, grid: { color: 'rgba(255,255,255,0.03)' }}}}
    });
    // Loan Distribution Chart
    new Chart(document.getElementById('demoLoanDistChart'), {
        type: 'doughnut',
        data: {
            labels: @json($loanCats),
            datasets: [{ data: @json($loanAmts), backgroundColor: ['rgba(99,102,241,0.8)','rgba(239,68,68,0.7)','rgba(139,92,246,0.7)','rgba(168,85,247,0.6)'], borderWidth: 0 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#9ca3af', padding: 16 }}}}
    });
});
</script>
@endpush
@endsection
