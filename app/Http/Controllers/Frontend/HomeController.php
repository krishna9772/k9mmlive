<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Status;
use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\ImageSlider;
use App\Models\SocialLink;
use App\Models\SportMatch;
use App\Models\SportType;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index()
    {
        $sliders = ImageSlider::where('status', Status::Active->value)->get();
        $types = SportType::where('status', Status::Active->value)->get();

        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();

        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();

        $matches = SportMatch::where('status', Status::Active->value)->get();
        $socials = SocialLink::where('status', Status::Active->value)->orderBy('sort')->get();

        return view('frontend.home', compact('sliders','types','latest','popular','matches','socials'));
    }

    public function sportnews(Request $request){
        $parent = AppHelper::getSportNewsCategory();

        $posts = Post::whereHas('categories', function ($query) use ($parent) {
            return $query->where('category_id', '=', $parent->id);
        })->where('status', 'published')->orderBy('id', 'desc')->paginate(env('PAGE_SIZE',10));

        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();

        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();

        return view('frontend.post-list', compact('parent','posts','latest','popular','trendings','tags'));
    }

    public function post(Request $request,$slug){
        $post = Post::where('slug',$slug)->published()->first();
        $category = $post->categories->first();
        $parent = $post;
        if(!$post){
            abort(404);
        }
        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();

        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();

        $is_video = $category->slug=='videos';

        return view('frontend.post', compact('category','parent','post','latest','popular','trendings','tags','is_video'));
    }

    public function tags(Request $request,$slug){
        $parent = Tag::where('slug',$slug)->first();
        if(!$parent){
            abort(404);
        }

        $posts = Post::whereHas('tags', function ($query) use ($parent) {
            return $query->where('tag_id', '=', $parent->id);
        })->where('status', 'published')->orderBy('id', 'desc')->paginate(env('PAGE_SIZE',10));

        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();

        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();

        $is_video = $parent->slug=='videos';

        return view('frontend.post-list', compact('parent','posts','latest','popular','trendings','tags','is_video'));
    }

    public function category(Request $request,$slug){
        $parent = Category::where('slug',$slug)->first();
        if(!$parent){
            abort(404);
        }

        $posts = Post::whereHas('categories', function ($query) use ($parent) {
            return $query->where('category_id', '=', $parent->id);
        })->where('status', 'published')->orderBy('id', 'desc')->paginate(env('PAGE_SIZE',10));

        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();

        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();

        $trendings = AppHelper::getTrendingNews(5);

        $tags = Tag::get();
        $is_video = $parent->slug=='videos';

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

        $parent = AppHelper::getSportNewsCategory();
        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();
        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();

        return view('frontend.live-schedule', compact('footballs','boxings','esports','date','parent','latest','popular','trendings','tags'));
    }

    public function liveMatch(Request $request){

        $matches = SportMatch::where('status', Status::Active->value)->orderBy('date_time','desc')->paginate(env('PAGE_SIZE',10));

        $parent = AppHelper::getSportNewsCategory();
        $latest = Post::published()->limit(4)->orderBy('id', 'desc')->get();
        $popular = Post::published()->limit(3)->orderBy('id', 'desc')->get();
        $trendings = AppHelper::getTrendingNews(5);
        $tags = Tag::get();

        return view('frontend.live-match', compact('matches','parent','latest','popular','trendings','tags'));
    }
}
