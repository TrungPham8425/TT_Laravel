@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Danh sách bài viết</h1>
    <a href="/authors" class="btn btn-primary">Xem danh sách tác giả</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Trạng thái</th>
            <th>Ngày đăng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $loop->iteration + ($posts->currentPage() - 1) * $posts->perPage() }}</td>
            <td><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->status }}</td>
            <td>{{ $post->published_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
@endsection