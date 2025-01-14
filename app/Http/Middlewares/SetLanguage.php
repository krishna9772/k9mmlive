<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    public function handle($request, Closure $next)
    {
        $lang = $request->route('lang');

        if (in_array($lang, ['en', 'my', 'zh'])) { // Add supported languages            
            App::setLocale($lang);
        } else {
            //return redirect()->route('frontend.home',['lang' => 'en']);
            //abort(404); // Handle unsupported languages
            App::setLocale('en');
        }

        return $next($request);
    }
}
