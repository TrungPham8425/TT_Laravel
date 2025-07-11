<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề bài viết
            $table->text('content'); // Nội dung bài viết
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID của người tạo bài viết
            $table->enum('status', ['draft', 'published'])->default('draft'); // Trạng thái bài viết
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
