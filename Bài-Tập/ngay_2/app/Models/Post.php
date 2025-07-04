<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Các trường cho phép gán dữ liệu hàng loạt
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    // Định nghĩa route model binding theo slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
