<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        // Lấy tất cả bài viết (có thể phân trang)
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    // Hiển thị form tạo bài viết mới
    public function create()
    {
        return view('admin.posts.create');
    }

    // Lưu bài viết mới vào database
    public function store(StorePostRequest $request)
    {
        // Lấy dữ liệu đã validate
        $data = $request->validated();
        // Tạo slug tự động từ tiêu đề
        $data['slug'] = Str::slug($data['title']);
        // Lưu vào database
        Post::create($data);
        // Chuyển hướng về danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')
            ->with(['message' => 'Tạo bài viết thành công!', 'type' => 'success']);
    }

    // Hiển thị chi tiết bài viết theo slug (route model binding)
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
}
