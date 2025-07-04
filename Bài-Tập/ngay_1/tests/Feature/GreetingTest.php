<?php
// Test kiểm tra TranslatorInterface trả về đúng thông báo theo locale
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GreetingTest extends TestCase
{
    /** @test */
    public function it_returns_vietnamese_greeting_when_locale_is_vi()
    {
        // Đặt locale là vi
        config(['app.locale' => 'vi']);
        $response = $this->get('/greeting');
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Xin chào, quản trị viên',
            ]);
    }

    /** @test */
    public function it_returns_english_greeting_when_locale_is_en()
    {
        // Đặt locale là en
        config(['app.locale' => 'en']);
        $response = $this->get('/greeting');
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Hello, admin',
            ]);
    }
}
