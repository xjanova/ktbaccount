@extends('layouts.app')
@section('page-title', 'หุ้น')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">ยอดถือครองหุ้น</h2>
            <p class="text-sm text-gray-400 mt-1">จัดการหุ้นของสมาชิก (ราคาหุ้นละ ฿{{ number_format(config('ktbaccount.share.default_price', 10), 2) }})</p>
        </div>
    </div>

    <div class="bg-white/[0.03] backdrop-blur border border-white/10 rounded-2xl overflow-hidden">
        @if($shares->isEmpty())
            <div class="p-12 text-center">
                <div class="text-4xl mb-4">📈</div>
                <p class="text-gray-400">ยังไม่มีข้อมูลหุ้น</p>
                <p class="text-gray-500 text-sm mt-1">เพิ่มรายการซื้อหุ้นให้สมาชิกเพื่อเริ่มจัดการ</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead><tr class="border-b border-white/5 text-gray-400">
                    <th class="px-5 py-3 text-left">สมาชิก</th>
                    <th class="px-5 py-3 text-right">จำนวนหุ้น</th>
                    <th class="px-5 py-3 text-right">มูลค่ารวม</th>
                    <th class="px-5 py-3 text-center">ราคา/หุ้น</th>
                </tr></thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($shares as $share)
                    <tr class="hover:bg-white/[0.02]">
                        <td class="px-5 py-3 text-white">{{ $share->member->first_name ?? '' }} {{ $share->member->last_name ?? '' }}</td>
                        <td class="px-5 py-3 text-right text-white font-medium">{{ number_format($share->total_shares) }} หุ้น</td>
                        <td class="px-5 py-3 text-right text-emerald-400 font-medium">฿{{ number_format($share->total_value, 2) }}</td>
                        <td class="px-5 py-3 text-center text-gray-300">฿{{ number_format($share->share_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">{{ $shares->links() }}</div>
        @endif
    </div>
</div>
@endsection
