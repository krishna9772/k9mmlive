<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.ads_image1_link', '');        
        $this->migrator->add('general.ads_image2_link', '');        
        $this->migrator->add('general.ads_image3_link', '');        
        $this->migrator->add('general.live_now_banner_link', '');        
    }
};
