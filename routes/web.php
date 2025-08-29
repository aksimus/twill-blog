<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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



// Use Laravel Localization but without problematic middleware
Route::group([
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [
		'localeViewPath'
	]
], function() {
	// Blog routes
	Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
	Route::get('/blog/category/{slug}', [\App\Http\Controllers\BlogController::class, 'category'])->name('blog.category');
	Route::get('/blog/tags', [\App\Http\Controllers\BlogController::class, 'tags'])->name('blog.tags');
	Route::get('/blog/tag/{slug}', [\App\Http\Controllers\BlogController::class, 'tag'])->name('blog.tag');
	Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.post');

	// Page routes
	Route::get('/', [\App\Http\Controllers\PageDisplayController::class, 'home'])->name('frontend.home');
	//Route::get('/', [\App\Http\Controllers\PageDisplayController::class, 'home'])->name('home'); // Alias for home
	Route::get('{slug}', [\App\Http\Controllers\PageDisplayController::class, 'show'])->name('frontend.page');
});
