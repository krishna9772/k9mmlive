<?php

namespace App\Filament\Resources\ImageSliderResource\Pages;

use App\Filament\Resources\ImageSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageSlider extends EditRecord
{
    protected static string $resource = ImageSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
