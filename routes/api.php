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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->controller(ProductApiController::class)->prefix('v1/product')->group(function () {
    Route::get('/', 'index')->name('api.product.index');
    Route::post('/store', 'store')->name('api.product.store');
    Route::get('/{hash}', 'show')->name('api.product.show');
    Route::put('/{hash}/update', 'update')->name('api.product.update');
    Route::delete('/{hash}/delete', 'destroy')->name('api.product.destroy');
});

Route::middleware('auth:sanctum')->controller(ProductInfoApiController::class)->prefix('v1/product')->group(function () {
    Route::get('/{hash}/info', 'index')->name('api.info.index');
    Route::post('/{hash}/info/store', 'store')->name('api.info.store');
    Route::get('/info/{hash2}', 'show')->name('api.info.show');
    Route::put('/{hash}/info/{hash2}/update', 'update')->name('api.info.update');
    Route::delete('/info/{hash}/delete', 'destroy')->name('api.info.destroy');
    Route::delete('/section/{hash}/delete', 'destroy_section')->name('api.section.destroy');
});

Route::middleware('auth:sanctum')->controller(LanguageApiController::class)->prefix('language')->group(function () {
    Route::get('/', 'index')->name('api.language.index');
});