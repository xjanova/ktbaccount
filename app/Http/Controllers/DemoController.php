<?php

namespace App\Http\Controllers;

class DemoController extends Controller
{
    /**
     * แสดงหน้า Demo Dashboard - ทุกคนเข้าดูได้ไม่ต้อง login
     * ข้อมูลตัวอย่างกองทุนหมู่บ้านบ้านสวนสวรรค์
     */
    public function dashboard()
    {
        $fund = $this->getDemoFundData();
        $members = $this->getDemoMembers();
        $loans = $this->getDemoLoans();
        $transactions = $this->getDemoTransactions();
        $savings = $this->getDemoSavings();

        return view('demo.dashboard', compact('fund', 'members', 'loans', 'transactions', 'savings'));
    }

    public function transactions()
    {
        $fund = $this->getDemoFundData();
        $transactions = $this->getDemoTransactions();

        return view('demo.transactions', compact('fund', 'transactions'));
    }

    public function transactionsCreate()
    {
        $fund = $this->getDemoFundData();

        return view('demo.transactions-create', compact('fund'));
    }

    public function loans()
    {
        $fund = $this->getDemoFundData();
        $loans = $this->getDemoLoans();

        return view('demo.loans', compact('fund', 'loans'));
    }

    public function deposits()
    {
        $fund = $this->getDemoFundData();
        $savings = $this->getDemoSavings();

        return view('demo.deposits', compact('fund', 'savings'));
    }

    public function shares()
    {
        $fund = $this->getDemoFundData();
        $members = $this->getDemoMembers();

        return view('demo.shares', compact('fund', 'members'));
    }

    public function members()
    {
        $fund = $this->getDemoFundData();
        $members = $this->getDemoMembers();

        return view('demo.members', compact('fund', 'members'));
    }

    public function reports()
    {
        $fund = $this->getDemoFundData();

        return view('demo.reports', compact('fund'));
    }

    public function approvals()
    {
        $fund = $this->getDemoFundData();
        $loans = $this->getDemoLoans();

        return view('demo.approvals', compact('fund', 'loans'));
    }

    public function settings()
    {
        $fund = $this->getDemoFundData();

        return view('demo.settings', compact('fund'));
    }

    public function accountSets()
    {
        $fund = $this->getDemoFundData();

        return view('demo.account-sets', compact('fund'));
    }

    // ── Demo Data ──────────────────────────────

    private function getDemoFundData(): array
    {
        return [
            'name' => 'กองทุนหมู่บ้านบ้านสวนสวรรค์',
            'code' => 'VF-001',
            'province' => 'เชียงใหม่',
            'district' => 'เมืองเชียงใหม่',
            'subdistrict' => 'ช้างเผือก',
            'address' => '123 หมู่ 5 ต.ช้างเผือก อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50300',
            'phone' => '089-123-4567',
            'email' => 'demo@ktbaccount.xman4289.com',
            'total_members' => 127,
            'total_cash' => 125430.00,
            'total_bank' => 1250000.00,
            'total_loans_outstanding' => 890500.00,
            'total_savings' => 456780.00,
            'total_shares' => 127000.00,
            'active_loans' => 15,
            'overdue_loans' => 2,
            'monthly_income' => [45000, 52000, 48000, 61000, 55000, 67000, 58000, 72000, 63000, 54000, 69000, 75000],
            'monthly_expense' => [32000, 28000, 35000, 29000, 31000, 38000, 33000, 36000, 30000, 27000, 34000, 40000],
        ];
    }

    private function getDemoMembers(): array
    {
        return [
            ['code' => 'M-001', 'name' => 'นายสมชาย ใจดี', 'phone' => '089-111-1111', 'joined' => '15 ม.ค. 2565', 'shares' => 100, 'savings' => 15000, 'loan' => 50000, 'status' => 'active'],
            ['code' => 'M-002', 'name' => 'นางสมศรี รักดี', 'phone' => '089-222-2222', 'joined' => '15 ม.ค. 2565', 'shares' => 150, 'savings' => 28000, 'loan' => 0, 'status' => 'active'],
            ['code' => 'M-003', 'name' => 'นายประสิทธิ์ มั่นคง', 'phone' => '089-333-3333', 'joined' => '20 ก.พ. 2565', 'shares' => 200, 'savings' => 42000, 'loan' => 80000, 'status' => 'active'],
            ['code' => 'M-004', 'name' => 'นางสาวมาลี สุขสม', 'phone' => '089-444-4444', 'joined' => '1 มี.ค. 2565', 'shares' => 50, 'savings' => 8500, 'loan' => 30000, 'status' => 'active'],
            ['code' => 'M-005', 'name' => 'นายวิชัย พัฒนา', 'phone' => '089-555-5555', 'joined' => '15 มี.ค. 2565', 'shares' => 120, 'savings' => 19000, 'loan' => 100000, 'status' => 'active'],
            ['code' => 'M-006', 'name' => 'นางบุญมี ทรัพย์มาก', 'phone' => '089-666-6666', 'joined' => '1 เม.ย. 2565', 'shares' => 80, 'savings' => 35000, 'loan' => 0, 'status' => 'active'],
            ['code' => 'M-007', 'name' => 'นายสุรชัย เก่งกาจ', 'phone' => '089-777-7777', 'joined' => '20 เม.ย. 2565', 'shares' => 100, 'savings' => 12000, 'loan' => 60000, 'status' => 'active'],
            ['code' => 'M-008', 'name' => 'นางสาวจันทร์เพ็ญ ศรีสมร', 'phone' => '089-888-8888', 'joined' => '1 พ.ค. 2565', 'shares' => 70, 'savings' => 22000, 'loan' => 45000, 'status' => 'active'],
        ];
    }

