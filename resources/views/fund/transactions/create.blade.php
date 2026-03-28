@extends('layouts.app')

@section('page-title', 'บันทึกรายการ')

@section('content')
    <div x-data="{ tab: '{{ request('type', 'income') }}' }" class="max-w-3xl">

        {{-- Back link --}}
        <a href="{{ route('fund.transactions.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors" title="กลับไปรายการ">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            กลับไปรายการ
        </a>

        {{-- Tab toggle --}}
        <div class="flex bg-gray-900 border border-gray-800 rounded-xl p-1 mb-6">
            <button type="button" @click="tab = 'income'"
                    :class="tab === 'income' ? 'bg-green-600/20 text-green-400 border-green-600/30' : 'text-gray-400 hover:text-gray-200 border-transparent'"
                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium border transition-colors" title="บันทึกรายรับ">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                รายรับ
            </button>
            <button type="button" @click="tab = 'expense'"
                    :class="tab === 'expense' ? 'bg-red-600/20 text-red-400 border-red-600/30' : 'text-gray-400 hover:text-gray-200 border-transparent'"
                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium border transition-colors" title="บันทึกรายจ่าย">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
                รายจ่าย
            </button>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('fund.transactions.store') }}" class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            @csrf
            <input type="hidden" name="type" :value="tab">

            <x-form.select
                name="account_set_id"
                label="เลือกชุดบัญชี"
                :options="$accountSets ?? []"
                :required="true"
                tooltip="ชุดบัญชีที่จะบันทึกรายการนี้"
            />

            <x-form.select
                name="account_type"
                label="ลงบัญชี"
                :options="['cash' => 'เงินสด', 'bank' => 'เงินฝากธนาคาร']"
                :required="true"
                tooltip="เลือกว่ารายการนี้จะลงบัญชีเงินสดหรือเงินฝากธนาคาร"
            />

            {{-- Bank select (show when account_type is bank) --}}
            <div x-data="{ showBank: false }" x-init="$watch('$el.closest(\'form\').querySelector(\'[name=account_type]\').value', val => showBank = val === 'bank')">
                <div x-show="showBank" x-transition>
                    <x-form.select
                        name="bank_account_id"
                        label="เลือกธนาคาร"
                        :options="$bankAccounts ?? []"
                        tooltip="เลือกบัญชีธนาคาร"
                    />
                </div>
            </div>

            {{-- Income categories --}}
            <div x-show="tab === 'income'" x-transition>
                <x-form.select
                    name="income_category_id"
                    label="ประเภทรายรับ"
                    :options="$incomeCategories ?? []"
                    :required="true"
                    tooltip="เลือกหมวดหมู่รายรับ"
                />
            </div>

            {{-- Expense categories --}}
            <div x-show="tab === 'expense'" x-transition>
                <x-form.select
                    name="expense_category_id"
                    label="ประเภทรายจ่าย"
                    :options="$expenseCategories ?? []"
                    :required="true"
                    tooltip="เลือกหมวดหมู่รายจ่าย"
                />
            </div>

            <x-form.input
                name="date"
                label="วันที่"
                type="text"
                :required="true"
                placeholder="วว/ดด/ปปปป"
                tooltip="วันที่ทำรายการ"
            />

            <x-form.input
                name="amount"
                label="จำนวนเงิน (บาท)"
                type="number"
                :required="true"
                placeholder="0.00"
                tooltip="จำนวนเงินของรายการนี้"
            />

            <x-form.textarea
                name="description"
                label="รายละเอียด"
                :required="true"
                placeholder="อธิบายรายละเอียดของรายการ"
            />

            {{-- Person involved --}}
            <x-form.select
                name="person_type"
                label="รับเงินจาก / จ่ายเงินให้"
                :options="['member' => 'สมาชิก', 'non_member' => 'ไม่เป็นสมาชิก', 'other' => 'อื่นๆ']"
                tooltip="ระบุว่ารับเงินจากใครหรือจ่ายให้ใคร"
            />

            <x-form.input
                name="person_name"
                label="ชื่อบุคคล"
                placeholder="กรอกชื่อ หรือเลือกจากรายชื่อสมาชิก"
                tooltip="ชื่อผู้ที่เกี่ยวข้องกับรายการนี้"
            />

            {{-- Favorite checkbox --}}
            <label class="flex items-center gap-2 cursor-pointer" title="บันทึกเป็นรายการที่ใช้บ่อย">
                <input type="checkbox" name="is_favorite" class="w-4 h-4 rounded bg-gray-800 border-gray-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-0">
                <span class="text-sm text-gray-400">บันทึกเป็นรายการที่ใช้บ่อย</span>
            </label>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" name="action" value="save" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25" title="บันทึกรายการ">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    บันทึก
                </button>
                <button type="submit" name="action" value="save_and_new" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="บันทึกและเพิ่มรายการต่อไป">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    บันทึกและเพิ่มรายการต่อไป
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    if (dateInput) {
        flatpickr(dateInput, {
            dateFormat: 'd/m/Y',
            defaultDate: 'today',
            allowInput: true,
        });
    }
});
</script>
@endpush
