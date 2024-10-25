<?php

namespace App\Filament\Resources\ImageSliderResource\Pages;

use App\Filament\Resources\ImageSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImageSliders extends ListRecords
{
    protected static string $resource = ImageSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
