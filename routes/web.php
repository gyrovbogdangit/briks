<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\Web\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
/* Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/comparison', [ComparisonController::class, 'index'])->name('comparison');
Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites');

Route::get('/catalog/{productType:slug}/{category:slug}/{subcategory:slug}', [ProductController::class, 'index'])->name('products.index');
Route::get('/catalog/{productType:slug}/{category:slug}/{subcategory:slug}/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/{page:slug}', [PageController::class, 'index'])->name('page');
