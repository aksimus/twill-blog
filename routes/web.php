<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\BlogController;

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

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('category/{slug}', [BlogController::class, 'category'])->name('category');
        Route::get('tag/{slug}', [BlogController::class, 'tag'])->name('tag');
        Route::get('{slug}', [BlogController::class, 'show'])->name('show');
    });
});
