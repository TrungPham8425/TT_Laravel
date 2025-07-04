<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Author;

class Post extends Model
{
    use HasFactory;

    // Quan hệ: Bài viết thuộc về một tác giả
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Scope: Lấy các bài viết đã publish
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope: Lấy các bài viết trong 30 ngày gần nhất
    public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30));
    }

    // Mutator: Khi set title sẽ tự động format và tạo slug
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accessor: Định dạng lại published_at khi lấy ra
    public function getPublishedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i') : null;
    }
}
