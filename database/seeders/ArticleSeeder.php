<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    private int $articleCount = 100;

    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();

        if (empty($categoryIds)) {
            $this->command->warn('No categories found. Skipping article seeding.');
            return;
        }

        for ($i = 1; $i <= $this->articleCount; $i++) {
            Article::factory()->create([
                'category_id' => fake()->randomElement($categoryIds),
                'order' => $i,
            ]);
        }
    }
}
