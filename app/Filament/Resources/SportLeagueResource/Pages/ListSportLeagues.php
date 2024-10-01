<?php

namespace App\Filament\Resources\SportLeagueResource\Pages;

use App\Enums\Status;
use App\Filament\Resources\SportLeagueResource;
use App\Filament\Traits\ListTabs;
use App\Models\SportLeague;
use App\Models\SportType;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListSportLeagues extends ListRecords
{
    use ListTabs;
    protected static string $resource = SportLeagueResource::class;

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
        return $this->getListTabs(SportLeague::class);
    }
}
