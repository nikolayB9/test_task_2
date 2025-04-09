<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\IndexCategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return IndexCategoryResource::collection(Category::orderBy('order')->get());
    }
}
