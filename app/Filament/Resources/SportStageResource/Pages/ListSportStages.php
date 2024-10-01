<?php

namespace App\Filament\Resources\SportStageResource\Pages;

use App\Filament\Resources\SportStageResource;
use App\Filament\Traits\ListTabs;
use App\Models\SportStage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSportStages extends ListRecords
{
    use ListTabs;
    protected static string $resource = SportStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

        /**
     * @return array<string | int, Tab>
     */
    public function getTabs(): array
    {
        return $this->getListTabs(SportStage::class);
    }
}
