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
        // Check for 'lang' parameter in the URL
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            Session::put('lang', $lang); // Store in session
            //Cookie::make('lang',$lang);
        } else {
            // Use session-stored language or default to 'en'                    
            $lang = Session::get('lang');
            if($lang==null){
                $lang = Session::put('lang', 'en');
                $lang = 'en';
            }                
            //$lang = Cookie::get('lang', 'en');
        }
        // Set application locale
        App::setLocale($lang);

        return $next($request);
    }
}
