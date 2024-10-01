<?php

namespace App\Filament\Resources\SportSeasonResource\Pages;

use App\Filament\Resources\SportSeasonResource;
use App\Filament\Traits\ListTabs;
use App\Models\SportSeason;
use App\Models\SportType;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ListSportSeasons extends ListRecords
{
    use ListTabs;
    protected static string $resource = SportSeasonResource::class;

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
        return $this->getListTabs(SportSeason::class);
    }
}
