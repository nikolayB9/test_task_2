<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Article\IndexRequest;
use App\Http\Resources\Article\IndexArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(IndexRequest $request)
    {
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);

        return IndexArticleResource::collection(
            Article::orderBy('order')->paginate($perPage, ['*'], 'page', $page)
        );
    }
}
