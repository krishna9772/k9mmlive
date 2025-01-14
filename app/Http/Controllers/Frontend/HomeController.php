<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Status;
use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\ImageSlider;
use App\Models\SocialLink;
use App\Models\SportLeague;
use App\Models\SportMatch;
use App\Models\SportTeam;
use App\Models\SportType;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Firefly\FilamentBlog\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $sliders = ImageSlider::where('status', Status::Active->value)->get();
        $types = SportType::where('status', Status::Active->value)->get();
        $cat_id = AppHelper::getNewsCatId();

        $date = $request->date?? null;
        if($date) $date=Carbon::parse($date);

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();
        
        $matches = SportMatch::where('status', Status::Active->value);
        if($date){
            $matches = $matches->whereDate('date_time', $date);
        }
        $matches = $matches->get();
        $socials = SocialLink::where('status', Status::Active->value)->orderBy('sort')->get();
        AppHelper::setupSEO();                
        return view('frontend.home', compact('date','sliders','types','latest','popular','matches','socials'));
    }

    public function sportnews(Request $request){
        $parent = AppHelper::getSportNewsCategory();
        $cat_id = AppHelper::getNewsCatId();
        $posts = Post::whereHas('categories', function ($query) use ($parent) {
            return $query->where('category_id', '=', $parent->id);
        })->where('language',app()->getLocale())->where('status', 'published')->orderBy('id', 'desc')->paginate(env('PAGE_SIZE',8));

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();
        AppHelper::setupSEO();
        return view('frontend.post-list', compact('parent','posts','latest','popular','trendings','tags'));
    }

    public function post(Request $request){
        $slug = $request->slug;
        $post = Post::where('slug',$slug)->published()->firstorfail();
        $cat_id = AppHelper::getNewsCatId();
        $category = $post->categories->first();
        $parent = $post;
        if(!$post){
            abort(404);
        }

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();

        $is_video = $category->slug=='videos';

        AppHelper::setupSEO([
            'title' => $post->seoDetail?->title,
            'description' => $post->seoDetail?->description,
            'keywords' => $post->seoDetail->keywords ?? [],
            'image' => $post->featurePhoto,
            'url' => url()->current(),            
        ]);
        
        $shareButton = ShareSnippet::query()->active()->first();
        $post->load(['user', 'categories', 'tags', 'comments' => fn ($query) => $query->approved(), 'comments.user']);

        //$post->seoDetail->keywords ?? [];

        return view('frontend.post', compact('shareButton','category','parent','post','latest','popular','trendings','tags','is_video'));
    }

    public function tags(Request $request){
        $slug = $request->slug;
        $parent = Tag::where('slug',$slug)->first();
        $cat_id = AppHelper::getNewsCatId();
        if(!$parent){
            abort(404);
        }

        $posts = Post::whereHas('tags', function ($query) use ($parent) {
            return $query->where('tag_id', '=', $parent->id);
        })->where('status', 'published')->orderBy('id', 'desc')->paginate(env('PAGE_SIZE',8));

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();

        $is_video = $parent->slug=='videos';

        AppHelper::setupSEO();

        return view('frontend.post-list', compact('parent','posts','latest','popular','trendings','tags','is_video'));
    }

    public function category(Request $request){
        $slug = $request->slug;
        
        $parent = Category::where('slug',$slug)->first();
        if(!$parent){
            abort(404);
        }
        $cat_id = AppHelper::getNewsCatId();
        $posts = Post::whereHas('categories', function ($query) use ($parent) {
            return $query->where('category_id', '=', $parent->id);
        })->where('language',app()->getLocale())->where('status', 'published')->orderBy('id', 'desc')->paginate(8);

        $latest = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();
        $is_video = $parent->slug=='videos';
        AppHelper::setupSEO([
            'title' => $parent->meta_title?:config('seotools.meta.defaults.title'),
            'description' => $parent->meta_description?:config('seotools.meta.defaults.description'),
            'keywords' => $parent->meta_keywords?:config('seotools.meta.defaults.keywords'),
        ],false);
        return view('frontend.post-list', compact('parent','posts','latest','popular','trendings','tags','is_video'));
    }

    public function liveSchedule(Request $request){
        $date = $_GET['date']?? null;
        if($date){
            try{
                $date = CarbonImmutable::parse($date);
            }catch (\Exception $exception){
                $date = null;
            }
        }

        if(!$date){
            $date = CarbonImmutable::now() ;
        }

        $footballs = AppHelper::footBallMatches($date);
        $boxings = AppHelper::boxingMatches($date);
        $esports = AppHelper::esportMatches($date);
        $futsals = AppHelper::futsalMatches($date);
        $cat_id = AppHelper::getNewsCatId();

        $parent = AppHelper::getSportNewsCategory();

        $latest = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();

        //$ads1 = AppHelper::settings("ads_image1");

        AppHelper::setupSEO([
            'title' => AppHelper::settings("live_schedule_title") ?:config('seotools.meta.defaults.title'),
            'description' => AppHelper::settings("live_schedule_description") ?:config('seotools.meta.defaults.description'),            
        ],false);
        return view('frontend.live-schedule', compact('futsals','footballs','boxings','esports','date','parent','latest','popular','trendings','tags'));
    }

    public function liveMatch(Request $request){

        $matches = SportMatch::where('status', Status::Active->value)->where('live_now',1)->orderBy('date_time','desc')->paginate(env('PAGE_SIZE',10));
        $cat_id = AppHelper::getNewsCatId();
        $parent = AppHelper::getSportNewsCategory();

        $latest = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();
        AppHelper::setupSEO([
            'title' => AppHelper::settings("live_match_title") ?:config('seotools.meta.defaults.title'),
            'description' => AppHelper::settings("live_match_description") ?:config('seotools.meta.defaults.description'),            
        ],false);
        return view('frontend.live-match', compact('matches','parent','latest','popular','trendings','tags'));
    }

    public function aboutUs(Request $request){

        $post = Post::where('slug','about-us')->where('status', 'published')->firstOrFail();
        $cat_id = AppHelper::getNewsCatId();
        $parent = AppHelper::getSportNewsCategory();

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();

        AppHelper::setupSEO([
            'title' => $post->seoDetail?->title,
            'description' => $post->seoDetail?->description,
            'keywords' => $post->seoDetail->keywords ?? [],
        ],false);
        return view('frontend.about-us', compact('post','parent','latest','popular','trendings','tags'));
    }

    public function advertise(Request $request){

        $post = Post::where('slug','advertise')->where('status', 'published')->firstOrFail();
        $cat_id = AppHelper::getNewsCatId();
        $parent = AppHelper::getSportNewsCategory();

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();
        
        AppHelper::setupSEO([
            'title' => $post->seoDetail?->title,
            'description' => $post->seoDetail?->description,
            'keywords' => $post->seoDetail->keywords ?? [],
        ],false);
        return view('frontend.advertise', compact('post','parent','latest','popular','trendings','tags'));
    }

    public function leagues(Request $request){
        $slug = $request->slug;
        $league = SportLeague::where('slug',$slug)->firstorfail();

        $date = $_GET['date']?? null;
        $cat_id = AppHelper::getNewsCatId();
        if($date){
            try{
                $date = CarbonImmutable::parse($date);
            }catch (\Exception $exception){
                $date = null;
            }
        }

        if(!$date){
            $date = CarbonImmutable::now() ;
        }
        $matches = SportMatch::where('status', Status::Active->value)->where('sport_league_id',$league->id)->orderBy('date_time','desc')->get();

        $parent = AppHelper::getSportNewsCategory();
        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(3)->orderBy('id', 'desc')->get();
        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();
        AppHelper::setupSEO(
            [
                'title' => $league->name,
                'description' => Str::limit(strip_tags($league->description), 255),   
                'image' => asset($league->image_path),                   
                'url' => url()->current(), 
            ]
        );
        return view('frontend.leagues', compact('matches','league','parent','latest','popular','trendings','tags'));
    }

    public function search(Request $request,$q=null){
        $posts = Post::published()->where(function($query){
            $query->where('title','like','%'.$_GET['q'].'%')
                ->orWhere('sub_title','like','%'.$_GET['q'].'%')
                ->orWhere('body','like','%'.$_GET['q'].'%');
        })->where('language',app()->getLocale())->where('slug','!=','about-us')->orderBy('id', 'desc')->get();

        $matches = SportMatch::where('status', Status::Active->value)->where(function($query){
            $query->where('title','like','%'.$_GET['q'].'%');
        })->get();

        $cat_id = AppHelper::getNewsCatId();
        $parent = AppHelper::getSportNewsCategory();
        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->where('language',app()->getLocale())->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->limit(3)->orderBy('id', 'desc')->get();
        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();
        AppHelper::setupSEO();
        return view('frontend.search', compact('posts','matches','parent','latest','popular','trendings','tags'));
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|min:3|max:500',
        ]);

        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => $request->user()->id,
            'approved' => true,
        ]);
        AppHelper::setupSEO();
        return redirect()
            ->route('frontend.posts.show', ["lang"=>app()->getLocale(),"slug"=>$post->slug])
            ->with('success', 'Comment submitted successfully.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        AppHelper::setupSEO();
        return redirect('/');
    }


    public function sportLiveMatch(Request $request){
        $slug = $request->slug;
        $match = SportMatch::where('slug',$slug)->firstorfail();
        $cat_id = AppHelper::getNewsCatId();        
        if(!$match){
            abort(404);
        }

        $latest = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->whereHas('categories', function ($query) use ($cat_id) {
            if($cat_id)
                return $query->where('category_id', '=', $cat_id);
            return $query;
        })->where('language',app()->getLocale())->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();

        AppHelper::setupSEO([
            'title' => $match->title,
            'description' => Str::limit(strip_tags($match->description), 255),   
            'image' => asset($match->image_path),                   
            'url' => url()->current(),            
        ]);
        
        $shareButton = ShareSnippet::query()->active()->first();        
        //$post->seoDetail->keywords ?? [];

        return view('frontend.sport-live-match', compact('match','shareButton','latest','popular','trendings','tags'));
    }
}
