<?php
namespace App\Helpers;

use App\Enums\Status;
use App\Models\SocialLink;
use App\Models\SportMatch;
use App\Models\SportType;
use App\Settings\GeneralSettings;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class AppHelper
{
     public static function socialLinks()
     {
        return SocialLink::where('status', Status::Active->value)->orderBy('sort')->get();
     }

     public static function footBallMatches($date=null,$limit=null)
     {
        $type = SportType::where('status', Status::Active->value)->whereIn('name', ['football',"Football",'Foot Ball','foot ball'])->first();
        $query = SportMatch::where('status', Status::Active->value)->where('sport_type_id', $type->id??0);
        if($limit){
            $query = $query->limit($limit);
        }
        if($date){
            $query = $query->whereDate('date_time','=',$date);
        }
        return $query->orderBy('date_time')->get();
     }

     public static function boxingMatches($date=null,$limit=null)
     {
        //return self::footBallMatches($date,$limit);
        $type = SportType::where('status', Status::Active->value)->whereIn('name', ['boxing',"Boxing"])->first();
        $query = SportMatch::where('status', Status::Active->value)->where('sport_type_id', $type->id??0);
        if($limit){
            $query = $query->limit($limit);
        }
        if($date){
            $query = $query->whereDate('date_time','=',$date);
        }
        return $query->orderBy('date_time')->get();
     }

     public static function esportMatches($date=null,$limit=null)
     {
        //return self::footBallMatches($date,$limit);

        $type = SportType::where('status', Status::Active->value)->whereIn('name', ['esport',"Esport"])->first();
        $query = SportMatch::where('status', Status::Active->value)->where('sport_type_id', $type->id??0);
        if($limit){
            $query = $query->limit($limit);
        }
        if($date){
            $query = $query->whereDate('date_time','=',$date);
        }
        return $query->orderBy('date_time')->get();
     }

     public static function getSportNewsCategory(){

        return Category::where('slug', 'sport-news')->first();
     }

     public static function getNewsCatId(){
        $cat = self::getSportNewsCategory();
        return $cat? $cat->id : null;
     }

     public static function getVideosCategory(){

        return Category::where('slug', 'videos')->first();
     }

     public static function getTrendingNews($limit=1){
        return Post::whereHas('tags',function($query){
            $query->where('slug','trending-now');
        })->where('status', 'published')->where('language',Session::get('lang'))->orderBy('id', 'desc')->limit($limit)->get();
     }

     public static function settings($name)
     {
        return app(GeneralSettings::class)->$name??null;
     }


     public static function instance()
     {
         return new AppHelper();
     }

     public static function isMM(){
        return Session::get('lang') == 'my';
     }

     public static function languages(){
        return [
            'en' => 'English',
            'my' => 'Myanmar',
            'zh' => 'Chinese',
        ];
     }
     public static function defaultLanguage(){
      return 'en';
     }

     public static function setupSEO($data=[]){
      SEOMeta::setTitle($data['title'] ?? config('seotools.meta.defaults.title'));
      SEOMeta::setDescription($data['description'] ?? config('seotools.meta.defaults.description'));
      SEOMeta::setCanonical($data['canonical'] ?? url()->current());
      SEOMeta::setKeywords($data['keywords'] ?? config('seotools.meta.defaults.keywords'));

      OpenGraph::setTitle($data['title'] ?? config('seotools.meta.defaults.title'));
      OpenGraph::setDescription($data['description'] ?? config('seotools.meta.defaults.description'));
      OpenGraph::setUrl($data['url'] ?? url()->current());
      OpenGraph::addImage($data['image'] ?? config('seotools.meta.defaults.image'));
      
      TwitterCard::setSite("@k9mmlive");
      TwitterCard::setTitle($data['title'] ?? config('seotools.meta.defaults.title'));
      TwitterCard::setDescription($data['description'] ?? config('seotools.meta.defaults.description'));
      TwitterCard::setImage($data['image'] ?? config('seotools.meta.defaults.image'));
      TwitterCard::setUrl($data['url'] ?? url()->current());
      TwitterCard::setType('summary_large_image');   
      TwitterCard::addValue("creator","@k9winsportsmedia");        
      
     }
}
