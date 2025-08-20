<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page.home');
})->name('home');

Route::controller(Authenticate::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login-user', 'login')->name('user-login');
    Route::post('logout', 'logout')->name('logout');
    
    Route::post('post', 'loginSuperadmin')->name('login-superadmin');
});

Route::prefix('user')->group(function() {
    Route::middleware('auth', 'user')->group(function() {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

        Route::get('absen', [AbsenController::class, 'user_absen'])->name('user_absen');
    });
});

Route::prefix('admin')->group(function() {
    Route::controller(Authenticate::class)->group(function () {
        Route::get('login/v6suactsygfsb', 'formSuperadmin')->name('form.superadmin');
        Route::post('post', 'loginSuperadmin')->name('login-superadmin');
        Route::post('logout', 'logout')->name('logout-superadmin');
    });

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');

Route::prefix('superadmin')->group(function () {

    Route::middleware('auth', 'superadmin')->group(function () {
        Route::get('dashboard', [SuperController::class, 'dashboard'])->name('superadmin.dashboard');

        Route::get('super-absen', [AbsenController::class, 'super_absen'])->name('super-absen');

        Route::get('user-list', [UserController::class, 'index'])->name('user-list');
        Route::post('add/user', [UserController::class, 'add_user'])->name('add-user');
        Route::put('change/data-user/{id}', [UserController::class, 'changeDataUser'])->name('update-user');
        Route::delete('hapus/user-data/{id}', [UserController::class, 'deleteUser'])->name('hapus-user');
    });
});
