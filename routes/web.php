<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;

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

// User
Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('product');
    Route::get('product/detail/{id}', 'show');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart');
    Route::get('/cart/delete/{id}', 'destroy');

    Route::post('/add-to-cart', 'store')->name('cart.add');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.view');
        Route::get('/add-category', 'create')->name('category.form');
        Route::get('/category/{id}/edit', 'edit');
        
        Route::put('/category/{id}', 'update');
        Route::post('/category', 'store')->name('category.add');
        Route::post('/category/delete', 'destroy')->name('category.destroy');
    });
    
    Route::controller(AdminProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product.view');
        Route::get('/add-product', 'create')->name('product.form');
        Route::get('/product/{id}/show', 'show');
        Route::get('/product/{id}/edit', 'edit');
        
        Route::put('/product/{id}', 'update');
        Route::post('/product', 'store')->name('product.add');
        Route::post('/product/delete', 'destroy')->name('product.destroy');
    });
});