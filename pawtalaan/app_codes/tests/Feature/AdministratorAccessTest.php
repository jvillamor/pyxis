<?php

namespace Tests\Feature;

use App\Models\AdministratorAccess;
use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdministratorAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_ordinary_user_cannot_open_site_settings(): void
    {
        $this->actingAs(User::factory()->create())->get('/admin')->assertForbidden();
    }

    public function test_an_active_administrator_can_update_a_setting(): void
    {
        $this->seed(SiteSettingSeeder::class);
        $user = User::factory()->create();
        AdministratorAccess::create(['user_id' => $user->id, 'status' => 'active', 'granted_at' => now()]);
        $setting = SiteSetting::where('key', 'archive.retention_months')->firstOrFail();

        $this->actingAs($user)->get('/admin')->assertOk()->assertSee('Site settings');
        $this->actingAs($user)->put('/admin/settings/'.$setting->id, ['value' => '4'])->assertRedirect();
        $this->assertDatabaseHas('site_settings', ['id' => $setting->id, 'value' => '4', 'updated_by' => $user->id]);
    }
}
