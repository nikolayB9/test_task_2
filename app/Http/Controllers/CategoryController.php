<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasSortableOrder;
use App\Http\Controllers\Traits\HasToggleActivity;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    use HasToggleActivity, HasSortableOrder;

    public function index()
    {
        return view('category.index', ['categories' => Category::orderBy('order')->get()]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(StoreRequest $request)
    {
        Category::create($request->prepareDataForCreation());

        return redirect()->route('categories.index')->with('success', 'Категория добавлена');
    }

    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->prepareDataForUpdate());

        return redirect()->route('categories.edit', $category->id)->with('success', 'Категория обновлена');
    }

    /**
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return Category::class;
    }

    /**
     * @return string
     */
    protected function getRouteKey(): string
    {
        return 'category';
    }
}
