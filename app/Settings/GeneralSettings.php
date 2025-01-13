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
    public ?string $live_now_banner;

    public ?string $ads_image1_link;
    public ?string $ads_image2_link;
    public ?string $ads_image3_link;
    public ?string $live_now_banner_link;
    

    public ?string $live_match_title;
    public ?string $live_match_description;
    
    public ?string $live_schedule_title;
    public ?string $live_schedule_description;
    

    public static function group(): string
    {
        return 'general';
    }
}
