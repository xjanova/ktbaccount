<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    /**
     * สร้างผังบัญชีมาตรฐานสำหรับกองทุนหมู่บ้าน
     * เรียกใช้ตอนลงทะเบียนกองทุนใหม่
     */
    public function run(): void
    {
        // This seeder is called per-tenant via seedForTenant()
    }

    /**
     * สร้างผังบัญชีสำหรับกองทุนที่ระบุ
     */
    public static function seedForTenant(int $tenantId, ?int $accountSetId = null): void
    {
        $accounts = self::getDefaultAccounts();

        foreach ($accounts as $account) {
            ChartOfAccount::withoutGlobalScopes()->firstOrCreate(
                [
                    'tenant_id' => $tenantId,
                    'account_set_id' => $accountSetId,
                    'code' => $account['code'],
                ],
                [
                    'name' => $account['name'],
                    'category' => $account['category'],
                    'parent_code' => $account['parent_code'],
                    'is_control_account' => $account['is_control'],
                    'is_active' => true,
                    'normal_balance' => $account['normal_balance'],
                    'sort_order' => $account['sort_order'],
                ]
            );
        }
    }

    /**
     * ผังบัญชีมาตรฐานกองทุนหมู่บ้าน (จากคู่มือ VFM)
     */
    public static function getDefaultAccounts(): array
    {
        return [
            // ═══ หมวด 1: สินทรัพย์ (Assets) ═══
            ['code' => '10000', 'name' => '*สินทรัพย์*', 'category' => 'asset', 'parent_code' => null, 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 1],
            ['code' => '11000', 'name' => '*เงินสด*', 'category' => 'asset', 'parent_code' => '10000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 2],
            ['code' => '11010', 'name' => 'เงินสด', 'category' => 'asset', 'parent_code' => '11000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 3],
            ['code' => '12000', 'name' => '*เงินฝากธนาคาร*', 'category' => 'asset', 'parent_code' => '10000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 4],
            ['code' => '12010', 'name' => 'เงินฝากธนาคาร - บัญชีเงินล้าน', 'category' => 'asset', 'parent_code' => '12000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 5],
            ['code' => '12020', 'name' => 'เงินฝากธนาคาร - บัญชีเงินเพิ่มทุน', 'category' => 'asset', 'parent_code' => '12000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 6],
            ['code' => '12030', 'name' => 'เงินฝากธนาคาร - บัญชีเงินออม', 'category' => 'asset', 'parent_code' => '12000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 7],
            ['code' => '12040', 'name' => 'เงินฝากธนาคาร - บัญชีอื่น', 'category' => 'asset', 'parent_code' => '12000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 8],
            ['code' => '13000', 'name' => '*ลูกหนี้เงินกู้*', 'category' => 'asset', 'parent_code' => '10000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 9],
            ['code' => '13010', 'name' => 'ลูกหนี้เงินกู้ - บัญชีเงินล้าน', 'category' => 'asset', 'parent_code' => '13000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 10],
            ['code' => '13020', 'name' => 'ลูกหนี้เงินกู้ - บัญชีเงินเพิ่มทุน', 'category' => 'asset', 'parent_code' => '13000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 11],
            ['code' => '13030', 'name' => 'ลูกหนี้เงินกู้ - บัญชีเงินออม', 'category' => 'asset', 'parent_code' => '13000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 12],
            ['code' => '14000', 'name' => '*สินทรัพย์อื่น*', 'category' => 'asset', 'parent_code' => '10000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 13],
            ['code' => '14010', 'name' => 'สินทรัพย์อื่น', 'category' => 'asset', 'parent_code' => '14000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 14],

            // ═══ หมวด 2: หนี้สิน (Liabilities) ═══
            ['code' => '20000', 'name' => '*หนี้สิน*', 'category' => 'liability', 'parent_code' => null, 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 20],
            ['code' => '21000', 'name' => '*เงินรับฝาก*', 'category' => 'liability', 'parent_code' => '20000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 21],
            ['code' => '21010', 'name' => 'เงินรับฝากจากสมาชิก', 'category' => 'liability', 'parent_code' => '21000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 22],
            ['code' => '22000', 'name' => '*หนี้สินอื่น*', 'category' => 'liability', 'parent_code' => '20000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 23],
            ['code' => '22010', 'name' => 'หนี้สินอื่น', 'category' => 'liability', 'parent_code' => '22000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 24],

            // ═══ หมวด 3: ทุน (Equity) ═══
            ['code' => '30000', 'name' => '*ทุน*', 'category' => 'equity', 'parent_code' => null, 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 30],
            ['code' => '31000', 'name' => '*ทุนกองทุน*', 'category' => 'equity', 'parent_code' => '30000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 31],
            ['code' => '31010', 'name' => 'ทุนกองทุนหมู่บ้าน (เงินล้าน)', 'category' => 'equity', 'parent_code' => '31000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 32],
            ['code' => '31020', 'name' => 'เงินเพิ่มทุน', 'category' => 'equity', 'parent_code' => '31000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 33],
            ['code' => '31030', 'name' => 'เงินอุดหนุน/เงินสมทบ', 'category' => 'equity', 'parent_code' => '31000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 34],
            ['code' => '32000', 'name' => '*เงินสำรองและกำไร*', 'category' => 'equity', 'parent_code' => '30000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 35],
            ['code' => '32010', 'name' => 'เงินสำรอง/ประกันความเสี่ยง', 'category' => 'equity', 'parent_code' => '32000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 36],
            ['code' => '32020', 'name' => 'เงินสมทบกองทุน', 'category' => 'equity', 'parent_code' => '32000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 37],
            ['code' => '32030', 'name' => 'เงินเฉลี่ยคืนสมาชิก', 'category' => 'equity', 'parent_code' => '32000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 38],
            ['code' => '32040', 'name' => 'ทุนสาธารณประโยชน์', 'category' => 'equity', 'parent_code' => '32000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 39],
            ['code' => '32050', 'name' => 'ทุนหุ้นของสมาชิก', 'category' => 'equity', 'parent_code' => '32000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 40],
            ['code' => '33000', 'name' => '*กำไร(ขาดทุน)สะสม*', 'category' => 'equity', 'parent_code' => '30000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 41],
            ['code' => '33010', 'name' => 'กำไร(ขาดทุน)สะสม', 'category' => 'equity', 'parent_code' => '33000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 42],

            // ═══ หมวด 4: รายได้ (Revenue) ═══
            ['code' => '40000', 'name' => '*รายได้*', 'category' => 'revenue', 'parent_code' => null, 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 50],
            ['code' => '41000', 'name' => '*รายได้จากการดำเนินงาน*', 'category' => 'revenue', 'parent_code' => '40000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 51],
            ['code' => '41010', 'name' => 'รายได้ดอกเบี้ยเงินกู้', 'category' => 'revenue', 'parent_code' => '41000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 52],
            ['code' => '41020', 'name' => 'รายได้ค่าธรรมเนียม', 'category' => 'revenue', 'parent_code' => '41000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 53],
            ['code' => '42000', 'name' => '*รายได้อื่น*', 'category' => 'revenue', 'parent_code' => '40000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 54],
            ['code' => '42010', 'name' => 'รายได้ดอกเบี้ยเงินฝาก/เงินลงทุน', 'category' => 'revenue', 'parent_code' => '42000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 55],
            ['code' => '43000', 'name' => '*รายได้เบ็ดเตล็ด*', 'category' => 'revenue', 'parent_code' => '40000', 'is_control' => true, 'normal_balance' => 'credit', 'sort_order' => 56],
            ['code' => '43010', 'name' => 'รายได้อื่น', 'category' => 'revenue', 'parent_code' => '43000', 'is_control' => false, 'normal_balance' => 'credit', 'sort_order' => 57],

            // ═══ หมวด 5: ค่าใช้จ่าย (Expenses) ═══
            ['code' => '50000', 'name' => '*ค่าใช้จ่าย*', 'category' => 'expense', 'parent_code' => null, 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 60],
            ['code' => '51000', 'name' => '*ค่าใช้จ่ายในการดำเนินงาน*', 'category' => 'expense', 'parent_code' => '50000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 61],
            ['code' => '51010', 'name' => 'ค่าตอบแทนคณะกรรมการ', 'category' => 'expense', 'parent_code' => '51000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 62],
            ['code' => '51020', 'name' => 'ค่าเดินทาง', 'category' => 'expense', 'parent_code' => '51000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 63],
            ['code' => '51030', 'name' => 'ค่าสาธารณูปโภค', 'category' => 'expense', 'parent_code' => '51000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 64],
            ['code' => '51040', 'name' => 'ค่าใช้จ่ายในการประชุม', 'category' => 'expense', 'parent_code' => '51000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 65],
            ['code' => '51050', 'name' => 'ค่าอบรม/สัมมนา', 'category' => 'expense', 'parent_code' => '51000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 66],
            ['code' => '51060', 'name' => 'ค่าเครื่องเขียน/วัสดุสำนักงาน', 'category' => 'expense', 'parent_code' => '51000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 67],
            ['code' => '52000', 'name' => '*ค่าใช้จ่ายทางการเงิน*', 'category' => 'expense', 'parent_code' => '50000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 68],
            ['code' => '52010', 'name' => 'ดอกเบี้ยจ่าย', 'category' => 'expense', 'parent_code' => '52000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 69],
            ['code' => '53000', 'name' => '*หนี้สูญ*', 'category' => 'expense', 'parent_code' => '50000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 70],
            ['code' => '53010', 'name' => 'หนี้สูญ/หนี้สงสัยจะสูญ', 'category' => 'expense', 'parent_code' => '53000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 71],
            ['code' => '54000', 'name' => '*ค่าใช้จ่ายอื่น*', 'category' => 'expense', 'parent_code' => '50000', 'is_control' => true, 'normal_balance' => 'debit', 'sort_order' => 72],
            ['code' => '54010', 'name' => 'ค่าใช้จ่ายอื่น', 'category' => 'expense', 'parent_code' => '54000', 'is_control' => false, 'normal_balance' => 'debit', 'sort_order' => 73],
        ];
    }
}
