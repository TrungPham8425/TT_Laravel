<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tạo bảng posts
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Khoá chính tự tăng
            $table->string('title'); // Tiêu đề bài viết
            $table->string('slug')->unique(); // Slug duy nhất
            $table->text('content'); // Nội dung bài viết
            $table->timestamps(); // Thời gian tạo/cập nhật
        });
    }

    /**
     * Xoá bảng posts khi rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
