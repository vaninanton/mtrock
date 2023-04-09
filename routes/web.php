<?php

declare(strict_types=1);

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/store/palatki/palatki-msr', '/store/brand/msr');

Route::get('/', WelcomeController::class)->name('index');

// Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::post('callback', CallbackController::class)->name('callback.store');

Route::name('cart.')->prefix('/cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::put('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::put('/product/{product:id}/add', [CartController::class, 'add'])->name('add');
    Route::post('/product/{product:id}/minus', [CartController::class, 'minus'])->name('minus');
    Route::post('/product/{product:id}/plus', [CartController::class, 'plus'])->name('plus');
    Route::delete('/product/{product:id}/delete', [CartController::class, 'delete'])->name('delete');
});

Route::get('/search', SearchController::class)->name('search');

Route::prefix('/store')->group(function () {
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/{brand}', [BrandController::class, 'show'])->name('brand.show');
    Route::get('/{product}.html', ProductController::class)->name('product');
    Route::get('/{category}', CategoryController::class)->name('category')->middleware('stripemptyparams');

    Route::get('/{category_name}/{category}', [RedirectController::class, 'subCategoryExists']);
    Route::get('/{cateogy}/{subcategory_name}', [RedirectController::class, 'subCategory']);

    Route::get('/{category_name}/{subcategory_name}/{product}.html', [RedirectController::class, 'subproduct']);
    Route::get('/{category_name}/{product}.html', [RedirectController::class, 'product']);
});

Route::prefix('/news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{news}.html', [NewsController::class, 'show'])->name('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/{page}.html', PageController::class)->name('page');

require __DIR__.'/auth.php';
