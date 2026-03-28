@extends('layouts.app')

@section('page-title', 'แก้ไขข้อมูลสมาชิก')

@section('content')
    <div class="max-w-3xl" x-data="memberEditForm()">

        {{-- Back link --}}
        <a href="{{ route('fund.members.show', $member->id) }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white mb-4 transition-colors" title="กลับไปหน้ารายละเอียด">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            กลับไปหน้ารายละเอียด
        </a>

        {{-- Member code label --}}
        <div class="mb-4 flex items-center gap-2">
            <span class="text-sm text-gray-400">รหัสสมาชิก:</span>
            <span class="text-sm font-mono text-primary-400 font-medium">{{ $member->member_code }}</span>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('fund.members.update', $member->id) }}" enctype="multipart/form-data" class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            @csrf
            @method('PUT')

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
                            @if ($member->photo_path)
                                <img src="{{ asset('storage/' . $member->photo_path) }}" class="w-20 h-20 rounded-full object-cover border-2 border-primary-500/50">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-600/30 to-primary-400/10 border-2 border-primary-500/30 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-primary-400">{{ mb_substr($member->first_name, 0, 1) }}</span>
                                </div>
                            @endif
                        </template>
                    </div>
                    <div class="flex-1">
                        <label class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 border border-gray-700 rounded-xl text-sm text-gray-300 hover:bg-gray-700 cursor-pointer transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" /></svg>
                            เปลี่ยนรูปภาพ
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
                    :selected="old('title', $member->title)"
                    placeholder="-- เลือก --"
                />
                <div class="sm:col-span-1">
                    <x-form.input
                        name="first_name"
                        label="ชื่อ"
                        :required="true"
                        :value="old('first_name', $member->first_name)"
                        placeholder="กรอกชื่อ"
                    />
                </div>
                <div class="sm:col-span-2">
                    <x-form.input
                        name="last_name"
                        label="นามสกุล"
                        :required="true"
                        :value="old('last_name', $member->last_name)"
                        placeholder="กรอกนามสกุล"
                    />
                </div>
            </div>

            {{-- Phone & Birth date --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form.input
                    name="phone"
                    label="เบอร์โทรศัพท์"
                    :value="old('phone', $member->phone)"
                    placeholder="0XX-XXX-XXXX"
                />
                <x-form.input
                    name="birth_date"
                    label="วันเกิด"
                    type="date"
                    :value="old('birth_date', $member->birth_date?->format('Y-m-d'))"
                    placeholder="เลือกวันเกิด"
                />
            </div>

            {{-- Address --}}
            <x-form.textarea
                name="address"
                label="ที่อยู่"
                :rows="3"
                :value="old('address', $member->address)"
                placeholder="กรอกที่อยู่"
            />

            {{-- Occupation --}}
            <x-form.input
                name="occupation"
                label="อาชีพ"
                :value="old('occupation', $member->occupation)"
                placeholder="กรอกอาชีพ"
            />

            {{-- Status --}}
            <x-form.select
                name="status"
                label="สถานะสมาชิก"
                :options="['active' => 'ปกติ', 'inactive' => 'ไม่ใช้งาน', 'suspended' => 'ระงับชั่วคราว', 'resigned' => 'ลาออก']"
                :selected="old('status', $member->status->value ?? $member->status)"
                tooltip="เปลี่ยนสถานะสมาชิก"
            />

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-600/25" title="บันทึกการแก้ไข">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    บันทึก
                </button>
                <a href="{{ route('fund.members.show', $member->id) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-colors" title="ยกเลิกการแก้ไข">
                    ยกเลิก
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
function memberEditForm() {
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
