<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\SportMatchResource\Pages;
use App\Filament\Resources\SportMatchResource\RelationManagers;
use App\Models\SportLeague;
use App\Models\SportMatch;
use App\Models\SportSeason;
use App\Models\SportStage;
use App\Models\SportTeam;
use App\Models\SportType;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SportMatchResource extends Resource
{
    protected static ?string $model = SportMatch::class;

    protected static ?string $navigationIcon = 'fas-medal';

    protected static ?string $navigationGroup = 'Sport';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)->columnSpan(2),
                Select::make('status')
                    ->options(Status::array())
                    ->searchable()
                    ->required()
                    ->default(Status::Active->value),
                Select::make('sport_type_id')
                    ->relationship('sportType', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->searchable()
                    ->required()
                    ->preload()
                    ->label(__('Sport Type')),
                Select::make('sport_season_id')
                    //->relationship('sportSeason', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->options(function($get,$set){
                        return SportSeason::where('status', Status::Active->value)->where('sport_type_id', $get('sport_type_id'))->get()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required()
                    ->preload()
                    ->label(__('Sport Season')),
                Select::make('sport_league_id')
                    //->relationship('sportLeague', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->options(function($get,$set){
                        return SportLeague::where('status', Status::Active->value)->where('sport_type_id', $get('sport_type_id'))->get()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->label(__('Sport League')),
                Select::make('sport_stage_id')
                    //->relationship('sportStage', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->options(function($get,$set){
                        return SportStage::where('status', Status::Active->value)->where('sport_type_id', $get('sport_type_id'))->get()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->label(__('Sport Stage')),
                Forms\Components\TextInput::make('live_link')
                    ->maxLength(255)->url(),
                Forms\Components\Toggle::make('live_now')
                    ->required(),
                Select::make('sport_team1_id')
                    //->relationship('sportStage', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->options(function($get,$set){
                        return SportTeam::where('status', Status::Active->value)->where('sport_type_id', $get('sport_type_id'))->get()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->label(__('Sport Team 1'))
                    ->required(),
                Select::make('sport_team2_id')
                    //->relationship('sportStage', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->options(function($get,$set){
                        return SportTeam::where('status', Status::Active->value)->where('sport_type_id', $get('sport_type_id'))->where('id', '!=', $get('sport_team1_id'))->get()->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->label(__('Sport Team 2'))
                    ->required(),
                DateTimePicker::make('date_time')
                    ->required(),
                Forms\Components\TextInput::make('score1')
                    ->integer(),
                Forms\Components\TextInput::make('score2')
                    ->integer(),
                Textarea::make('live_embed')->columnSpan(2),
                Forms\Components\FileUpload::make('image')
                    ->image()->columnSpanFull(),
                RichEditor::make('description')                    
                    ->columnSpanFull(),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('live_now')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sportTeam1.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('Team 1')),
                Tables\Columns\TextColumn::make('sportTeam2.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('Team 2')),
                Tables\Columns\TextColumn::make('sportType.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('Sport Type')),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time')
                    ->dateTime()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSportMatches::route('/'),
            'create' => Pages\CreateSportMatch::route('/create'),
            'edit' => Pages\EditSportMatch::route('/{record}/edit'),
        ];
    }
}
