@extends('layouts.app')

@section('page-title', 'สร้างสัญญาสินเชื่อ')

@section('content')
    <div class="max-w-3xl">

        {{-- Back link --}}
        <a href="{{ route('fund.loans.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors" title="กลับไปรายการสินเชื่อ">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            กลับไปรายการสินเชื่อ
        </a>

        {{-- Form --}}
        <form method="POST" action="{{ route('fund.loans.store') }}" class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            @csrf

            {{-- Member select --}}
            <x-form.select
                name="member_id"
                label="สมาชิกผู้กู้"
                :options="($members ?? collect())->mapWithKeys(fn ($m) => [$m->id => $m->member_no . ' - ' . $m->full_name])->toArray()"
                :required="true"
                placeholder="-- เลือกสมาชิก --"
                tooltip="เลือกสมาชิกที่ต้องการสร้างสัญญาสินเชื่อ"
            />

            {{-- Account set --}}
            <x-form.select
                name="account_set_id"
                label="ชุดบัญชี"
                :options="$accountSets ?? []"
                :required="true"
                tooltip="ชุดบัญชีที่จะบันทึกรายการสินเชื่อ"
            />

            {{-- Principal --}}
            <x-form.input
                name="principal"
                label="จำนวนเงินกู้ (บาท)"
                type="number"
                :required="true"
                placeholder="0.00"
                tooltip="จำนวนเงินต้นที่ต้องการกู้"
            />

            {{-- Interest rate --}}
            <x-form.input
                name="interest_rate"
                label="อัตราดอกเบี้ย (% ต่อปี)"
                type="number"
                :required="true"
                placeholder="12"
                tooltip="อัตราดอกเบี้ยต่อปี เช่น 12 หมายถึง 12% ต่อปี"
            />

            {{-- Term months --}}
            <x-form.input
                name="term_months"
                label="จำนวนงวด (เดือน)"
                type="number"
                :required="true"
                placeholder="12"
                tooltip="จำนวนงวดผ่อนชำระ (เดือน)"
            />

            {{-- Guarantor 1 --}}
            <x-form.select
                name="guarantor_1_id"
                label="ผู้ค้ำประกัน คนที่ 1"
                :options="($members ?? collect())->mapWithKeys(fn ($m) => [$m->id => $m->member_no . ' - ' . $m->full_name])->toArray()"
                placeholder="-- เลือกผู้ค้ำประกัน (ถ้ามี) --"
                tooltip="เลือกสมาชิกที่เป็นผู้ค้ำประกัน"
            />

            {{-- Guarantor 2 --}}
            <x-form.select
                name="guarantor_2_id"
                label="ผู้ค้ำประกัน คนที่ 2"
                :options="($members ?? collect())->mapWithKeys(fn ($m) => [$m->id => $m->member_no . ' - ' . $m->full_name])->toArray()"
                placeholder="-- เลือกผู้ค้ำประกัน (ถ้ามี) --"
                tooltip="เลือกสมาชิกที่เป็นผู้ค้ำประกันคนที่สอง"
            />

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25" title="บันทึกสัญญาสินเชื่อ">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    บันทึก
                </button>
                <a href="{{ route('fund.loans.index') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="ยกเลิก">
                    ยกเลิก
                </a>
            </div>
        </form>
    </div>
@endsection
