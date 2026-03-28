@extends('layouts.admin')

@section('page-title', 'กองทุนทั้งหมด')

@section('content')
@php
    $funds = [
        ['name' => 'กองทุนหมู่บ้านบ้านสวนสวรรค์', 'code' => 'VF-001', 'province' => 'เชียงใหม่', 'members' => 127, 'loans' => 1500000, 'status' => 'active', 'registered' => '15 ม.ค. 2569'],
        ['name' => 'กองทุนหมู่บ้านบ้านนาทราย', 'code' => 'VF-002', 'province' => 'ขอนแก่น', 'members' => 98, 'loans' => 1200000, 'status' => 'active', 'registered' => '22 ก.พ. 2569'],
        ['name' => 'กองทุนหมู่บ้านบ้านท่าเรือ', 'code' => 'VF-003', 'province' => 'สุราษฎร์ธานี', 'members' => 122, 'loans' => 1550000, 'status' => 'active', 'registered' => '10 มี.ค. 2569'],
    ];
@endphp

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">กองทุนทั้งหมด</h2>
            <p class="text-sm text-gray-400 mt-1">จัดการกองทุนหมู่บ้านที่ลงทะเบียนในระบบ</p>
        </div>
        <span class="px-3 py-1 bg-indigo-600/20 text-indigo-300 text-sm rounded-full border border-indigo-500/30">{{ count($funds) }} กองทุน</span>
    </div>

    <div class="bg-white/[0.03] backdrop-blur border border-white/10 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5 text-gray-400">
                    <th class="px-6 py-4 text-left font-medium">#</th>
                    <th class="px-6 py-4 text-left font-medium">ชื่อกองทุน</th>
                    <th class="px-6 py-4 text-left font-medium">รหัส</th>
                    <th class="px-6 py-4 text-left font-medium">จังหวัด</th>
                    <th class="px-6 py-4 text-center font-medium">สมาชิก</th>
                    <th class="px-6 py-4 text-right font-medium">สินเชื่อรวม</th>
                    <th class="px-6 py-4 text-center font-medium">สถานะ</th>
                    <th class="px-6 py-4 text-right font-medium">ลงทะเบียน</th>
                    <th class="px-6 py-4 text-center font-medium">จัดการ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($funds as $i => $fund)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-white">{{ $fund['name'] }}</td>
                    <td class="px-6 py-4 text-indigo-400 font-mono text-xs">{{ $fund['code'] }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $fund['province'] }}</td>
                    <td class="px-6 py-4 text-center text-gray-300">{{ $fund['members'] }} คน</td>
                    <td class="px-6 py-4 text-right text-white font-medium">฿{{ number_format($fund['loans']) }}</td>
                    <td class="px-6 py-4 text-center"><span class="px-2.5 py-1 bg-emerald-500/20 text-emerald-400 text-xs rounded-full border border-emerald-500/30">ใช้งาน</span></td>
                    <td class="px-6 py-4 text-right text-gray-400 text-xs">{{ $fund['registered'] }}</td>
                    <td class="px-6 py-4 text-center">
                        <form method="POST" action="{{ route('admin.impersonate.fund', $i + 1) }}">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition-colors" title="เข้าจัดการกองทุนนี้">
                                🔑 เข้าจัดการ
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
