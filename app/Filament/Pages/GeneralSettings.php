<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings as Settings;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class GeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = Settings::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 7;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name')->required()->columnSpanFull(),
                Textarea::make('site_description')->required()->columnSpanFull(),
                //FileUpload::make('site_image')->columnSpanFull(),
                //FileUpload::make('site_favicon')->columnSpanFull(),
                TimezoneSelect::make('timezone')->required()->columnSpanFull(),
                FileUpload::make('ads_image1'),
                FileUpload::make('ads_image2'),
                FileUpload::make('ads_image3'),
                FileUpload::make('live_now_banner'),
                
                TextInput::make('ads_image1_link'),
                TextInput::make('ads_image2_link'),
                TextInput::make('ads_image3_link'),
                TextInput::make('live_now_banner_link'),

                TextInput::make('live_match_title')->columnSpanFull(),
                Textarea::make('live_match_description')->columnSpanFull(),
                TextInput::make('live_schedule_title')->columnSpanFull(),
                Textarea::make('live_schedule_description')->columnSpanFull(),
                
            ])->columns(3);
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();
        if($user){
            $roles = $user->roles->pluck("name")->toArray();   
            return in_array("super_admin", $roles);     
        }        
        return false;
    }
}
