@extends('layouts.app')

@section('page-title', 'ข้อมูลสมาชิก')

@section('content')
    @php
        $statusLabels = [
            'active' => ['label' => 'ปกติ', 'color' => 'green'],
            'inactive' => ['label' => 'ไม่ใช้งาน', 'color' => 'gray'],
            'suspended' => ['label' => 'ระงับชั่วคราว', 'color' => 'yellow'],
            'resigned' => ['label' => 'ลาออก', 'color' => 'red'],
        ];
        $st = $statusLabels[$member->status->value ?? $member->status] ?? $statusLabels['active'];

        // Decrypt national ID (masked)
        $maskedNid = '-';
        if ($member->national_id_encrypted) {
            try {
                $nid = decrypt($member->national_id_encrypted);
                $maskedNid = substr($nid, 0, 1) . '-' . substr($nid, 1, 4) . '-XXX' . 'XX-XX-' . substr($nid, -1);
            } catch (\Exception $e) {
                $maskedNid = 'ไม่สามารถถอดรหัสได้';
            }
        }
    @endphp

    {{-- Back link --}}
    <a href="{{ route('fund.members.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors" title="กลับไปรายชื่อสมาชิก">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
        กลับไปรายชื่อสมาชิก
    </a>

    <div class="max-w-4xl space-y-6">

        {{-- Profile header card --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                {{-- Photo --}}
                @if ($member->photo_path)
                    <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->first_name }}" class="w-24 h-24 rounded-full object-cover border-2 border-primary-500/50 shrink-0">
                @else
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary-600/30 to-primary-400/10 border-2 border-primary-500/30 flex items-center justify-center shrink-0">
                        <span class="text-3xl font-bold text-primary-400">{{ mb_substr($member->first_name, 0, 1) }}</span>
                    </div>
                @endif

                {{-- Name & meta --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <h2 class="text-xl font-bold text-white">{{ $member->title }} {{ $member->first_name }} {{ $member->last_name }}</h2>
                        <x-badge :color="$st['color']" :label="$st['label']" />
                    </div>
                    <p class="text-sm text-gray-400 mt-1 font-mono">{{ $member->member_code }}</p>
                    <p class="text-sm text-gray-500 mt-1">สมาชิกตั้งแต่ {{ $member->joined_date?->format('d/m/Y') ?? '-' }}</p>
                </div>

                {{-- Edit button --}}
                <a href="{{ route('fund.members.edit', $member->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors shrink-0" title="แก้ไขข้อมูลสมาชิก">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                    แก้ไข
                </a>
            </div>
        </div>

        {{-- Info grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Personal info card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">ข้อมูลส่วนตัว</h3>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs text-gray-500">เลขบัตรประชาชน</dt>
                        <dd class="text-sm text-gray-200 mt-0.5 font-mono">{{ $maskedNid }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">เบอร์โทรศัพท์</dt>
                        <dd class="text-sm text-gray-200 mt-0.5">{{ $member->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">วันเกิด</dt>
                        <dd class="text-sm text-gray-200 mt-0.5">{{ $member->birth_date?->format('d/m/Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">อาชีพ</dt>
                        <dd class="text-sm text-gray-200 mt-0.5">{{ $member->occupation ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500">ที่อยู่</dt>
                        <dd class="text-sm text-gray-200 mt-0.5 leading-relaxed">{{ $member->address ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Financial summary card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">สรุปข้อมูลทางการเงิน</h3>
                <div class="space-y-4">
                    {{-- Loans --}}
                    <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-600/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">สินเชื่อคงค้าง</p>
                                <p class="text-sm font-semibold text-white">{{ number_format($member->loans()->where('status', 'active')->sum('outstanding_balance'), 2) }} บาท</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $member->loans()->where('status', 'active')->count() }} รายการ</span>
                    </div>

                    {{-- Savings --}}
                    <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-600/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">ยอดเงินฝาก</p>
                                <p class="text-sm font-semibold text-white">{{ number_format($member->savingsAccounts()->sum('balance'), 2) }} บาท</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $member->savingsAccounts()->count() }} บัญชี</span>
                    </div>

                    {{-- Shares --}}
                    <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-purple-600/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">ยอดหุ้นสะสม</p>
                                <p class="text-sm font-semibold text-white">{{ number_format($member->shares()->sum('amount'), 2) }} บาท</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $member->shares()->count() }} รายการ</span>
                    </div>

                    {{-- Membership fee --}}
                    <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-orange-600/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">ค่าธรรมเนียมชำระแล้ว</p>
                                <p class="text-sm font-semibold text-white">{{ number_format($member->membership_fee_paid, 2) }} บาท</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
