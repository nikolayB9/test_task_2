<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::view('/', 'main.index')->name('index');

    Route::put('/users/update-order', [\App\Http\Controllers\UserController::class, 'updateOrder']);
    Route::put('/users/{user}/toggle-activity', [\App\Http\Controllers\UserController::class, 'toggleActivity']);
    Route::resource('/users', \App\Http\Controllers\UserController::class)
        ->except('show', 'destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');
    Route::view('/lockscreen', 'auth.lockscreen')->name('lockscreen');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'create'])->name('login.form');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'store'])->name('login.submit');
});
