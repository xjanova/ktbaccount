@extends('layouts.app')

@section('page-title', 'เพิ่มสมาชิกใหม่')

@section('content')
    <div class="max-w-3xl" x-data="memberForm()">

        {{-- Back link --}}
        <a href="{{ route('fund.members.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors" title="กลับไปรายชื่อสมาชิก">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            กลับไปรายชื่อสมาชิก
        </a>

        {{-- Form --}}
        <form method="POST" action="{{ route('fund.members.store') }}" enctype="multipart/form-data" class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            @csrf

            {{-- Photo upload with preview --}}
            <div>
                <label class="text-sm font-medium text-gray-300 mb-1.5 block">รูปถ่ายสมาชิก</label>
                <div class="flex items-center gap-4">
                    {{-- Preview --}}
                    <div class="shrink-0">
                        <template x-if="photoPreview">
                            <img :src="photoPreview" class="w-20 h-20 rounded-full object-cover border-2 border-primary-500/50">
                        </template>
                        <template x-if="!photoPreview">
                            <div class="w-20 h-20 rounded-full bg-gray-800 border-2 border-dashed border-gray-600 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                            </div>
                        </template>
                    </div>
                    <div class="flex-1">
                        <label class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 border border-gray-700 rounded-xl text-sm text-gray-300 hover:bg-gray-700 cursor-pointer transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" /></svg>
                            เลือกรูปภาพ
                            <input type="file" name="photo" accept="image/*" class="hidden" @change="previewPhoto($event)">
                        </label>
                        <p class="text-xs text-gray-500 mt-1">รองรับ JPG, PNG, WEBP (ไม่เกิน 5MB)</p>
                    </div>
                </div>
                @error('photo')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name row --}}
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <x-form.select
                    name="title"
                    label="คำนำหน้า"
                    :options="['นาย' => 'นาย', 'นาง' => 'นาง', 'นางสาว' => 'นางสาว']"
                    placeholder="-- เลือก --"
                />
                <div class="sm:col-span-1">
                    <x-form.input
                        name="first_name"
                        label="ชื่อ"
                        :required="true"
                        placeholder="กรอกชื่อ"
                    />
                </div>
                <div class="sm:col-span-2">
                    <x-form.input
                        name="last_name"
                        label="นามสกุล"
                        :required="true"
                        placeholder="กรอกนามสกุล"
                    />
                </div>
            </div>

            {{-- National ID --}}
            <x-form.input
                name="national_id"
                label="เลขบัตรประชาชน"
                placeholder="X-XXXX-XXXXX-XX-X (13 หลัก)"
                tooltip="ข้อมูลจะถูกเข้ารหัสตาม PDPA"
            />

            {{-- Phone & Birth date --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form.input
                    name="phone"
                    label="เบอร์โทรศัพท์"
                    placeholder="0XX-XXX-XXXX"
                />
                <x-form.input
                    name="birth_date"
                    label="วันเกิด"
                    type="date"
                    placeholder="เลือกวันเกิด"
                />
            </div>

            {{-- Address --}}
            <x-form.textarea
                name="address"
                label="ที่อยู่"
                :rows="3"
                placeholder="กรอกที่อยู่ (บ้านเลขที่ หมู่ ซอย ถนน ตำบล อำเภอ จังหวัด รหัสไปรษณีย์)"
            />

            {{-- Occupation --}}
            <x-form.input
                name="occupation"
                label="อาชีพ"
                placeholder="กรอกอาชีพ"
            />

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25" title="บันทึกข้อมูลสมาชิก">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    บันทึก
                </button>
                <a href="{{ route('fund.members.index') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="ยกเลิกและกลับไปรายชื่อ">
                    ยกเลิก
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
function memberForm() {
    return {
        photoPreview: null,
        previewPhoto(event) {
            const file = event.target.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) {
                alert('รูปภาพต้องไม่เกิน 5MB');
                event.target.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => { this.photoPreview = e.target.result; };
            reader.readAsDataURL(file);
        }
    };
}
</script>
@endpush
