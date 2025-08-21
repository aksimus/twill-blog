<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// локализованные маршруты
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localize',
        'localizationRedirect',
        'localeViewPath',
        // session/cookie редиректы убраны, чтобы / всегда был EN
    ],
], function () {
    Route::get('/', fn () => view('home'))->name('home');
    Route::get('/about', fn () => view('about'))->name('about');
});