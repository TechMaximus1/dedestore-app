<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [Usercontroller::class, 'register']);
Route::post('login', [Usercontroller::class, 'login']);
Route::post('addProduct',[ProductController::class, 'addProduct']);
Route::get('productlist', [ProductController::class, 'productList']);