<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Requests\ToggleActivityRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Category;

class CategoryController extends Controller
{
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
        $data = $request->validated();

        Category::create([
            'title' => $data['title'],
            'order' => Category::max('order') + 1,
            'is_active' => !empty($data['is_active']),
        ]);
        return redirect()->route('categories.index')->with('success', 'Категория добавлена');
    }

    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['is_active'] = !empty($data['is_active']);
        $category->update($data);
        return redirect()->route('categories.edit', $category->id)->with('success', 'Категория обновлена');
    }

    public function toggleActivity(ToggleActivityRequest $request, Category $category): void
    {
        $category->update([
           'is_active' => $request->input('is_active'),
        ]);
    }

    public function updateOrder(UpdateOrderRequest $request): void
    {
        foreach ($request->input('order') as $orderData) {
            Category::where('id', $orderData['id'])->update(['order' => $orderData['order']]);
        }
    }
}
