<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page.home');
});

Route::prefix('authenticate')->group( function() {
    Route::get('/login', [Auth::class, 'index'])->name('loginForm');
});

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});