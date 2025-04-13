<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasSortableOrder;
use App\Http\Controllers\Traits\HasToggleActivity;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class ArticleController extends Controller
{
    use HasToggleActivity, HasSortableOrder;

    public function index()
    {
        return view('article.index', [
            'articles' => Article::orderBy('order')->with('category')->get()
        ]);
    }

    public function create()
    {
        return view('article.create', [
            'categories' => $this->getCategories(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        Article::create($request->prepareDataForCreation());

        return redirect()->route('articles.index')->with('success', 'Статья добавлена');
    }

    public function edit(Article $article)
    {
        return view('article.edit', [
            'article' => $article,
            'categories' => $this->getCategories(),
        ]);
    }

    public function update(UpdateRequest $request, Article $article)
    {
        $article->update($request->prepareDataForUpdate());

        return redirect()->route('articles.edit', $article->id)->with('success', 'Статья обновлена');
    }

    /**
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return Article::class;
    }

    /**
     * @return string
     */
    protected function getRouteKey(): string
    {
        return 'article';
    }

    protected function getCategories(): Collection
    {
        return Category::select('id', 'title')->orderBy('order')->get();
    }
}
