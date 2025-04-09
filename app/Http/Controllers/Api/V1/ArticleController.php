<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Article\IndexRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Article\IndexArticleResource;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index(IndexRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);

        return IndexArticleResource::collection(
            Article::orderBy('order')->paginate($perPage, ['*'], 'page', $page)
        );
    }

    public function getArticlesByCategory(IndexRequest $request, Category $category): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);

        return IndexArticleResource::collection(
            Article::where('category_id', $category->id)
                ->orderBy('order')
                ->paginate($perPage, ['*'], 'page', $page)
        );
    }

    public function getArticleBySlug(string $slug): ArticleResource
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return ArticleResource::make($article);
    }
}
