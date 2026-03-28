@extends('layouts.guest')

@section('title', 'นโยบายความเป็นส่วนตัว')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-gray-800/50 rounded-2xl border border-gray-700 p-8">
        <h1 class="text-2xl font-bold text-white mb-6">นโยบายความเป็นส่วนตัว (Privacy Policy)</h1>
        <p class="text-gray-400 text-sm mb-8">เวอร์ชัน {{ config('ktbaccount.pdpa.consent_version') }} | มีผลตั้งแต่วันที่ 1 มกราคม 2567</p>

        <div class="prose prose-invert prose-sm max-w-none space-y-6 text-gray-300">
            <section>
                <h2 class="text-lg font-semibold text-white">1. ข้อมูลทั่วไป</h2>
                <p>ระบบบริหารกองทุนหมู่บ้าน (KTB Account) ให้บริการโดย {{ config('ktbaccount.company') }} ("ผู้ให้บริการ") มุ่งมั่นในการปกป้องข้อมูลส่วนบุคคลของผู้ใช้งานตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 (PDPA)</p>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-white">2. ข้อมูลที่เราเก็บรวบรวม</h2>
                <ul class="list-disc pl-5 space-y-1">
                    <li>ชื่อ-นามสกุล, เลขบัตรประชาชน (เข้ารหัส), วันเกิด, ที่อยู่</li>
                    <li>หมายเลขโทรศัพท์, อีเมล</li>
                    <li>ข้อมูลทางการเงิน: ยอดสินเชื่อ, เงินฝาก, หุ้น, ประวัติการทำรายการ</li>
                    <li>ข้อมูลการเข้าใช้ระบบ: IP address, วันเวลาการเข้าใช้งาน</li>
                    <li>LINE User ID (หากเชื่อมต่อ LINE OA)</li>
                </ul>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-white">3. วัตถุประสงค์ในการเก็บรวบรวม</h2>
                <ul class="list-disc pl-5 space-y-1">
                    <li>เพื่อให้บริการระบบบริหารกองทุนหมู่บ้าน</li>
                    <li>เพื่อจัดทำบัญชีและรายงานทางการเงิน</li>
                    <li>เพื่อส่งแจ้งเตือนผ่าน LINE OA ของกองทุน</li>
                    <li>เพื่อปฏิบัติตามกฎหมายที่เกี่ยวข้อง</li>
                </ul>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-white">4. การรักษาความปลอดภัย</h2>
                <ul class="list-disc pl-5 space-y-1">
                    <li>เลขบัตรประชาชนเข้ารหัสด้วย AES-256 ก่อนจัดเก็บ</li>
                    <li>การสื่อสารผ่าน HTTPS เข้ารหัสทั้งหมด</li>
                    <li>ระบบบันทึกประวัติการเข้าถึงข้อมูล (Audit Log)</li>
                    <li>แยกข้อมูลแต่ละกองทุนอย่างเป็นอิสระ (Tenant Isolation)</li>
                </ul>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-white">5. สิทธิของเจ้าของข้อมูล</h2>
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>สิทธิในการเข้าถึง:</strong> ขอดูข้อมูลส่วนบุคคลของตนเอง</li>
                    <li><strong>สิทธิในการแก้ไข:</strong> ขอแก้ไขข้อมูลที่ไม่ถูกต้อง</li>
                    <li><strong>สิทธิในการลบ:</strong> ขอลบข้อมูลส่วนบุคคล (เว้นแต่ข้อมูลที่ต้องเก็บตามกฎหมาย)</li>
                    <li><strong>สิทธิในการเพิกถอนความยินยอม:</strong> ถอนความยินยอมที่เคยให้ไว้</li>
                    <li><strong>สิทธิในการโอนย้ายข้อมูล:</strong> ขอรับข้อมูลในรูปแบบที่อ่านได้</li>
                </ul>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-white">6. ระยะเวลาการเก็บรักษา</h2>
                <p>ข้อมูลส่วนบุคคลจะถูกเก็บรักษาไว้เป็นระยะเวลา {{ config('ktbaccount.pdpa.data_retention_years') }} ปี หรือตามระยะเวลาที่กฎหมายกำหนด</p>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-white">7. ติดต่อเจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคล (DPO)</h2>
                <p>อีเมล: <a href="mailto:{{ config('ktbaccount.pdpa.dpo_email') }}" class="text-primary-400 hover:underline">{{ config('ktbaccount.pdpa.dpo_email') }}</a></p>
                <p>เว็บไซต์: <a href="{{ config('ktbaccount.company_url') }}" target="_blank" class="text-primary-400 hover:underline">{{ config('ktbaccount.company_url') }}</a></p>
            </section>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-700 text-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                กลับ
            </a>
        </div>
    </div>
</div>
@endsection
