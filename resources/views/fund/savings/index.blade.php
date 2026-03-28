@extends('layouts.app')
@section('page-title', 'เงินฝาก')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">บัญชีเงินฝาก</h2>
            <p class="text-sm text-gray-400 mt-1">จัดการบัญชีเงินฝากของสมาชิก</p>
        </div>
        <a href="{{ route('fund.deposits.index') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors">+ เปิดบัญชีใหม่</a>
    </div>

    <div class="bg-white/[0.03] backdrop-blur border border-white/10 rounded-2xl overflow-hidden">
        @if($accounts->isEmpty())
            <div class="p-12 text-center">
                <div class="text-4xl mb-4">💵</div>
                <p class="text-gray-400">ยังไม่มีบัญชีเงินฝาก</p>
                <p class="text-gray-500 text-sm mt-1">เปิดบัญชีเงินฝากให้สมาชิกเพื่อเริ่มรับฝากเงิน</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead><tr class="border-b border-white/5 text-gray-400">
                    <th class="px-5 py-3 text-left">เลขบัญชี</th>
                    <th class="px-5 py-3 text-left">สมาชิก</th>
                    <th class="px-5 py-3 text-right">ยอดคงเหลือ</th>
                    <th class="px-5 py-3 text-center">ดอกเบี้ย</th>
                    <th class="px-5 py-3 text-center">สถานะ</th>
                </tr></thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($accounts as $account)
                    <tr class="hover:bg-white/[0.02]">
                        <td class="px-5 py-3 font-mono text-indigo-400">{{ $account->account_number }}</td>
                        <td class="px-5 py-3 text-white">{{ $account->member->first_name ?? '' }} {{ $account->member->last_name ?? '' }}</td>
                        <td class="px-5 py-3 text-right font-medium text-white">฿{{ number_format($account->balance, 2) }}</td>
                        <td class="px-5 py-3 text-center text-gray-300">{{ $account->interest_rate }}%</td>
                        <td class="px-5 py-3 text-center"><span class="px-2 py-0.5 text-xs rounded-full bg-emerald-500/20 text-emerald-400">{{ $account->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">{{ $accounts->links() }}</div>
        @endif
    </div>
</div>
@endsection
