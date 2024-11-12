<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('homepage');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');
    Route::post('/settings/update-logo', [SettingController::class, 'updateLogo'])->name('settings.updateLogo');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
