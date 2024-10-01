<?php

namespace App\Filament\Resources\SportLeagueResource\Pages;

use App\Filament\Resources\SportLeagueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSportLeague extends EditRecord
{
    protected static string $resource = SportLeagueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
