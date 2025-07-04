@extends('layouts.admin')

@section('title', 'Tạo bài viết mới')

@section('content')
<h1 class="mb-4">Tạo bài viết mới</h1>
{{-- Hiển thị thông báo lỗi nếu có --}}
@if(session('message'))
<x-alert :type="session('type', 'error')" :message="session('message')" />
@endif
<form action="{{ route('admin.posts.store') }}" method="POST" class="card p-4 shadow-sm bg-white" style="max-width: 600px; margin: 0 auto;">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Nội dung</label>
        <textarea name="content" id="content" rows="8" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
        @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Lưu bài viết</button>
</form>
@endsection