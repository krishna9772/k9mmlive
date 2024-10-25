<?php
namespace App\Settings;
use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_description;
    public string $site_image;
    public string $site_favicon;
    public string $timezone;
    public ?string $ads_image1;
    public ?string $ads_image2;
    public ?string $ads_image3;

    public static function group(): string
    {
        return 'general';
    }
}
