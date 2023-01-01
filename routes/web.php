<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInfoController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/{hash}/update', 'update')->name('update');
        Route::delete('/{hash}/delete', 'destroy')->name('destroy');
    });
    Route::controller(ProductInfoController::class)->prefix('product')->name('product.info.')->group(function () {
        Route::get('/{hash}/info', 'show')->name('show');
        Route::get('/{hash}/info/create', 'create')->name('create');
        Route::post('/{hash}/info/store', 'store')->name('store');
        Route::get('/{hash}/info/{hash2}/edit', 'edit')->name('edit');
        Route::put('/{hash}/info/{hash2}/update', 'update')->name('update');
    });
});

Route::controller(ProductInfoController::class)->prefix('product')->name('product.info.')->group(function () {
    Route::get('/{hash}/info', 'show')->name('show');
});
