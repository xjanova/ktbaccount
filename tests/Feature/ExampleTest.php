<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ถ้ายังไม่มี Super Admin → redirect ไป /setup
     */
    public function test_redirects_to_setup_when_no_admin(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/setup');
    }

    /**
     * หน้า /setup แสดงได้เมื่อยังไม่มี admin
     */
    public function test_setup_page_loads(): void
    {
        $response = $this->get('/setup');

        $response->assertStatus(200);
        $response->assertSee('ตั้งค่าระบบ');
    }

    /**
     * หน้า /guide เข้าได้ ไม่ถูก redirect ไป setup
     */
    public function test_guide_accessible_without_admin(): void
    {
        $response = $this->get('/guide');

        $response->assertStatus(200);
    }

    /**
     * /api/health ทำงานได้
     */
    public function test_health_endpoint(): void
    {
        $response = $this->getJson('/api/health');

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'version', 'timestamp']);
    }

    /**
     * สร้าง Super Admin ผ่านหน้า /setup
     */
    public function test_can_create_super_admin_via_setup(): void
    {
        $response = $this->post('/setup', [
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', [
            'email' => 'admin@test.com',
            'is_super_admin' => true,
        ]);
    }

    /**
     * หน้า /setup ไม่ให้เข้าเมื่อมี admin แล้ว
     */
    public function test_setup_blocked_after_admin_created(): void
    {
        User::factory()->create(['is_super_admin' => true]);

        $response = $this->get('/setup');

        $response->assertRedirect('/login');
    }
}
