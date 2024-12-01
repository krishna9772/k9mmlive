<?php
/**
 * @see https://github.com/artesaos/seotools
 */
if(isset($_SERVER['HTTP_HOST'])){
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") 
    . "://{$_SERVER['HTTP_HOST']}" . dirname($_SERVER['SCRIPT_NAME']);    
}else $baseUrl = env('APP_URL');


return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "The Best Football Live Match in Myanmar", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Free live football matches and updates football news based in Myanmar. Premier League, La Liga, Bundesliga, Serie A, and other famous football leagues all around the world. Visit us for 24/7 football excitement!', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
            'image'        => $baseUrl.'/img/logo.png', // Set false to total remove 
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'The Best Football Live Match in Myanmar', // set false to total remove
            'description' => 'Free live football matches and updates football news based in Myanmar. Premier League, La Liga, Bundesliga, Serie A, and other famous football leagues all around the world. Visit us for 24/7 football excitement!', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'The Best Football Live Match in Myanmar', // set false to total remove
            'description' => 'Free live football matches and updates football news based in Myanmar. Premier League, La Liga, Bundesliga, Serie A, and other famous football leagues all around the world. Visit us for 24/7 football excitement!', // set false to total remove
            'url'         => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
