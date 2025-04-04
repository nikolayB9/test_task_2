<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', function () {
        return view('main.index');
    })->name('index');

    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');

    Route::resource('users', \App\Http\Controllers\UserController::class);
});

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'create'])->name('loginForm');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'store'])->name('login');
});
