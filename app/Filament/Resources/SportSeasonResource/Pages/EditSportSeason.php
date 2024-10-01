<?php

namespace App\Filament\Resources\SportSeasonResource\Pages;

use App\Filament\Resources\SportSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSportSeason extends EditRecord
{
    protected static string $resource = SportSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
