<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function imageLink(){
        $lang = app()->getLocale();
        if($lang=='my' && $this->image_mm ){
            return asset('storage/'.$this->image_mm);
        }else if($lang=='zh' && $this->image_ch ){
            return asset('storage/'.$this->image_ch);
        }
        return asset('storage/'.$this->image);
    }
}
