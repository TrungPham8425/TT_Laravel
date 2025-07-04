<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Thêm cột role vào bảng users
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột role, mặc định là 'user'
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Xoá cột role khi rollback
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
