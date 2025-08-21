<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('blog.category');
        Route::get('/tag/{slug}', [TagController::class, 'show'])->name('blog.tag');
        Route::get('/{slug}', [PostController::class, 'show'])->name('blog.post');
    });
});
