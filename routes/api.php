<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ProductInfoApiController;
use App\Http\Controllers\LanguageApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:sanctum')->controller(ProductApiController::class)->prefix('/v1/product')->group(function () {
    Route::get('/', 'index')->name('api.v1.product.index');
    Route::post('/store', 'store')->name('api.v1.product.store');
    Route::get('/{hash}', 'show')->name('api.v1.product.show');
    Route::put('/{hash}/update', 'update')->name('api.v1.product.update');
    Route::delete('/{hash}/delete', 'destroy')->name('api.v1.product.destroy');
});

Route::middleware('auth:sanctum')->controller(ProductInfoApiController::class)->prefix('/v1/product')->group(function () {
    Route::get('/{hash}/info', 'index')->name('api.v1.info.index');
    Route::post('/{hash}/info/store', 'store')->name('api.v1.info.store');
    Route::get('/info/{hash2}', 'show')->name('api.v1.info.show');
    Route::put('/{hash}/info/{hash2}/update', 'update')->name('api.v1.info.update');
    Route::delete('/info/{hash}/delete', 'destroy')->name('api.v1.info.destroy');
    Route::delete('/section/{hash}/delete', 'destroy_section')->name('api.v1.section.destroy');
});

Route::middleware('auth:sanctum')->controller(LanguageApiController::class)->prefix('language')->group(function () {
    Route::get('/', 'index')->name('api.v1.language.index');
});