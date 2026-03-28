@extends('layouts.guest')

@section('content')
    <div x-data="{ step: 1 }">
        {{-- Step indicator --}}
        <div class="flex items-center justify-center gap-2 mb-8">
            <template x-for="s in 3" :key="s">
                <div class="flex items-center">
                    <div :class="step >= s ? 'bg-primary-600 text-white' : 'bg-gray-700 text-gray-400'"
                         class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-colors">
                        <span x-text="s"></span>
                    </div>
                    <template x-if="s < 3">
                        <div :class="step > s ? 'bg-primary-600' : 'bg-gray-700'"
                             class="w-8 h-0.5 transition-colors"></div>
                    </template>
                </div>
            </template>
        </div>

        {{-- Step labels --}}
        <div class="flex justify-between text-xs text-gray-400 mb-6 px-2">
            <span :class="step >= 1 && 'text-primary-400'">ข้อมูลผู้ดูแล</span>
            <span :class="step >= 2 && 'text-primary-400'">ข้อมูลกองทุน</span>
            <span :class="step >= 3 && 'text-primary-400'">ยืนยัน PDPA</span>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Step 1: ข้อมูลผู้ดูแล --}}
            <div x-show="step === 1" x-transition>
                <h2 class="text-lg font-bold text-white mb-4">ข้อมูลผู้ดูแลระบบ</h2>

                <div class="space-y-4">
                    <x-form.input
                        name="name"
                        label="ชื่อ-นามสกุล"
                        :required="true"
                        placeholder="กรอกชื่อ-นามสกุล"
                        tooltip="ชื่อจริง-นามสกุลของผู้ดูแลกองทุน"
                    />
                    <x-form.input
                        name="email"
                        label="อีเมล"
                        type="email"
                        :required="true"
                        placeholder="example@email.com"
                        tooltip="อีเมลสำหรับเข้าสู่ระบบ"
                    />
                    <x-form.input
                        name="phone"
                        label="เบอร์โทรศัพท์"
                        type="tel"
                        :required="true"
                        placeholder="08X-XXX-XXXX"
                        tooltip="เบอร์โทรศัพท์มือถือสำหรับติดต่อ"
                    />
                    <x-form.input
                        name="password"
                        label="รหัสผ่าน"
                        type="password"
                        :required="true"
                        placeholder="อย่างน้อย 8 ตัวอักษร"
                        tooltip="รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร"
                    />
                    <x-form.input
                        name="password_confirmation"
                        label="ยืนยันรหัสผ่าน"
                        type="password"
                        :required="true"
                        placeholder="กรอกรหัสผ่านอีกครั้ง"
                    />
                </div>

                <button type="button" @click="step = 2" class="w-full mt-6 flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-xl transition-colors" title="ถัดไป">
                    ถัดไป
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </button>
            </div>

            {{-- Step 2: ข้อมูลกองทุน --}}
            <div x-show="step === 2" x-transition>
                <h2 class="text-lg font-bold text-white mb-4">ข้อมูลกองทุน</h2>

                <div class="space-y-4">
                    <x-form.input
                        name="fund_name"
                        label="ชื่อกองทุน"
                        :required="true"
                        placeholder="เช่น กองทุนหมู่บ้าน XXX"
                        tooltip="ชื่อเต็มของกองทุนหมู่บ้าน"
                    />
                    <x-form.input
                        name="fund_registration_number"
                        label="เลขทะเบียนกองทุน"
                        placeholder="เลขทะเบียนจากสำนักงาน"
                        tooltip="เลขทะเบียนที่ได้รับจากสำนักงานกองทุนหมู่บ้าน"
                    />
                    <x-form.select
                        name="fund_province"
                        label="จังหวัด"
                        :required="true"
                        :options="[]"
                        tooltip="จังหวัดที่ตั้งกองทุน"
                    />
                    <x-form.select
                        name="fund_district"
                        label="อำเภอ/เขต"
                        :required="true"
                        :options="[]"
                        tooltip="อำเภอหรือเขตที่ตั้งกองทุน"
                    />
                    <x-form.input
                        name="fund_village"
                        label="หมู่บ้าน/ชุมชน"
                        :required="true"
                        placeholder="ชื่อหมู่บ้านหรือชุมชน"
                    />
                    <x-form.input
                        name="fund_established_date"
                        label="วันที่จัดตั้ง"
                        type="text"
                        placeholder="วว/ดด/ปปปป"
                        tooltip="วันที่จัดตั้งกองทุน"
                    />
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" @click="step = 1" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="ย้อนกลับ">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                        ย้อนกลับ
                    </button>
                    <button type="button" @click="step = 3" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-xl transition-colors" title="ถัดไป">
                        ถัดไป
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </button>
                </div>
            </div>

            {{-- Step 3: ยืนยัน PDPA --}}
            <div x-show="step === 3" x-transition>
                <h2 class="text-lg font-bold text-white mb-4">ข้อกำหนดและนโยบายความเป็นส่วนตัว</h2>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 mb-4 max-h-48 overflow-y-auto text-sm text-gray-300 leading-relaxed">
                    <p class="font-semibold text-white mb-2">นโยบายความเป็นส่วนตัว (PDPA)</p>
                    <p class="mb-2">ระบบบริหารกองทุนหมู่บ้าน โดย XMAN Studio เก็บรวบรวม ใช้ และเปิดเผยข้อมูลส่วนบุคคลของท่านตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562</p>
                    <p class="mb-2">ข้อมูลที่เก็บรวบรวม: ชื่อ-นามสกุล, อีเมล, เบอร์โทรศัพท์, ข้อมูลกองทุน, ข้อมูลทางบัญชี</p>
                    <p class="mb-2">วัตถุประสงค์: เพื่อให้บริการระบบบริหารกองทุนหมู่บ้าน จัดทำรายงาน และปฏิบัติตามกฎหมาย</p>
                    <p>ท่านสามารถขอเข้าถึง แก้ไข หรือลบข้อมูลส่วนบุคคลของท่านได้ตลอดเวลา</p>
                </div>

                <label class="flex items-start gap-3 cursor-pointer mb-6">
                    <input type="checkbox" name="pdpa_consent" required class="mt-0.5 w-5 h-5 rounded bg-gray-800 border-gray-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-0">
                    <span class="text-sm text-gray-300">
                        ข้าพเจ้ายินยอมให้เก็บรวบรวม ใช้ และเปิดเผยข้อมูลส่วนบุคคลตาม
                        <a href="#" class="text-primary-400 hover:text-primary-300 underline">นโยบายความเป็นส่วนตัว</a>
                        และ
                        <a href="#" class="text-primary-400 hover:text-primary-300 underline">ข้อกำหนดการใช้งาน</a>
                    </span>
                </label>

                <div class="flex gap-3">
                    <button type="button" @click="step = 2" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="ย้อนกลับ">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                        ย้อนกลับ
                    </button>
                    <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25" title="ลงทะเบียน">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        ลงทะเบียน
                    </button>
                </div>
            </div>
        </form>

        {{-- Login link --}}
        <p class="text-center text-sm text-gray-400 mt-6">
            มีบัญชีอยู่แล้ว?
            <a href="{{ route('login') }}" class="text-primary-400 hover:text-primary-300 font-medium transition-colors">เข้าสู่ระบบ</a>
        </p>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('fund_established_date');
        if (dateInput) {
            flatpickr(dateInput, {
                dateFormat: 'd/m/Y',
                allowInput: true,
            });
        }
    });
</script>
@endpush
