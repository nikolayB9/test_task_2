<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', \App\Http\Controllers\MainController::class)->name('index');

    Route::put('/users/update-order', [\App\Http\Controllers\UserController::class, 'updateOrder']);
    Route::put('/users/{user}/toggle-activity', [\App\Http\Controllers\UserController::class, 'toggleActivity']);
    Route::resource('/users', \App\Http\Controllers\UserController::class)
        ->except('show', 'destroy');

    Route::put('/categories/update-order', [\App\Http\Controllers\CategoryController::class, 'updateOrder']);
    Route::put('/categories/{category}/toggle-activity', [\App\Http\Controllers\CategoryController::class, 'toggleActivity']);
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class)
        ->except('show', 'destroy');

    Route::put('/articles/update-order', [\App\Http\Controllers\ArticleController::class, 'updateOrder']);
    Route::put('/articles/{article}/toggle-activity', [\App\Http\Controllers\ArticleController::class, 'toggleActivity']);
    Route::resource('/articles', \App\Http\Controllers\ArticleController::class)
        ->except('show', 'destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');
    Route::view('/lockscreen', 'auth.lockscreen')->name('lockscreen');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'create'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'store'])->name('login.submit');
});
