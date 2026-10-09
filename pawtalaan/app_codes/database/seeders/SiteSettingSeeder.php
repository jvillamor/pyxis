<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'archive.current_month_offset', 'value' => '0', 'value_type' => 'integer', 'group' => 'archive', 'label' => 'Current month offset', 'description' => 'The current month is month zero.'],
            ['key' => 'archive.retention_months', 'value' => '3', 'value_type' => 'integer', 'group' => 'archive', 'label' => 'Active retention months', 'description' => 'Keep months one through three available before archive.'],
            ['key' => 'archive.delete_month', 'value' => '5', 'value_type' => 'integer', 'group' => 'archive', 'label' => 'Permanent deletion month', 'description' => 'Delete archived eligible data during month five unless the user is protected.'],
            ['key' => 'memorial.notification_enabled', 'value' => 'true', 'value_type' => 'boolean', 'group' => 'memorial', 'label' => 'Memorial notification', 'description' => 'Send the annual pet remembrance message.'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
