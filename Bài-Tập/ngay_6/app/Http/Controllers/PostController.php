<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Constructor - áp dụng middleware auth cho tất cả method
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified'); // Yêu cầu xác minh email
    }

    /**
     * Display a listing of the resource.
     * Admin xem tất cả, user xem bài của mình
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin xem tất cả bài viết
            $posts = Post::with('user')->latest()->paginate(10);
        } else {
            // User thường chỉ xem bài của mình
            $posts = $user->posts()->latest()->paginate(10);
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        // Tạo bài viết mới
        $post = Auth::user()->posts()->create($validated);

        // Flash message thành công
        session()->flash('success', 'Bài viết đã được tạo thành công!');

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Kiểm tra quyền xem bài viết
        $this->authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Kiểm tra quyền sửa bài viết
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Kiểm tra quyền sửa bài viết
        $this->authorize('update', $post);

        // Validate dữ liệu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        // Cập nhật bài viết
        $post->update($validated);

        // Flash message thành công
        session()->flash('success', 'Bài viết đã được cập nhật thành công!');

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Kiểm tra quyền xóa bài viết
        $this->authorize('delete', $post);

        // Xóa bài viết
        $post->delete();

        // Flash message thành công
        session()->flash('success', 'Bài viết đã được xóa thành công!');

        return redirect()->route('posts.index');
    }
}
