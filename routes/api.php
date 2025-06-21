<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\ProductController;


Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('register', [AuthenticationController::class, 'register'])->name('register');

//authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('get_user', [AuthenticationController::class, 'userInfo'])->name('get_user');
    Route::get('products', [ProductController::class, 'products'])->name('products');
    Route::post('createproduct', [ProductController::class, 'createproduct'])->name('createproduct');
    Route::get('viewproduct/{id}', [ProductController::class, 'viewproduct'])->name('viewproduct');
    Route::get('deleteproduct/{id}', [ProductController::class, 'deleteproduct'])->name('deleteproduct');
    Route::get('availproduct/{id}', [ProductController::class, 'availproduct'])->name('availproduct');
    Route::get('unavailproduct/{id}', [ProductController::class, 'unavailproduct'])->name('unavailproduct');
    Route::post('updateproduct/{id}', [ProductController::class, 'updateproduct'])->name('updateproduct');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
});
