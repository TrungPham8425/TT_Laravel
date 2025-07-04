@extends('layouts.admin')

@section('title', $post->title)

@section('content')
<div class="card shadow-sm bg-white mb-4">
    <div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>
        <div><strong>Slug:</strong> {{ $post->slug }}</div>
        <div><strong>Ngày tạo:</strong> {{ $post->created_at }}</div>
        <div class="mt-3">{!! nl2br(e($post->content)) !!}</div>
    </div>
</div>
<a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
@endsection