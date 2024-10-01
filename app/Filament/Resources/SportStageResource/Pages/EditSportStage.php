<?php

namespace App\Filament\Resources\SportStageResource\Pages;

use App\Filament\Resources\SportStageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSportStage extends EditRecord
{
    protected static string $resource = SportStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
