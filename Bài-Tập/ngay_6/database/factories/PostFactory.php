<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['draft', 'published']),
        ];
    }

    /**
     * Tạo bài viết đã xuất bản
     */
    public function published(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'published',
        ]);
    }

    /**
     * Tạo bài viết bản nháp
     */
    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'draft',
        ]);
    }
}
