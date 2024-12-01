<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportMatch extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'live_link',
        'live_now',
        'image',
        'sport_team1_id',
        'sport_team2_id',
        'sport_type_id',
        'sport_season_id',
        'sport_league_id',
        'sport_stage_id',
        'status',
        'date_time',
        'sort',
        'description',
        'live_embed',
        'score1',
        'score2',
    ];

    protected $appends = [
        'image_path',
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
                'source' => 'title'
            ]
        ];
    }

    public function sportType()
    {
        return $this->belongsTo(SportType::class);
    }

    public function sportTeam1()
    {
        return $this->belongsTo(SportTeam::class,'sport_team1_id');
    }

    public function sportTeam2()
    {
        return $this->belongsTo(SportTeam::class,'sport_team2_id');
    }

    public function sportSeason()
    {
        return $this->belongsTo(SportSeason::class);
    }

    public function sportStage()
    {
        return $this->belongsTo(SportStage::class);
    }

    public function sportLeague()
    {
        return $this->belongsTo(SportLeague::class);
    }

    public function getImagePathAttribute()
    {
        return asset('storage/'.$this->image);
    }

    public function isIframe(){
        return strpos($this->live_embed , 'iframe') !== false;
    }

    public function isM3u8(){
        return strpos($this->live_embed , '.m3u8') !== false;
    }
}
