<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AIQueryController;



Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('register', [AuthenticationController::class, 'register'])->name('register');

//authenticated routes
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('get_user', [AuthenticationController::class, 'userInfo'])->name('get_user');
    Route::post('/ai_query', [AIQueryController::class, 'handle']);
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/lowstock', [ProductController::class, 'lowstock'])->name('product.lowstock');
    Route::post('/products/create', [ProductController::class, 'createproduct'])->middleware('is_admin')->name('createproduct');
    Route::get('/products/view/{id}', [ProductController::class, 'viewproduct'])->name('viewproduct');
    Route::get('/products/delete/{id}', [ProductController::class, 'deleteproduct'])->middleware('is_admin')->name('deleteproduct');
    Route::get('/products/avail/{id}', [ProductController::class, 'availproduct'])->middleware('is_admin')->name('availproduct');
    Route::get('/products/unavail/{id}', [ProductController::class, 'unavailproduct'])->middleware('is_admin')->name('unavailproduct');
    Route::post('/products/update/{id}', [ProductController::class, 'updateproduct'])->middleware('is_admin')->name('updateproduct');
    Route::get('/products/export', [ProductController::class, 'export'])->name('product.export');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
});
