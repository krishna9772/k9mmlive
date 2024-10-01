<?php

namespace App\Filament\Resources\SportTeamResource\Pages;

use App\Filament\Resources\SportTeamResource;
use App\Filament\Traits\ListTabs;
use App\Models\SportTeam;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSportTeams extends ListRecords
{
    use ListTabs;
    protected static string $resource = SportTeamResource::class;

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
        return $this->getListTabs(SportTeam::class);
    }
}
