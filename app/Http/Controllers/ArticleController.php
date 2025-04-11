<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Requests\EditorImage\UploadImageRequest;
use App\Http\Requests\ToggleActivityRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::orderBy('order')->with('category')->get()
        ]);
    }

    public function create()
    {
        return view('article.create', [
            'categories' => Category::select('id', 'title')->orderBy('order')->get(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Article::create([
            'title' => $data['title'],
            'slug' => $data['slug'] ?? Str::slug($data['title']),
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'image_path' => $data['image_path'],
            'order' => Article::max('order') + 1,
            'is_active' => !empty($data['is_active']),
        ]);

        return redirect()->route('articles.index')->with('success', 'Статья добавлена');
    }

    public function edit(Article $article)
    {
        return view('article.edit', [
            'article' => $article,
            'categories' => Category::select('id', 'title')->orderBy('order')->get(),
        ]);
    }

    public function update(UpdateRequest $request, Article $article)
    {
        $data = $request->validated();
        dd($data);
        $data['is_active'] = !empty($data['is_active']);
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data = $request->validated();

        if (isset($data['image'])) {
            $data['image_path'] = Storage::disk('public')->putFile('/images/articles', $data['image']);
            Storage::disk('public')->delete($article->image_path);
            unset($data['image']);
        }

        $article->update($data);
        return redirect()->route('articles.edit', $article->id)->with('success', 'Статья обновлена');
    }

    public function toggleActivity(ToggleActivityRequest $request, Article $article): void
    {
        $article->update([
            'is_active' => $request->input('is_active'),
        ]);
    }

    public function updateOrder(UpdateOrderRequest $request): void
    {
        foreach ($request->input('order') as $orderData) {
            Article::where('id', $orderData['id'])->update(['order' => $orderData['order']]);
        }
    }
}
