@extends('layouts.app')

@section('page-title', 'รายงาน')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold text-white">รายงานทางการเงิน</h2>
        <p class="text-sm text-gray-400 mt-1">เลือกรายงานที่ต้องการจัดทำ พร้อมกำหนดช่วงเวลาและชุดบัญชี</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- งบทดลอง --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-primary-500/30 transition-all duration-300 group">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-primary-500/20 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 0v.375" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">งบทดลอง</h3>
                    <p class="text-sm text-gray-400 mt-1">สรุปยอดรวมเดบิตและเครดิตของบัญชีแยกประเภททั้งหมด เพื่อตรวจสอบความถูกต้อง</p>
                </div>
            </div>
            <form method="GET" action="#" class="space-y-3">
                <x-form.select name="trial_account_set" label="ชุดบัญชี" :options="$accountSets ?? []" :required="true" tooltip="เลือกชุดบัญชีที่ต้องการดูงบทดลอง" />
                <div class="grid grid-cols-2 gap-3">
                    <x-form.input name="trial_start_date" label="จากวันที่" type="text" placeholder="วว/ดด/ปปปป" />
                    <x-form.input name="trial_end_date" label="ถึงวันที่" type="text" placeholder="วว/ดด/ปปปป" />
                </div>
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ดูรายงาน">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        ดูรายงาน
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ดาวน์โหลด PDF">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        PDF
                    </button>
                </div>
            </form>
        </div>

        {{-- งบกำไรขาดทุน --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-primary-500/30 transition-all duration-300 group">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">งบกำไรขาดทุน</h3>
                    <p class="text-sm text-gray-400 mt-1">แสดงรายรับรายจ่ายและผลกำไรขาดทุนของกองทุนในช่วงเวลาที่กำหนด</p>
                </div>
            </div>
            <form method="GET" action="#" class="space-y-3">
                <x-form.select name="pnl_account_set" label="ชุดบัญชี" :options="$accountSets ?? []" :required="true" tooltip="เลือกชุดบัญชีที่ต้องการดูงบกำไรขาดทุน" />
                <div class="grid grid-cols-2 gap-3">
                    <x-form.input name="pnl_start_date" label="จากวันที่" type="text" placeholder="วว/ดด/ปปปป" />
                    <x-form.input name="pnl_end_date" label="ถึงวันที่" type="text" placeholder="วว/ดด/ปปปป" />
                </div>
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ดูรายงาน">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        ดูรายงาน
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ดาวน์โหลด PDF">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        PDF
                    </button>
                </div>
            </form>
        </div>

        {{-- งบแสดงฐานะการเงิน --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-primary-500/30 transition-all duration-300 group">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">งบแสดงฐานะการเงิน</h3>
                    <p class="text-sm text-gray-400 mt-1">แสดงสินทรัพย์ หนี้สิน และทุนของกองทุน ณ วันที่ระบุ</p>
                </div>
            </div>
            <form method="GET" action="#" class="space-y-3">
                <x-form.select name="bs_account_set" label="ชุดบัญชี" :options="$accountSets ?? []" :required="true" tooltip="เลือกชุดบัญชีที่ต้องการดูงบแสดงฐานะการเงิน" />
                <x-form.input name="bs_as_of_date" label="ณ วันที่" type="text" placeholder="วว/ดด/ปปปป" />
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ดูรายงาน">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        ดูรายงาน
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ดาวน์โหลด PDF">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        PDF
                    </button>
                </div>
            </form>
        </div>

        {{-- บัญชีแยกประเภท --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-primary-500/30 transition-all duration-300 group">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-500/20 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">บัญชีแยกประเภท</h3>
                    <p class="text-sm text-gray-400 mt-1">แสดงรายการเคลื่อนไหวของแต่ละบัญชีในช่วงเวลาที่กำหนด</p>
                </div>
            </div>
            <form method="GET" action="#" class="space-y-3">
                <x-form.select name="ledger_account_set" label="ชุดบัญชี" :options="$accountSets ?? []" :required="true" tooltip="เลือกชุดบัญชีที่ต้องการดูบัญชีแยกประเภท" />
                <div class="grid grid-cols-2 gap-3">
                    <x-form.input name="ledger_start_date" label="จากวันที่" type="text" placeholder="วว/ดด/ปปปป" />
                    <x-form.input name="ledger_end_date" label="ถึงวันที่" type="text" placeholder="วว/ดด/ปปปป" />
                </div>
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-500 text-white text-sm font-medium rounded-xl transition-colors" title="ดูรายงาน">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        ดูรายงาน
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-xl transition-colors" title="ดาวน์โหลด PDF">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
