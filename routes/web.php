<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page.home');
});

Route::controller(Authenticate::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('post', 'loginSuperadmin')->name('login-superadmin');
    Route::post('logout', 'logoutSuperadmin')->name('logout-superadmin');
});

Route::prefix('superadmin')->group(function () {
    Route::controller(Authenticate::class)->group(function () {
        Route::get('login/v6suactsygfsb', 'formSuperadmin')->name('form.superadmin');
        Route::post('post', 'loginSuperadmin')->name('login-superadmin');
        Route::post('logout', 'logout')->name('logout-superadmin');
    });

    Route::middleware('auth', 'role:superadmin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('superadmin.dashboard');

        Route::get('super-absen', [AbsenController::class, 'super_absen'])->name('super-absen');
    });
});
