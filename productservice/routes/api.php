<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('token')->get('/post', [PostController::class, 'show']);

Route::middleware('token')->resource('posts', PostController::class)->only([
    'destroy', 'show', 'store', 'update'
]);

Route::middleware('token')->get('/category', [CategoryController::class, 'show']);

Route::middleware('token')->resource('categories', CategoryController::class)->only([
    'destroy', 'show', 'store', 'update'
]);