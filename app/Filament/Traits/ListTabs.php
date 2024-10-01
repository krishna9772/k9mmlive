<?php

namespace App\Filament\Traits;

use App\Models\SportType;
use Filament\Resources\Components\Tab;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

trait ListTabs
{
    public function getListTabs($class): array
    {
        $types = $class::select('sport_type_id', DB::raw('count(sport_type_id) as total'))->groupBy('sport_type_id')->pluck('total','sport_type_id')->all();
        return  array_merge([
            "All"=>Tab::make('All')->badge(array_sum($types))->icon('heroicon-o-folder'),
        ],array_map(fn ($type) => Tab::make($type['name'])->icon($type['icon']?? "heroicon-o-folder-open")->modifyQueryUsing( fn (Builder $query) => $query->where('sport_type_id', $type['id']) )
            ->badge($types[$type['id']]??0), SportType::get()->toArray()));
    }
}
