<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EditorImageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', MainController::class)->name('index');

    Route::patch('/users/update-order', [UserController::class, 'updateOrder']);
    Route::patch('/users/{user}/toggle-activity', [UserController::class, 'toggleActivity']);
    Route::resource('/users', UserController::class)
        ->except('show', 'destroy');

    Route::patch('/categories/update-order', [CategoryController::class, 'updateOrder']);
    Route::patch('/categories/{category}/toggle-activity', [CategoryController::class, 'toggleActivity']);
    Route::resource('/categories', CategoryController::class)
        ->except('show', 'destroy');

    Route::patch('/articles/update-order', [ArticleController::class, 'updateOrder']);
    Route::patch('/articles/{article}/toggle-activity', [ArticleController::class, 'toggleActivity']);
    Route::resource('/articles', ArticleController::class)
        ->except('show', 'destroy');

    Route::post('/editor/images', [EditorImageController::class, 'store']);
    Route::delete('/editor/images', [EditorImageController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::view('/lockscreen', 'auth.lockscreen')->name('lockscreen');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.submit');
});
