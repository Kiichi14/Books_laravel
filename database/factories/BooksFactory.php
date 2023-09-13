<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Editor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::random(10),
            'resume' => fake()->paragraph(),
            'category_id' => Category::factory(),
            'author_id' => Author::factory(),
            'editor_id' => Editor::factory()
        ];
    }
}
