<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = $this->createImage();
        $imageUrl = '/storage/' . $imagePath;
        $title = ucfirst(fake()->unique()->words(rand(1, 4), true));

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'image_path' => $imagePath,
            'content' => '<p><img src="' . $imageUrl . '" style="width: 25%;"><br>' . fake()->sentences(rand(3, 10), true) . '</p>',
            'is_active' => fake()->randomElement([true, false]),
        ];
    }

    private function createImage(): string
    {
        $sourcePath = public_path('assets/images/default.png');
        $filename = Str::random(20) . '.png';
        $path = "images/articles/{$filename}";

        Storage::disk('public')->put($path, file_get_contents($sourcePath));

        return $path;
    }
}
