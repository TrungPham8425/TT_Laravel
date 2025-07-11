<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả users để tạo bài viết
        $users = User::all();

        if ($users->count() === 0) {
            // Nếu chưa có user nào, tạo một user admin mẫu
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);

            $users = collect([$admin]);
        }

        // Tạo bài viết mẫu
        $posts = [
            [
                'title' => 'Chào mừng đến với hệ thống quản lý bài viết',
                'content' => 'Đây là bài viết đầu tiên trong hệ thống. Hệ thống này được xây dựng với Laravel và bao gồm các tính năng authentication, authorization, và quản lý bài viết.',
                'status' => 'published',
            ],
            [
                'title' => 'Hướng dẫn sử dụng hệ thống',
                'content' => 'Bài viết này sẽ hướng dẫn bạn cách sử dụng hệ thống quản lý bài viết. Bạn có thể tạo, chỉnh sửa, và xóa bài viết của mình.',
                'status' => 'published',
            ],
            [
                'title' => 'Bài viết bản nháp',
                'content' => 'Đây là một bài viết bản nháp, chưa được xuất bản. Bạn có thể chỉnh sửa và xuất bản sau.',
                'status' => 'draft',
            ],
            [
                'title' => 'Tính năng Authentication',
                'content' => 'Hệ thống sử dụng Laravel Breeze để xử lý authentication. Người dùng phải đăng ký, đăng nhập và xác minh email trước khi có thể sử dụng các tính năng.',
                'status' => 'published',
            ],
            [
                'title' => 'Tính năng Authorization',
                'content' => 'Hệ thống sử dụng Laravel Policies để kiểm soát quyền truy cập. Admin có thể quản lý tất cả bài viết, trong khi user thường chỉ có thể quản lý bài viết của mình.',
                'status' => 'published',
            ],
        ];

        foreach ($posts as $postData) {
            // Gán bài viết cho user ngẫu nhiên
            $user = $users->random();

            Post::create([
                'title' => $postData['title'],
                'content' => $postData['content'],
                'status' => $postData['status'],
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('Đã tạo ' . count($posts) . ' bài viết mẫu!');
    }
}
