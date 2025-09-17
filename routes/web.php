<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PengeluaranKasController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\UserController;
use App\Models\Kas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page.home');
})->name('home');

Route::controller(Authenticate::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login-user', 'login')->name('user-login');
    Route::post('logout', 'logout')->name('logout');

    });

Route::prefix('user')->group(function() {
    Route::middleware('auth', 'user')->group(function() {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

        Route::get('absen', [AbsenController::class, 'user_absen'])->name('user_absen');
        Route::post('/absen', [AbsenController::class, 'sendAbsen'])->name('absen.user');
        Route::get('form_izin', [AbsenController::class, 'formIzin'])->name('form_izin');
        Route::post('send_izin', [AbsenController::class, 'sendIzin_user'])->name('user.send_izin');

        Route::get('saran/fitur', [PesanController::class, 'user'])->name('saran.user');
        Route::post('send_pesan', [PesanController::class, 'send_chat'])->name('send_pesan');
        Route::delete('delete/pesan/{id}', [PesanController::class, 'delete_pesan'])->name('delete');
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
        Route::post('post/absen', [AbsenController::class, 'sendAbsen'])->name('absen.admin');
        Route::get('form_izin', [AbsenController::class, 'formIzinAdmin'])->name('form_izin.admin');
        Route::post('send_izin', [AbsenController::class, 'sendIzin_admin'])->name('admin.send_izin');
        Route::put('change/data-absen/{id}', [AbsenController::class, 'updateSuper'])->name('update.super');
        Route::delete('hapus/absen/{id}', [AbsenController::class, 'deleteAbsen'])->name('admin.absen_delete');

        Route::get('saran/fitur', [PesanController::class, 'admin'])->name('saran.admin');
        Route::post('send_pesan', [PesanController::class, 'send_chat'])->name('admin.send_chat');
        Route::delete('delete/pesan/{id}', [PesanController::class, 'delete_pesan'])->name('admin.delete');
    });
});

Route::prefix('superadmin')->group(function () {

    Route::middleware('auth', 'superadmin')->group(function () {
        Route::get('dashboard', [SuperController::class, 'dashboard'])->name('superadmin.dashboard');

        Route::get('super-absen', [AbsenController::class, 'super_absen'])->name('super-absen');
        Route::post('/absen', [AbsenController::class, 'sendAbsen'])->name('absen.store');
        Route::put('change/data-absen/{id}', [AbsenController::class, 'updateSuper'])->name('update.super');
        Route::delete('delete/data-absen/{id}', [AbsenController::class, 'deleteAbsen'])->name('delete.absen');
        Route::get('form_izin', [AbsenController::class, 'formIzinSuper'])->name('form_izin.super');
        Route::post('send_izin', [AbsenController::class, 'sendIzin_super'])->name('super.send_izin');
        Route::get('rekap_absen', [AbsenController::class, 'rekap_harian'])->name('absen.rekap_harian');

        Route::get('chat/saran_fitur', [PesanController::class, 'super'])->name('list.pesan');
        Route::get('feedback/pesan/{id}', [PesanController::class, 'feedback'])->name('feedback');
        Route::put('send/feedback/{id}', [PesanController::class, 'update_feedback'])->name('send_feedback');
        Route::delete('delete/pesan/{id}', [PesanController::class, 'delete_pesan'])->name('super.delete_chat');

        Route::get('user-list', [UserController::class, 'index'])->name('user-list');
        Route::post('add/user', [UserController::class, 'add_user'])->name('add-user');
        Route::put('change/data-user/{id}', [UserController::class, 'changeDataUser'])->name('update-user');
        Route::delete('hapus/user-data/{id}', [UserController::class, 'deleteUser'])->name('hapus-user');

        Route::get('kas', [KasController::class, 'superKas'])->name('super-kas');
        Route::get('kas_keluar', [PengeluaranKasController::class, 'index'])->name('super.kas_keluar');
        Route::post('add/tgl_kas/', [KasController::class, 'add_tgl'])->name('add-tgl');
        Route::get('list-kas/{id}', [KasController::class, 'listKas'])->name('list-kas');
        Route::post('create/kas/{id}', [KasController::class, 'create_kas'])->name('create-kas');
        Route::delete('delete/tgl-kas/{ud}', [KasController::class, 'deleteTglKas'])->name('deleteTgl');
        Route::delete('delete/list-kas/{id}', [KasController::class, 'deleteListKas'])->name('deleteListKas');
    });
});

