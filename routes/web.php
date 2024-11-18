<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\HeroSliderController;
use App\Http\Controllers\ClientSliderController;
use App\Http\Controllers\HeroContentController;
use App\Http\Controllers\PageTitleController;
use App\Http\Controllers\LayananController;

Route::get('/', [HeroSliderController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/homepage', [HeroSliderController::class, 'index'])->name('homepage');
    Route::post('/icons/update-logo', [IconController::class, 'updateLogo'])->name('icons.updateLogo');
    Route::post('/heroslider', [HeroSliderController::class, 'storeHeroSlider'])->name('heroslider.store');
    Route::delete('/heroslider/{id}', [HeroSliderController::class, 'destroyHeroSlider'])->name('heroslider.destroy');
    Route::post('/clientslider', [ClientSliderController::class, 'store'])->name('clientslider.store');
    Route::delete('/clientslider/{id}', [ClientSliderController::class, 'destroy'])->name('clientslider.destroy');
    Route::post('/hero-content/update', [HeroContentController::class, 'update'])->name('hero-content.update');
    Route::post('/page-titles/update', [PageTitleController::class, 'update'])->name('page-titles.update');
    Route::post('/layanan/update', [LayananController::class, 'update'])->name('layanan.update');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
