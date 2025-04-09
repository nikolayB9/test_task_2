<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categoriesIds = Category::pluck('id')->toArray();
        $numberOfArticles = rand(100, 300);
        $i = 1;

        while ($i <= $numberOfArticles) {
            Article::factory()->create([
                'category_id' => fake()->randomElement($categoriesIds),
                'order' => $i,
            ]);
            $i++;
        }
    }
}
