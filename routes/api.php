<?php

use Illuminate\Support\Facades\Route;

Route::get('/categories', [\App\Http\Controllers\API\V1\CategoryController::class, 'index']);
