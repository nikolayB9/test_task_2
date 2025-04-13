<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private int $categoryCount = 20;

    public function run(): void
    {
        for ($i = 1; $i <= $this->categoryCount; $i++) {
            Category::factory()->create([
                'order' => $i,
            ]);
        }
    }
}
