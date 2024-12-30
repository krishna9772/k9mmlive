<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportLeague extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'sport_type_id',
        'name',
        'slug',
        'image',
        'status',
        'description',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $appends = [
        'image_path',
    ];


    public function sportType()
    {
        return $this->belongsTo(SportType::class);
    }

    public function getImagePathAttribute()
    {
        return asset('storage/'.$this->image);
    }

}
