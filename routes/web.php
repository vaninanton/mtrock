<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', IndexController::class)->name('index');

Route::group([
    'as' => 'cart.',
    'prefix' => 'cart/',
], function () {
    Route::put('/', [CartController::class, 'put'])->name('put');
});

// Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/store/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/store/brand/{brand}', [BrandController::class, 'show'])->name('brand.show');

Route::get('/store/{category}', CategoryController::class)->name('category');
Route::get('/store/{category}/{product}.html', ProductController::class)->name('product');
// Route::get('/store/{category_path}', CategoryController::class)->name('category')->where('category_path', '.*');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}.html', [NewsController::class, 'show'])->name('news.show')->missing(fn () => redirect(route('news.index')));

Route::get('/{page}', PageController::class)->name('page');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
