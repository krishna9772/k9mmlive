<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', function () {
    return redirect('/en');
});

Route::group(['prefix' => '{lang}'], function () {
    Route::get('/', [HomeController ::class, 'index'])->name('frontend.home');
    Route::get('/language', function () {

    })->name('language');

    //Route::get('/sport-news', [HomeController ::class, 'sportnews'])->name('frontend.sportnews');

    Route::middleware(['auth', 'auth.session'])->group(function () {
        Route::post('/logout', [HomeController ::class, 'logout'])->name('logout');
        Route::get('/live-match', [HomeController ::class, 'liveMatch'])->name('frontend.live-match');
        Route::get('/live-schedule', [HomeController ::class, 'liveSchedule'])->name('frontend.live-schedule');
    });


    Route::get('/search', [HomeController ::class, 'search'])->name('frontend.search');
    Route::get('/leagues/{slug}', [HomeController ::class, 'leagues'])->name('frontend.leagues.show');
    Route::get('/about-us', [HomeController ::class, 'aboutUs'])->name('frontend.aboutus');
    Route::get('/about-us/advertise', [HomeController ::class, 'advertise'])->name('frontend.advertise');
    Route::get('/tag/{slug}', [HomeController ::class, 'tags'])->name('frontend.tags.show');
    Route::get('/category/{slug}', [HomeController ::class, 'category'])->name('frontend.categories.show');
    Route::post('/comment/{post:slug}/store', [HomeController::class, 'comment'])->middleware('auth')->name('comment.store');
    Route::get('/live-matches/{slug}', [HomeController ::class, 'sportLiveMatch'])->name('frontend.sport.live-match');
    Route::get('/{slug}', [HomeController ::class, 'post'])->name('frontend.posts.show');

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            //return view('dashboard');
            return redirect(route('frontend.home'));
        })->name('dashboard');    
    });
});