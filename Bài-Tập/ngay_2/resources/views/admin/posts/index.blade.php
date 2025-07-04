@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
<h1 class="mb-4">Danh sách bài viết</h1>
{{-- Hiển thị thông báo nếu có --}}
@if(session('message'))
<x-alert :type="session('type', 'success')" :message="session('message')" />
@endif
<a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">Tạo bài viết mới</a>
<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle bg-white">
        <thead class="table-light">
            <tr>
                <th>Tiêu đề</th>
                <th>Slug</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary btn-sm">Xem</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Chưa có bài viết nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection