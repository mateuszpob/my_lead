<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/get', [ProductController::class, 'getProducts'])->name('get.many');
    Route::get('/get/{id}', [ProductController::class, 'getProduct'])->name('get.single');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::post('/create', [ProductController::class, 'createProduct'])->name('create');
        Route::put('/edit/{id}', [ProductController::class, 'editProduct'])->name('edit');
        Route::delete('/{id}', [ProductController::class, 'deleteProduct'])->name('delete');
    });
});
