<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name (Thai)
    |--------------------------------------------------------------------------
    */
    'name' => 'ระบบบริหารกองทุนหมู่บ้าน',
    'name_en' => 'Village Fund Management System',
    'short_name' => 'KTB Account',

    /*
    |--------------------------------------------------------------------------
    | Company / License
    |--------------------------------------------------------------------------
    */
    'company' => 'XMAN Studio',
    'company_url' => 'https://xman4289.com',
    'support_email' => 'support@xman4289.com',

    /*
    |--------------------------------------------------------------------------
    | Multi-tenant Settings
    |--------------------------------------------------------------------------
    */
    'tenant' => [
        'max_members_free' => 500,
        'max_account_sets_free' => 5,
        'session_key' => 'current_tenant_id',
        'header_key' => 'X-Tenant-ID',
    ],

    /*
    |--------------------------------------------------------------------------
    | Accounting Settings
    |--------------------------------------------------------------------------
    */
    'accounting' => [
        'basis' => 'cash', // เกณฑ์เงินสด
        'fiscal_year_start_month' => 1, // มกราคม
        'fiscal_year_end_month' => 12, // ธันวาคม
        'decimal_places' => 2,
        'currency' => 'THB',
        'currency_symbol' => '฿',
        'retained_earnings_code' => '33010', // กำไร(ขาดทุน)สะสม
    ],

    /*
    |--------------------------------------------------------------------------
    | Loan Settings
    |--------------------------------------------------------------------------
    */
    'loan' => [
        'default_interest_rate' => 12.00, // ร้อยละ 12 ต่อปี
        'max_term_months' => 60,
        'min_guarantors' => 1,
        'max_guarantors' => 2,
        'overdue_reminder_days' => [7, 3, 1, 0, -7, -14, -30], // days before/after due
    ],

    /*
    |--------------------------------------------------------------------------
    | Share Settings
    |--------------------------------------------------------------------------
    */
    'share' => [
        'default_price' => 10.00, // ราคาหุ้นละ 10 บาท
        'min_shares' => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | LINE OA Settings
    |--------------------------------------------------------------------------
    */
    'line' => [
        'login_channel_id' => env('LINE_LOGIN_CHANNEL_ID'),
        'login_channel_secret' => env('LINE_LOGIN_CHANNEL_SECRET'),
        'messaging_api_url' => 'https://api.line.me/v2/bot',
        'webhook_verify' => env('LINE_WEBHOOK_VERIFY', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | PDPA Settings
    |--------------------------------------------------------------------------
    */
    'pdpa' => [
        'consent_version' => '1.0',
        'data_retention_years' => 10,
        'privacy_policy_url' => '/privacy-policy',
        'dpo_email' => 'dpo@xman4289.com',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto-Update (Flutter App)
    |--------------------------------------------------------------------------
    */
    'update' => [
        'github_repo' => 'xjanova/ktbaccount',
        'github_api' => 'https://api.github.com/repos/xjanova/ktbaccount/releases/latest',
        'check_interval_hours' => 24,
    ],

    /*
    |--------------------------------------------------------------------------
    | Profit Allocation Categories
    |--------------------------------------------------------------------------
    */
    'profit_allocation_categories' => [
        'reserve' => 'เงินสำรอง/ประกันความเสี่ยง',
        'fund_contribution' => 'เงินสมทบกองทุน',
        'dividend' => 'เงินเฉลี่ยคืนสมาชิก',
        'public_benefit' => 'ทุนสาธารณประโยชน์',
        'committee_compensation' => 'ค่าตอบแทนคณะกรรมการ',
        'other' => 'อื่นๆ',
    ],

    /*
    |--------------------------------------------------------------------------
    | Transaction Categories
    |--------------------------------------------------------------------------
    */
    'income_categories' => [
        'loan_interest' => 'รายได้ดอกเบี้ยเงินกู้',
        'membership_fee' => 'ค่าธรรมเนียมสมาชิก',
        'deposit_interest' => 'รายได้ดอกเบี้ยเงินฝาก/เงินลงทุน',
        'government_fund' => 'เงินทุนสนับสนุนจากรัฐบาล',
        'other_income' => 'รายได้อื่น',
    ],

    'expense_categories' => [
        'committee_compensation' => 'ค่าตอบแทนคณะกรรมการ',
        'travel' => 'ค่าเดินทาง',
        'utilities' => 'ค่าสาธารณูปโภค',
        'meeting' => 'ค่าใช้จ่ายในการประชุม',
        'training' => 'ค่าอบรม/สัมมนา',
        'office_supplies' => 'ค่าเครื่องเขียน/วัสดุสำนักงาน',
        'interest_expense' => 'ดอกเบี้ยจ่าย',
        'bad_debt' => 'หนี้สูญ/หนี้สงสัยจะสูญ',
        'other_expense' => 'ค่าใช้จ่ายอื่น',
    ],

];
