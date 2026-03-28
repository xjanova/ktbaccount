@extends('layouts.admin')

@section('page-title', 'ผู้ใช้ระบบ')

@section('content')
@php
    $users = [
        ['name' => auth()->user()->name ?? 'Admin', 'email' => auth()->user()->email ?? 'admin@xman4289.com', 'role' => 'Super Admin', 'fund' => 'ทุกกองทุน', 'status' => 'active', 'last_login' => 'ตอนนี้'],
    ];
@endphp

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">ผู้ใช้ระบบ</h2>
            <p class="text-sm text-gray-400 mt-1">จัดการผู้ใช้งานทั้งหมดในระบบ</p>
        </div>
        <span class="px-3 py-1 bg-indigo-600/20 text-indigo-300 text-sm rounded-full border border-indigo-500/30">{{ count($users) }} ผู้ใช้</span>
    </div>

    <div class="bg-white/[0.03] backdrop-blur border border-white/10 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5 text-gray-400">
                    <th class="px-6 py-4 text-left font-medium">#</th>
                    <th class="px-6 py-4 text-left font-medium">ชื่อ</th>
                    <th class="px-6 py-4 text-left font-medium">อีเมล</th>
                    <th class="px-6 py-4 text-left font-medium">สิทธิ์</th>
                    <th class="px-6 py-4 text-left font-medium">กองทุน</th>
                    <th class="px-6 py-4 text-center font-medium">สถานะ</th>
                    <th class="px-6 py-4 text-right font-medium">เข้าสู่ระบบล่าสุด</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($users as $i => $user)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-white">{{ $user['name'] }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $user['email'] }}</td>
                    <td class="px-6 py-4"><span class="px-2.5 py-1 bg-red-500/20 text-red-400 text-xs rounded-full border border-red-500/30">{{ $user['role'] }}</span></td>
                    <td class="px-6 py-4 text-gray-300">{{ $user['fund'] }}</td>
                    <td class="px-6 py-4 text-center"><span class="px-2.5 py-1 bg-emerald-500/20 text-emerald-400 text-xs rounded-full border border-emerald-500/30">ใช้งาน</span></td>
                    <td class="px-6 py-4 text-right text-gray-400 text-xs">{{ $user['last_login'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
