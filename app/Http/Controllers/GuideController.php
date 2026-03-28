<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Guide table of contents data.
     */
    private function getGuideStructure(): array
    {
        return [
            'getting-started' => [
                'icon' => '🏁',
                'title' => 'เริ่มต้นใช้งาน',
                'pages' => [
                    'register' => 'ลงทะเบียนกองทุน',
                    'first-login' => 'เข้าสู่ระบบครั้งแรก',
                    'setup-fund' => 'ตั้งค่าข้อมูลกองทุน',
                    'manage-users' => 'เพิ่มผู้ใช้งานและกำหนดสิทธิ์',
                ],
            ],
            'dashboard' => [
                'icon' => '🏠',
                'title' => 'หน้าหลัก',
                'pages' => [
                    'overview' => 'ทำความรู้จักหน้าหลัก',
                    'charts' => 'อ่านกราฟและตัวเลขสรุป',
                    'quick-actions' => 'ปุ่มลัดการทำงาน',
                ],
            ],
            'transactions' => [
                'icon' => '💰',
                'title' => 'รายรับ-รายจ่าย',
                'pages' => [
                    'record-income' => 'บันทึกรายรับ',
                    'record-expense' => 'บันทึกรายจ่าย',
                    'templates' => 'ใช้รายการที่ใช้บ่อย (Template)',
                    'history' => 'ดูประวัติรายการ',
                    'receipts' => 'ดาวน์โหลดใบสำคัญรับ/จ่าย',
                ],
            ],
            'accounting' => [
                'icon' => '📊',
                'title' => 'บัญชี',
                'pages' => [
                    'chart-of-accounts' => 'ทำความเข้าใจผังบัญชี',
                    'journal-entry' => 'บันทึกรายการบัญชี',
                    'fiscal-periods' => 'เปิด/ปิดงวดบัญชี',
                    'year-end-closing' => 'ปิดบัญชีสิ้นปี',
                ],
            ],
            'reports' => [
                'icon' => '📋',
                'title' => 'รายงาน',
                'pages' => [
                    'trial-balance' => 'งบทดลอง',
                    'income-statement' => 'งบกำไรขาดทุน',
                    'balance-sheet' => 'งบแสดงฐานะการเงิน (งบดุล)',
                    'general-ledger' => 'บัญชีแยกประเภท',
                    'download-pdf' => 'ดาวน์โหลดรายงาน PDF',
                ],
            ],
            'loans' => [
                'icon' => '🏦',
                'title' => 'สินเชื่อ',
                'pages' => [
                    'create-loan' => 'สร้างสัญญาสินเชื่อใหม่',
                    'approve-loan' => 'อนุมัติสินเชื่อ',
                    'receive-payment' => 'รับชำระสินเชื่อ',
                    'payment-schedule' => 'ดูตารางผ่อนชำระ',
                    'overdue-tracking' => 'ติดตามหนี้ค้างชำระ',
                ],
            ],
            'savings' => [
                'icon' => '💵',
                'title' => 'เงินฝาก',
                'pages' => [
                    'open-account' => 'เปิดบัญชีเงินฝาก',
                    'deposit' => 'ฝากเงิน',
                    'withdraw' => 'ถอนเงิน',
                    'balance-history' => 'ดูยอดและประวัติ',
                ],
            ],
            'shares' => [
                'icon' => '📈',
                'title' => 'หุ้น',
                'pages' => [
                    'buy-shares' => 'ซื้อหุ้น',
                    'sell-shares' => 'ขาย/ถอนหุ้น',
                    'holdings' => 'ดูยอดถือครอง',
                ],
            ],
            'profit-allocation' => [
                'icon' => '🎯',
                'title' => 'จัดสรรกำไร',
                'pages' => [
                    'process' => 'ขั้นตอนจัดสรรกำไรประจำปี',
                    'record' => 'บันทึกจัดสรรกำไร',
                ],
            ],
            'mobile-app' => [
                'icon' => '📱',
                'title' => 'แอปมือถือ',
                'pages' => [
                    'download-install' => 'ดาวน์โหลดและติดตั้ง',
                    'app-login' => 'เข้าสู่ระบบบนแอป',
                    'view-data' => 'ดูยอดสินเชื่อ/เงินฝาก/หุ้น',
                    'notifications' => 'รับแจ้งเตือน',
                    'app-update' => 'อัพเดทแอป',
                ],
            ],
            'line-oa' => [
                'icon' => '💬',
                'title' => 'LINE OA',
                'pages' => [
                    'setup' => 'ตั้งค่า LINE OA กองทุน',
                    'receive-notifications' => 'รับแจ้งเตือนผ่าน LINE',
                    'commands' => 'คำสั่งที่ใช้ได้ใน LINE',
                ],
            ],
            'settings' => [
                'icon' => '⚙️',
                'title' => 'ตั้งค่า',
                'pages' => [
                    'users-roles' => 'จัดการผู้ใช้งานและสิทธิ์',
                    'bank-accounts' => 'ตั้งค่าบัญชีธนาคาร',
                    'account-sets' => 'ตั้งค่าชุดบัญชี',
                ],
            ],
        ];
    }

    /**
     * หน้าแรกคู่มือ - แสดงสารบัญทั้งหมด
     */
    public function index()
    {
        $categories = $this->getGuideStructure();

        return view('guide.index', compact('categories'));
    }

    /**
     * แสดงบทเรียนตามหมวดหมู่และ slug
     */
    public function show(string $category, string $slug)
    {
        $categories = $this->getGuideStructure();

        if (! isset($categories[$category]) || ! isset($categories[$category]['pages'][$slug])) {
            abort(404, 'ไม่พบหน้าคู่มือที่ต้องการ');
        }

        $currentCategory = $categories[$category];
        $currentTitle = $currentCategory['pages'][$slug];
        $viewPath = "guide.{$category}.{$slug}";

        if (! view()->exists($viewPath)) {
            abort(404, 'ไม่พบหน้าคู่มือที่ต้องการ');
        }

        // Find prev/next pages
        $allPages = $this->flattenPages($categories);
        $currentIndex = array_search("{$category}/{$slug}", array_column($allPages, 'path'));
        $prevPage = $currentIndex > 0 ? $allPages[$currentIndex - 1] : null;
        $nextPage = $currentIndex < count($allPages) - 1 ? $allPages[$currentIndex + 1] : null;

        return view($viewPath, compact(
            'categories', 'category', 'slug', 'currentCategory', 'currentTitle',
            'prevPage', 'nextPage'
        ));
    }

    /**
     * ค้นหาในคู่มือ
     */
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $categories = $this->getGuideStructure();

        $results = [];
        if (strlen($query) >= 2) {
            foreach ($categories as $catKey => $cat) {
                foreach ($cat['pages'] as $pageKey => $pageTitle) {
                    if (mb_stripos($pageTitle, $query) !== false) {
                        $results[] = [
                            'title' => $pageTitle,
                            'category' => $cat['title'],
                            'icon' => $cat['icon'],
                            'url' => route('guide.show', [$catKey, $pageKey]),
                        ];
                    }
                }
            }
        }

        return view('guide.search', compact('categories', 'query', 'results'));
    }

    private function flattenPages(array $categories): array
    {
        $pages = [];
        foreach ($categories as $catKey => $cat) {
            foreach ($cat['pages'] as $pageKey => $pageTitle) {
                $pages[] = [
                    'path' => "{$catKey}/{$pageKey}",
                    'title' => $pageTitle,
                    'category' => $cat['title'],
                    'icon' => $cat['icon'],
                    'url' => route('guide.show', [$catKey, $pageKey]),
                ];
            }
        }

        return $pages;
    }
}
