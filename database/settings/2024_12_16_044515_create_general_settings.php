<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.live_match_title', '');
        $this->migrator->add('general.live_match_description', '');
        
        $this->migrator->add('general.live_schedule_title', '');
        $this->migrator->add('general.live_schedule_description', '');
        
    }
};
