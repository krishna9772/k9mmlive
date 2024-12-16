<?php

namespace Firefly\FilamentBlog\Models;

use App\Helpers\AppHelper;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Firefly\FilamentBlog\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'language',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, config('filamentblog.tables.prefix').'category_'.config('filamentblog.tables.prefix').'post');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->live(true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {

                    $set('slug', Str::slug($state));
                })
                ->unique(config('filamentblog.tables.prefix').'categories', 'name', null, 'id')
                ->required()
                ->maxLength(155),

            TextInput::make('slug')
                ->unique(config('filamentblog.tables.prefix').'categories', 'slug', null, 'id')
                ->readOnly()
                ->maxLength(255),
            Select::make('language')
                ->options(AppHelper::languages())
                ->searchable()
                ->required()
                ->default(AppHelper::defaultLanguage()),
            TextInput::make('meta_title'),                
            Textarea::make('meta_description'),
            TextInput::make('meta_keywords'),
            ];            
    }

    protected static function newFactory()
    {
        return new CategoryFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'categories';
    }
}
