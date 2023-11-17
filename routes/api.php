<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/cars', [PostController::class, 'index']);
Route::post('/car',[PostController::class,'store']);



Route::post('/category',[CategoryController::class,'store']);
Route::get('/categories',[CategoryController::class,'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/category',[CategoryController::class,'store']);
    Route::get('/categories',[CategoryController::class,'index']);

    Route::post('/shop',[ShopController::class,'store']);
    });