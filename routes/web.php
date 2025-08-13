<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page.home');
});

Route::prefix('authenticate')->group( function() {
    Route::get('/login', [Auth::class, 'index'])->name('loginForm');
});