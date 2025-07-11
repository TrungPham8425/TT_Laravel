<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     * Admin có thể xem tất cả bài viết, user chỉ xem bài của mình
     */
    public function viewAny(User $user): bool
    {
        return true; // Tất cả user đã đăng nhập đều có thể xem danh sách
    }

    /**
     * Determine whether the user can view the model.
     * Admin có thể xem tất cả, user chỉ xem bài của mình
     */
    public function view(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create models.
     * Tất cả user đã đăng nhập đều có thể tạo bài viết
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * Admin có thể sửa tất cả, user chỉ sửa bài của mình
     */
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     * Admin có thể xóa tất cả, user chỉ xóa bài của mình
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     * Chỉ admin mới có thể restore
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     * Chỉ admin mới có thể xóa vĩnh viễn
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}
