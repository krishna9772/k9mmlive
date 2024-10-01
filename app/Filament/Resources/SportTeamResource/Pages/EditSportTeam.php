<?php

namespace App\Filament\Resources\SportTeamResource\Pages;

use App\Filament\Resources\SportTeamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSportTeam extends EditRecord
{
    protected static string $resource = SportTeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
