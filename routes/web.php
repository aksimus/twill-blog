<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('category/{slug}', [BlogController::class, 'category'])->name('blog.category');
        Route::get('tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
        Route::get('{slug}', [BlogController::class, 'post'])->name('blog.post');
    });

    Route::get('/', [\App\Http\Controllers\PageDisplayController::class, 'home'])->name('frontend.home');
    Route::get('{slug}', [\App\Http\Controllers\PageDisplayController::class, 'show'])->name('frontend.page');
});
