<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\HeroSliderController;
use App\Http\Controllers\ClientSliderController;
use App\Http\Controllers\HeroContentController;
use App\Http\Controllers\PageTitleController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ServiceCardController;
use App\Http\Controllers\RetailServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileKamiController;
use App\Http\Controllers\VisiMisiController;

Route::get('/', [HomeController::class, 'index'])->name('home');

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
    Route::post('/hero-content/update', [HeroContentController::class, 'update'])->name('hero-content.update');
    Route::post('/heroslider/delete-multiple', [HeroSliderController::class, 'deleteMultiple'])->name('heroslider.deleteMultiple');
    Route::post('/clientslider', [ClientSliderController::class, 'store'])->name('clientslider.store');
    Route::delete('/clientslider/{id}', [ClientSliderController::class, 'destroy'])->name('clientslider.destroy');
    Route::post('/clientslider/delete-multiple', [ClientSliderController::class, 'deleteMultiple'])->name('clientslider.deleteMultiple');
    Route::post('/page-titles/update', [PageTitleController::class, 'update'])->name('page-titles.update');
    Route::post('/layanan/update', [LayananController::class, 'update'])->name('layanan.update');
    Route::post('/layanan/update-retail', [LayananController::class, 'updateRetail'])->name('layanan.update-retail');
    Route::resource('service-cards', ServiceCardController::class);
    Route::resource('retail-services', RetailServiceController::class);
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::post('/upload-image', [PortfolioController::class, 'uploadImage'])->name('upload.image');
    Route::post('/profilekami/update', [ProfileKamiController::class, 'update'])->name('profilekami.update');
    Route::post('/visimisi/update', [VisiMisiController::class, 'update'])->name('visimisi.update');
});

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
