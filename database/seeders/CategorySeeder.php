<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $numberOfCategories = rand(10, 30);
        $i = 1;

        while ($i <= $numberOfCategories) {
            Category::factory()->create([
                'order' => $i,
            ]);
            $i++;
        }

    }
}
