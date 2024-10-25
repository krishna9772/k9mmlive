<?php

namespace App\Filament\Resources\SportMatchResource\Pages;

use App\Filament\Resources\SportMatchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSportMatch extends EditRecord
{
    protected static string $resource = SportMatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
