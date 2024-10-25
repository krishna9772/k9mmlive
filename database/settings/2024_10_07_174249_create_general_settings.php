<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'K9MM Live');
        $this->migrator->add('general.site_description', 'Site Description');
        $this->migrator->add('general.site_image', '');
        $this->migrator->add('general.site_favicon', '');
        $this->migrator->add('general.timezone', 'Asia/Yangon');
        $this->migrator->add('general.ads_nullable_image1', '');
        $this->migrator->add('general.ads_nullable_image2', '');
        $this->migrator->add('general.ads_nullable_image3', '');
    }
};
