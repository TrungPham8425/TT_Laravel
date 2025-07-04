<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $courses = Course::withCount(['lessons', 'comments'])->get();
        $lessons = Lesson::with('tags')->get();
        $tags = Tag::all();
        return view('test', [
            'courses' => $courses,
            'course' => null,
            'lessons' => $lessons,
            'tags' => $tags,
            'message' => session('message'),
            'error' => session('error'),
        ]);
    }

    public function show($id)
    {
        $course = Course::with(['user', 'lessons.tags', 'comments.user'])->withCount(['lessons', 'comments'])->findOrFail($id);
        $lessons = Lesson::where('course_id', $id)->with('tags')->get();
        $tags = Tag::all();
        return view('test', [
            'courses' => null,
            'course' => $course,
            'lessons' => $lessons,
            'tags' => $tags,
            'message' => session('message'),
            'error' => session('error'),
        ]);
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'lesson_titles' => 'required|array|min:1',
            'lesson_titles.*' => 'required|string|max:255',
        ]);
        $user = User::first();
        if (!$user) return redirect()->back()->with('error', 'No user found');
        $course = $user->courses()->create(['title' => $request->title]);
        $lessons = [];
        foreach ($request->lesson_titles as $title) {
            $lessons[] = ['title' => $title];
        }
        $course->lessons()->createMany($lessons);
        return redirect('/test-ui')->with('message', 'Tạo khóa học thành công!');
    }

    public function attachTag(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'tags' => 'required|string',
        ]);
        $lesson = Lesson::find($request->lesson_id);
        $tagNames = array_map('trim', explode(',', $request->tags));
        $tagIds = [];
        foreach ($tagNames as $name) {
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tagIds[] = $tag->id;
        }
        $lesson->tags()->syncWithoutDetaching($tagIds);
        return redirect()->back()->with('message', 'Gắn tag thành công!');
    }

    public function addComment(Request $request, $courseId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        $user = User::first();
        if (!$user) return redirect()->back()->with('error', 'No user found');
        $course = Course::findOrFail($courseId);
        $course->comments()->create([
            'user_id' => $user->id,
            'content' => $request->content,
        ]);
        return redirect()->back()->with('message', 'Đã thêm comment!');
    }
}
