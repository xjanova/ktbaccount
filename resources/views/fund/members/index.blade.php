@extends('layouts.app')

@section('page-title', 'รายชื่อสมาชิก')

@section('content')
    @php
        $isDemo = request()->is('demo*');
        $rp = $isDemo ? 'demo' : 'fund';

        // Demo data when no real members
        $demoMembers = [
            ['code' => 'M-001', 'name' => 'นายสมชาย ใจดี', 'phone' => '089-111-1111', 'joined' => '15/01/2565', 'status' => 'active'],
            ['code' => 'M-002', 'name' => 'นางสมศรี รักดี', 'phone' => '089-222-2222', 'joined' => '15/01/2565', 'status' => 'active'],
            ['code' => 'M-003', 'name' => 'นายประสิทธิ์ มั่นคง', 'phone' => '089-333-3333', 'joined' => '20/02/2565', 'status' => 'active'],
            ['code' => 'M-004', 'name' => 'นางสาวมาลี สุขสม', 'phone' => '089-444-4444', 'joined' => '01/03/2565', 'status' => 'active'],
            ['code' => 'M-005', 'name' => 'นายวิชัย พัฒนา', 'phone' => '089-555-5555', 'joined' => '15/03/2565', 'status' => 'active'],
            ['code' => 'M-006', 'name' => 'นางบุญมี ทรัพย์มาก', 'phone' => '089-666-6666', 'joined' => '01/04/2565', 'status' => 'inactive'],
            ['code' => 'M-007', 'name' => 'นายสุรชัย เก่งกาจ', 'phone' => '089-777-7777', 'joined' => '20/04/2565', 'status' => 'active'],
            ['code' => 'M-008', 'name' => 'นางสาวจันทร์เพ็ญ ศรีสมร', 'phone' => '089-888-8888', 'joined' => '01/05/2565', 'status' => 'active'],
        ];

        $hasRealData = isset($members) && ($members instanceof \Illuminate\Pagination\LengthAwarePaginator ? $members->total() > 0 : $members->count() > 0);
        $statusLabels = [
            'active' => ['label' => 'ปกติ', 'color' => 'green'],
            'inactive' => ['label' => 'ไม่ใช้งาน', 'color' => 'gray'],
            'suspended' => ['label' => 'ระงับชั่วคราว', 'color' => 'yellow'],
            'resigned' => ['label' => 'ลาออก', 'color' => 'red'],
        ];
    @endphp

    {{-- Search & Filter bar --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6">
        <form method="GET" action="{{ route($rp . '.members.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">ค้นหาสมาชิก</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="ค้นหาชื่อ นามสกุล รหัส หรือเบอร์โทร..."
                       class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ค้นหา">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    ค้นหา
                </button>
                <a href="{{ route($rp . '.members.index') }}" class="px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ล้างตัวกรอง">ล้าง</a>
            </div>
        </form>
    </div>

    {{-- Members table --}}
    <x-data-table title="รายชื่อสมาชิก" :createUrl="$isDemo ? null : route('fund.members.create')" createLabel="เพิ่มสมาชิก">
        <x-slot:header>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">#</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">รูป</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">รหัส</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">ชื่อ-นามสกุล</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">โทร</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase">วันที่เข้าร่วม</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">สถานะ</th>
            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-400 uppercase">จัดการ</th>
        </x-slot:header>

        @if ($hasRealData)
            {{-- Real data from database --}}
            @foreach ($members as $index => $member)
                <tr class="hover:bg-gray-800/50 transition-colors">
                    <td class="px-4 py-3 text-sm text-gray-400">{{ $members->firstItem() + $index }}</td>
                    <td class="px-4 py-3">
                        @if ($member->photo_path)
                            <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->first_name }}" class="w-10 h-10 rounded-full object-cover border border-gray-700">
                        @else
                            <div class="w-10 h-10 rounded-full bg-primary-600/20 flex items-center justify-center text-primary-400 font-bold text-sm border border-primary-600/30">
                                {{ mb_substr($member->first_name, 0, 1) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-300 font-mono">{{ $member->member_code }}</td>
                    <td class="px-4 py-3 text-sm text-gray-100 font-medium">{{ $member->title }} {{ $member->first_name }} {{ $member->last_name }}</td>
                    <td class="px-4 py-3 text-sm text-gray-300">{{ $member->phone ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-300">{{ $member->joined_date?->format('d/m/Y') ?? '-' }}</td>
                    <td class="px-4 py-3 text-center">
                        @php $st = $statusLabels[$member->status->value ?? $member->status] ?? $statusLabels['active']; @endphp
                        <x-badge :color="$st['color']" :label="$st['label']" />
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-1">
                            <a href="{{ route('fund.members.show', $member->id) }}" class="p-1.5 rounded-lg text-gray-400 hover:text-primary-400 hover:bg-gray-800 transition-colors" title="ดูรายละเอียด">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                            </a>
                            <a href="{{ route('fund.members.edit', $member->id) }}" class="p-1.5 rounded-lg text-gray-400 hover:text-yellow-400 hover:bg-gray-800 transition-colors" title="แก้ไข">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            {{-- Demo data or empty state --}}
            @foreach ($demoMembers as $index => $dm)
                <tr class="hover:bg-gray-800/50 transition-colors">
                    <td class="px-4 py-3 text-sm text-gray-400">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">
                        <div class="w-10 h-10 rounded-full bg-primary-600/20 flex items-center justify-center text-primary-400 font-bold text-sm border border-primary-600/30">
                            {{ mb_substr($dm['name'], 3, 1) }}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-300 font-mono">{{ $dm['code'] }}</td>
                    <td class="px-4 py-3 text-sm text-gray-100 font-medium">{{ $dm['name'] }}</td>
                    <td class="px-4 py-3 text-sm text-gray-300">{{ $dm['phone'] }}</td>
                    <td class="px-4 py-3 text-sm text-gray-300">{{ $dm['joined'] }}</td>
                    <td class="px-4 py-3 text-center">
                        @php $st = $statusLabels[$dm['status']] ?? $statusLabels['active']; @endphp
                        <x-badge :color="$st['color']" :label="$st['label']" />
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-1">
                            <button class="p-1.5 rounded-lg text-gray-400 hover:text-primary-400 hover:bg-gray-800 transition-colors" title="ดูรายละเอียด (Demo)">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                            </button>
                            <button class="p-1.5 rounded-lg text-gray-400 hover:text-yellow-400 hover:bg-gray-800 transition-colors" title="แก้ไข (Demo)">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </x-data-table>

    {{-- Pagination --}}
    @if ($hasRealData && $members->hasPages())
        <div class="mt-6">
            {{ $members->withQueryString()->links() }}
        </div>
    @endif

    {{-- Demo notice --}}
    @if (! $hasRealData)
        <div class="mt-4 text-center">
            <p class="text-xs text-gray-500">แสดงข้อมูลตัวอย่าง (Demo) - ข้อมูลจริงจะแสดงเมื่อมีการเพิ่มสมาชิกในระบบ</p>
        </div>
    @endif
@endsection
