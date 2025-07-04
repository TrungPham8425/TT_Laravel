@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">E-Learning Test UI</h1>
    @if(isset($message))
    <div class="alert alert-success">{{ $message }}</div>
    @endif
    @if(isset($error))
    <div class="alert alert-danger">{{ $error }}</div>
    @endif
    @if($courses)
    <h2>Danh sách khóa học</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Số bài học</th>
                <th>Số comment</th>
                <th>Xem chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->lessons_count }}</td>
                <td>{{ $course->comments_count }}</td>
                <td><a href="{{ url('/test-ui/course/'.$course->id) }}" class="btn btn-sm btn-primary">Chi tiết</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h3>Tạo mới khóa học (kèm 3 bài học)</h3>
    <form method="POST" action="{{ url('/test-ui/create-course') }}" class="mb-4">
        @csrf
        <div class="mb-2">
            <label>Tiêu đề khóa học</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Tên các bài học</label>
            <input type="text" name="lesson_titles[]" class="form-control mb-1" placeholder="Bài học 1" required>
            <input type="text" name="lesson_titles[]" class="form-control mb-1" placeholder="Bài học 2" required>
            <input type="text" name="lesson_titles[]" class="form-control mb-1" placeholder="Bài học 3" required>
        </div>
        <button type="submit" class="btn btn-success">Tạo khóa học</button>
    </form>
    <hr>
    <h3>Gắn tag cho bài học</h3>
    <form method="POST" action="{{ url('/test-ui/attach-tag') }}" class="mb-4">
        @csrf
        <div class="mb-2">
            <label>Chọn bài học</label>
            <select name="lesson_id" class="form-select" required>
                @foreach($lessons as $lesson)
                <option value="{{ $lesson->id }}">{{ $lesson->title }} (ID: {{ $lesson->id }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Tag (cách nhau bằng dấu phẩy)</label>
            <input type="text" name="tags" class="form-control" placeholder="Laravel, Eloquent" required>
        </div>
        <button type="submit" class="btn btn-info">Gắn tag</button>
    </form>
    @elseif($course)
    <a href="{{ url('/test-ui') }}" class="btn btn-secondary mb-3">&larr; Quay lại danh sách</a>
    <h2>Khóa học: {{ $course->title }}</h2>
    <p><b>Tác giả:</b> {{ $course->user->name ?? 'N/A' }}</p>
    <p><b>Số bài học:</b> {{ $course->lessons_count }}</p>
    <p><b>Số comment:</b> {{ $course->comments_count }}</p>
    <h4>Bài học</h4>
    <ul>
        @foreach($course->lessons as $lesson)
        <li>
            <b>{{ $lesson->title }}</b>
            @if($lesson->tags->count())
            <span class="badge bg-info text-dark">Tags:
                @foreach($lesson->tags as $tag)
                {{ $tag->name }}@if(!$loop->last), @endif
                @endforeach
            </span>
            @endif
        </li>
        @endforeach
    </ul>
    <h4>Comment</h4>
    <ul>
        @foreach($course->comments as $comment)
        <li>
            <b>{{ $comment->user->name ?? 'N/A' }}:</b> {{ $comment->content }}
        </li>
        @endforeach
    </ul>
    <hr>
    <h4>Thêm comment cho khóa học</h4>
    <form method="POST" action="{{ url('/test-ui/course/'.$course->id.'/comment') }}">
        @csrf
        <div class="mb-2">
            <textarea name="content" class="form-control" placeholder="Nội dung bình luận" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi comment</button>
    </form>
    @else
    <p>Không có dữ liệu.</p>
    @endif
</div>
@endsection