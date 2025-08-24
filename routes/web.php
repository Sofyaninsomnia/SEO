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

Route::post('postIzin', [AbsenController::class, 'postIzin'])->name('kirim-izin');
Route::controller(Authenticate::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login-user', 'login')->name('user-login');
    Route::post('logout', 'logout')->name('logout');

    });

Route::prefix('user')->group(function() {
    Route::middleware('auth', 'user')->group(function() {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

        Route::get('absen', [AbsenController::class, 'user_absen'])->name('user_absen');
        Route::post('/absen', [AbsenController::class, 'absenUser'])->name('absen.user');
        Route::get('form_izin', [AbsenController::class, 'formIzin'])->name('form_izin');
    });
});

Route::prefix('admin')->group(function() {
    Route::controller(Authenticate::class)->group(function () {
        Route::get('login/v6suactsygfsb', 'formSuperadmin')->name('form.superadmin');
        Route::post('post', 'loginSuperadmin')->name('login-superadmin');
        Route::post('logout', 'logout')->name('logout-superadmin');
    });

    Route::middleware('auth', 'admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('absen', [AbsenController::class, 'admin_absen'])->name('admin_absen');
        Route::post('post/absen', [AbsenController::class, 'absenAdmin'])->name('absen.admin');
    });
});

Route::prefix('superadmin')->group(function () {

    Route::middleware('auth', 'superadmin')->group(function () {
        Route::get('dashboard', [SuperController::class, 'dashboard'])->name('superadmin.dashboard');

        Route::get('super-absen', [AbsenController::class, 'super_absen'])->name('super-absen');
        Route::post('/absen', [AbsenController::class, 'absenSuper'])->name('absen.store');
        Route::put('change/data-absen/{id}', [AbsenController::class, 'updateSuper'])->name('update.super');
        Route::delete('delete/data-absen/{id}', [AbsenController::class, 'deleteSuper'])->name('delete.absen');

        Route::get('user-list', [UserController::class, 'index'])->name('user-list');
        Route::post('add/user', [UserController::class, 'add_user'])->name('add-user');
        Route::put('change/data-user/{id}', [UserController::class, 'changeDataUser'])->name('update-user');
        Route::delete('hapus/user-data/{id}', [UserController::class, 'deleteUser'])->name('hapus-user');
    });
});