    private function getDemoLoans(): array
    {
        return [
            ['code' => 'LN2569-00001', 'member' => 'นายสมชาย ใจดี', 'principal' => 50000, 'rate' => 12, 'term' => 12, 'outstanding' => 25000, 'status' => 'active', 'next_due' => '15 เม.ย. 2569', 'overdue' => false],
            ['code' => 'LN2569-00002', 'member' => 'นายประสิทธิ์ มั่นคง', 'principal' => 80000, 'rate' => 12, 'term' => 24, 'outstanding' => 65000, 'status' => 'active', 'next_due' => '20 เม.ย. 2569', 'overdue' => false],
            ['code' => 'LN2569-00003', 'member' => 'นางสาวมาลี สุขสม', 'principal' => 30000, 'rate' => 10, 'term' => 12, 'outstanding' => 10000, 'status' => 'active', 'next_due' => '1 เม.ย. 2569', 'overdue' => false],
            ['code' => 'LN2569-00004', 'member' => 'นายวิชัย พัฒนา', 'principal' => 100000, 'rate' => 12, 'term' => 36, 'outstanding' => 92000, 'status' => 'active', 'next_due' => '15 มี.ค. 2569', 'overdue' => true],
            ['code' => 'LN2569-00005', 'member' => 'นายสุรชัย เก่งกาจ', 'principal' => 60000, 'rate' => 12, 'term' => 18, 'outstanding' => 48000, 'status' => 'active', 'next_due' => '20 เม.ย. 2569', 'overdue' => false],
            ['code' => 'LN2568-00010', 'member' => 'นางสาวจันทร์เพ็ญ ศรีสมร', 'principal' => 45000, 'rate' => 10, 'term' => 12, 'outstanding' => 0, 'status' => 'completed', 'next_due' => '-', 'overdue' => false],
        ];
    }

    private function getDemoTransactions(): array
    {
        return [
            ['date' => '28 มี.ค. 2569', 'type' => 'income', 'category' => 'รับชำระสินเชื่อ', 'amount' => 5800, 'member' => 'นายสมชาย ใจดี', 'method' => 'เงินสด'],
            ['date' => '27 มี.ค. 2569', 'type' => 'income', 'category' => 'รับฝากเงินสมาชิก', 'amount' => 2000, 'member' => 'นางบุญมี ทรัพย์มาก', 'method' => 'เงินสด'],
            ['date' => '26 มี.ค. 2569', 'type' => 'expense', 'category' => 'ค่าสาธารณูปโภค', 'amount' => 1500, 'member' => '-', 'method' => 'เงินฝากธนาคาร'],
            ['date' => '25 มี.ค. 2569', 'type' => 'income', 'category' => 'รับชำระสินเชื่อ', 'amount' => 4200, 'member' => 'นายประสิทธิ์ มั่นคง', 'method' => 'โอนธนาคาร'],
            ['date' => '24 มี.ค. 2569', 'type' => 'income', 'category' => 'ค่าธรรมเนียมสมาชิกใหม่', 'amount' => 100, 'member' => 'สมาชิกใหม่', 'method' => 'เงินสด'],
            ['date' => '23 มี.ค. 2569', 'type' => 'expense', 'category' => 'ค่าเดินทาง', 'amount' => 800, 'member' => '-', 'method' => 'เงินสด'],
        ];
    }

    private function getDemoSavings(): array
    {
        return [
            ['account' => 'SAV-000001', 'member' => 'นายสมชาย ใจดี', 'balance' => 15000, 'rate' => 2.0, 'last_activity' => '20 มี.ค. 2569'],
            ['account' => 'SAV-000002', 'member' => 'นางสมศรี รักดี', 'balance' => 28000, 'rate' => 2.0, 'last_activity' => '18 มี.ค. 2569'],
            ['account' => 'SAV-000003', 'member' => 'นายประสิทธิ์ มั่นคง', 'balance' => 42000, 'rate' => 2.5, 'last_activity' => '22 มี.ค. 2569'],
            ['account' => 'SAV-000004', 'member' => 'นางบุญมี ทรัพย์มาก', 'balance' => 35000, 'rate' => 2.0, 'last_activity' => '27 มี.ค. 2569'],
        ];
    }
}
