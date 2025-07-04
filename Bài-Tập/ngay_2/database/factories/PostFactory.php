<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    // Định nghĩa model tương ứng
    protected $model = \App\Models\Post::class;

    /**
     * Định nghĩa dữ liệu giả cho model Post
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 10000),
            'content' => $this->faker->paragraphs(5, true),
        ];
    }
}
