<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Constructor - chỉ cho phép admin truy cập
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                abort(403, 'Bạn không có quyền truy cập trang này!');
            }
            return $next($request);
        });
    }

    /**
     * Dashboard admin - hiển thị tổng quan
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts = Post::where('status', 'draft')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'publishedPosts', 'draftPosts'));
    }

    /**
     * Quản lý tất cả bài viết
     */
    public function posts()
    {
        $posts = Post::with('user')->latest()->paginate(15);
        return view('admin.posts', compact('posts'));
    }

    /**
     * Quản lý tất cả người dùng
     */
    public function users()
    {
        $users = User::withCount('posts')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Thay đổi role của user
     */
    public function changeUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        session()->flash('success', "Đã thay đổi role của {$user->name} thành {$request->role}!");

        return redirect()->back();
    }

    /**
     * Xóa user (chỉ admin mới có quyền)
     */
    public function deleteUser(User $user)
    {
        // Không cho phép admin xóa chính mình
        if ($user->id === Auth::id()) {
            session()->flash('error', 'Không thể xóa tài khoản của chính mình!');
            return redirect()->back();
        }

        $user->delete();

        session()->flash('success', "Đã xóa user {$user->name} thành công!");

        return redirect()->back();
    }
}
