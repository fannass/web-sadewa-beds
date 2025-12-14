<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhatsAppSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create default settings
        Setting::set('whatsapp_number', '6281234567890');
        Setting::set('whatsapp_message', 'Halo, saya ingin bertanya mengenai ketersediaan kamar.');
        Setting::set('is_whatsapp_enabled', 'true');
    }

    /** @test */
    public function settings_can_be_saved_and_retrieved()
    {
        // Test set and get
        Setting::set('whatsapp_number', '6289876543210');
        $this->assertEquals('6289876543210', Setting::get('whatsapp_number'));

        Setting::set('whatsapp_message', 'Test message');
        $this->assertEquals('Test message', Setting::get('whatsapp_message'));

        Setting::set('is_whatsapp_enabled', 'false');
        $this->assertEquals('false', Setting::get('is_whatsapp_enabled'));
    }

    /** @test */
    public function whatsapp_settings_returns_correct_array()
    {
        $settings = Setting::getWhatsAppSettings();

        $this->assertArrayHasKey('whatsapp_number', $settings);
        $this->assertArrayHasKey('whatsapp_message', $settings);
        $this->assertArrayHasKey('is_whatsapp_enabled', $settings);
        $this->assertTrue($settings['is_whatsapp_enabled']);
    }

    /** @test */
    public function public_api_returns_correct_format()
    {
        $response = $this->getJson('/api/public/settings');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'whatsapp_enabled',
                'whatsapp_url'
            ]);
    }

    /** @test */
    public function public_api_returns_null_url_when_disabled()
    {
        Setting::set('is_whatsapp_enabled', 'false');
        Setting::clearWhatsAppCache();

        $response = $this->getJson('/api/public/settings');

        $response->assertStatus(200)
            ->assertJson([
                'whatsapp_enabled' => false,
                'whatsapp_url' => null
            ]);
    }

    /** @test */
    public function whatsapp_url_is_generated_correctly()
    {
        $url = WhatsAppService::generateLink();

        $this->assertNotNull($url);
        $this->assertStringStartsWith('https://wa.me/6281234567890', $url);
        $this->assertStringContainsString('text=', $url);
    }

    /** @test */
    public function whatsapp_url_includes_room_name_when_provided()
    {
        $url = WhatsAppService::generateLink(null, 'Kamar Melati 101');

        $this->assertNotNull($url);
        $this->assertStringContainsString('Kamar%20Melati%20101', $url);
    }

    /** @test */
    public function whatsapp_returns_null_when_disabled()
    {
        Setting::set('is_whatsapp_enabled', 'false');
        Setting::clearWhatsAppCache();

        $url = WhatsAppService::generateLink();

        $this->assertNull($url);
    }

    /** @test */
    public function admin_can_access_settings_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/settings/contact');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_update_whatsapp_settings()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/admin/settings/contact', [
            'whatsapp_number' => '6289999999999',
            'whatsapp_message' => 'Pesan baru untuk test',
            'is_whatsapp_enabled' => '1'
        ]);

        $response->assertRedirect('/admin/settings/contact');

        // Clear cache and verify
        Setting::clearWhatsAppCache();
        $this->assertEquals('6289999999999', Setting::get('whatsapp_number'));
        $this->assertEquals('Pesan baru untuk test', Setting::get('whatsapp_message'));
    }

    /** @test */
    public function whatsapp_number_must_be_numeric()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/admin/settings/contact', [
            'whatsapp_number' => 'not-a-number',
            'whatsapp_message' => 'Test message',
        ]);

        $response->assertSessionHasErrors('whatsapp_number');
    }

    /** @test */
    public function whatsapp_message_is_required()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->put('/admin/settings/contact', [
            'whatsapp_number' => '6281234567890',
            'whatsapp_message' => '',
        ]);

        $response->assertSessionHasErrors('whatsapp_message');
    }
}
