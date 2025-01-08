<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'status',
        'link',
        'description',
    ];

    protected $appends = [
        'image_path',
    ];

    public function getImagePathAttribute()
    {
        return asset('storage/'.$this->image);
    }
}
