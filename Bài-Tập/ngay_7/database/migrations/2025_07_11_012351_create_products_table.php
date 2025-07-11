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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tên sản phẩm - bắt buộc và duy nhất
            $table->text('description')->nullable(); // Mô tả sản phẩm - tùy chọn
            $table->decimal('price', 10, 2); // Giá sản phẩm - bắt buộc, tối đa 10 chữ số, 2 chữ số thập phân
            $table->string('image_url')->nullable(); // URL hình ảnh - tùy chọn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
