<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('main.index', [
           'numberOfUsers' => User::count(),
           'numberOfCategories' => Category::count(),
           'numberOfArticles' => Article::count(),
        ]);
    }
}
