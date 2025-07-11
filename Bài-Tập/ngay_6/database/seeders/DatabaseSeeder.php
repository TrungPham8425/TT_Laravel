<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo user admin mẫu
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Tạo user thường mẫu
        User::create([
            'name' => 'User Test',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Tạo thêm một số user ngẫu nhiên
        User::factory(3)->create([
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Gọi PostSeeder để tạo bài viết mẫu
        $this->call([
            PostSeeder::class,
        ]);
    }
}
