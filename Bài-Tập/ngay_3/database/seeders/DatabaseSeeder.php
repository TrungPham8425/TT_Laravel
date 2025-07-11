<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Sinh 10 tác giả, mỗi tác giả có 3-7 bài viết
        Author::factory(10)->create()->each(function ($author) {
            Post::factory(rand(3, 7))->create([
                'author_id' => $author->id,
            ]);
        });
    }
}
