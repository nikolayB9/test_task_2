<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'index']);

    Route::get('/articles', [\App\Http\Controllers\Api\V1\ArticleController::class, 'index']);
});
