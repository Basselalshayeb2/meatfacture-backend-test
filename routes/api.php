<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::prefix('/products')
    ->controller(ProductController::class)->group(function () {
        Route::get('/', 'getAllProducts');
    });

Route::prefix('/orders')
    ->middleware(['auth:sanctum'])
    ->controller(OrderController::class)->group(function () {
        Route::post('/', 'createOrder');
        Route::get('/', 'getMyOrders');
    });

