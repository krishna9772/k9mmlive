<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'icon',
        'description',
    ];

    public function sportTeams()
    {
        return $this->hasMany(SportTeam::class);
    }

    public function sportLeagues()
    {
        return $this->hasMany(SportLeague::class);
    }
}
