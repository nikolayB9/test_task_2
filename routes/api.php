<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'index']);

    Route::controller(\App\Http\Controllers\Api\V1\ArticleController::class)->group(function () {
        Route::get('/articles/category/{category}', 'getArticlesByCategory');
        Route::get('/articles/{slug}', 'getArticleBySlug');
        Route::get('/articles/', 'index');
    });
});
