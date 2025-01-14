<?php

if (!function_exists('lang_route')) {
    function lang_route($name, $parameters = [], $absolute = true)
    {
        $parameters = array_merge(['lang' => app()->getLocale()], $parameters);
        return route($name, $parameters, $absolute);
    }
}

if (!function_exists('switch_language_url')) {
    function switch_language_url($newLang)
    {
        $currentUrl = url()->current();
        $currentLang = request()->segment(1);
        $query = request()->getQueryString(); // Get the query string

        $newUrl = str_replace("/$currentLang", "/$newLang", $currentUrl);
        return $query ? "$newUrl?$query" : $newUrl;
    }
}