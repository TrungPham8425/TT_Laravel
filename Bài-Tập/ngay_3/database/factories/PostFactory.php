<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    // Định nghĩa dữ liệu mẫu cho Post
    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        return [
            'author_id' => Author::factory(), // Sẽ được gán lại khi dùng trong seeder
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(rand(3, 7), true),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
