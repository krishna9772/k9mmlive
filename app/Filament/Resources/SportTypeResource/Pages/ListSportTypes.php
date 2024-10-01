<?php

namespace App\Filament\Resources\SportTypeResource\Pages;

use App\Filament\Resources\SportTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSportTypes extends ListRecords
{
    protected static string $resource = SportTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
