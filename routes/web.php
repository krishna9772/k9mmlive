<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController ::class, 'index'])->name('frontend.home');
Route::get('/language', function () {

})->name('language');

//Route::get('/sport-news', [HomeController ::class, 'sportnews'])->name('frontend.sportnews');


Route::get('/live-match', [HomeController ::class, 'liveMatch'])->name('frontend.live-match');
Route::get('/live-schedule', [HomeController ::class, 'liveSchedule'])->name('frontend.live-schedule');
Route::get('/tag/{slug}', [HomeController ::class, 'tags'])->name('frontend.tags.show');
Route::get('/{slug}', [HomeController ::class, 'post'])->name('frontend.posts.show');
Route::get('/category/{slug}', [HomeController ::class, 'category'])->name('frontend.categories.show');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
