<?php

use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', WelcomeController::class)->name('index');

// Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::name('cart.')->prefix('/cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::put('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::put('/product/{product:id}/add', [CartController::class, 'add'])->name('add');
    Route::post('/product/{product:id}/minus', [CartController::class, 'minus'])->name('minus');
    Route::post('/product/{product:id}/plus', [CartController::class, 'plus'])->name('plus');
    Route::delete('/product/{product:id}/delete', [CartController::class, 'delete'])->name('delete');
});

Route::prefix('/store')->group(function () {
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/{brand}', [BrandController::class, 'show'])->name('brand.show');
    Route::get('/{product}.html', ProductController::class)->name('product');
    Route::get('/{category}', CategoryController::class)->name('category');
    // Route::get('/{category_path}', CategoryController::class)->name('category')->where('category_path', '.*');
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

Route::name('backend.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/backend', IndexController::class)->name('index');
});

Route::get('/{page}.html', PageController::class)->name('page');

require __DIR__.'/auth.php';
