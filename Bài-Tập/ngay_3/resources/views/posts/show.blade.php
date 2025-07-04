@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>
        <p class="card-text"><strong>Tác giả:</strong> {{ $post->author->name }}</p>
        <p class="card-text"><strong>Trạng thái:</strong> {{ $post->status }}</p>
        <p class="card-text"><strong>Ngày đăng:</strong> {{ $post->published_at }}</p>
        <hr>
        <div>{!! nl2br(e($post->content)) !!}</div>
    </div>
</div>
<div class="d-flex gap-2">
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">&laquo; Quay lại danh sách bài viết</a>
    <a href="/authors" class="btn btn-outline-primary">Xem danh sách tác giả</a>
</div>
@endsection