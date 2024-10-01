<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\SportSeasonResource\Pages;
use App\Filament\Resources\SportSeasonResource\RelationManagers;
use App\Models\SportSeason;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SportSeasonResource extends Resource
{
    protected static ?string $model = SportSeason::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-asia-australia';

    protected static ?string $navigationGroup = 'Sport';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('sport_type_id')
                    ->required()
                    ->relationship('sportType', 'name', fn (Builder $query): Builder => $query->where('status', Status::Active->value))
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options(Status::array())
                    ->searchable()
                    ->required()
                    ->default(Status::Active->value),
                Forms\Components\FileUpload::make('image')
                    ->image()->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sportType.name')
                    ->searchable()
                    ->sortable()
                    ->label('Sport Type'),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->searchable(),
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
            ]);
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
            'index' => Pages\ListSportSeasons::route('/'),
            'create' => Pages\CreateSportSeason::route('/create'),
            'edit' => Pages\EditSportSeason::route('/{record}/edit'),
        ];
    }
}
