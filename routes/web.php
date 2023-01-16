<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInfoController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PlanController;

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

Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);
    return redirect()->back();
})->name('language');

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
        Route::delete('/{hash}/info/{hash2}/delete', 'destroy')->name('destroy');
        Route::delete('/{hash}/info/section/{hash2}/delete', 'destroy_section')->name('destroy_section');
    });
    Route::controller(PlanController::class)->group(function () {
        Route::get('/', 'welcome')->name('plan.show');
        Route::get('/user/subscribe/{slug}', 'show')->name('plan.show');
        Route::post('/user/subscribe', 'subscribe')->name('subscription.create');
        Route::post('/user/billing-details', 'billing_details')->name('details.save');
        Route::get('/user/subscribtion/change', 'change')->name('subscription.change');
        Route::get('/user/subscribtion/success', 'success_page')->name('subscription.success');
        Route::get('/user/subscribtion/cancel', 'cancel_page')->name('subscription.cancel');
        Route::get('/user/subscribtion/upgrade', 'upgrade_page')->name('subscription.upgrade');
    });
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/search', 'search')->name('search');
});

Route::controller(ProductInfoController::class)->prefix('product')->name('product.info.')->group(function () {
    Route::get('/{hash}/info', 'show')->name('show');
});

Route::controller(PlanController::class)->group(function () {
    Route::get('/plans', 'index')->name('plan.index');
});

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about');

Route::get('/privacy-policy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('policy.show');

Route::get('/terms-of-service', function () {
    return Inertia::render('TermsOfService');
})->name('terms.show');

Route::get('sitemap.xml', [SitemapController::class, 'index']);
