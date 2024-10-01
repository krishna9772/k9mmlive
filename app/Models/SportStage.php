<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_type_id',
        'name',
        'status',
        'description',
    ];

    public function sportType()
    {
        return $this->belongsTo(SportType::class);
    }
}
