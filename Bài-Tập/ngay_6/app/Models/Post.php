<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính có thể mass assign
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'status',
    ];

    /**
     * Relationship với User - một bài viết thuộc về một user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope để lấy các bài viết đã publish
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope để lấy các bài viết draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
