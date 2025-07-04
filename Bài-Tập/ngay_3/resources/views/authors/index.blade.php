@extends('layouts.app')

@section('title', 'Danh sách tác giả')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Danh sách tác giả</h1>
    <a href="/posts" class="btn btn-primary">Xem danh sách bài viết</a>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên tác giả</th>
            <th>Email</th>
            <th>Số bài viết</th>
        </tr>
    </thead>
    <tbody>
        @foreach($authors as $author)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->email }}</td>
            <td>{{ $author->posts_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection