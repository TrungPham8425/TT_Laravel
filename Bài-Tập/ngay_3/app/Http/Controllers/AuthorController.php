<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Hiển thị danh sách tác giả
    public function index()
    {
        $authors = Author::withCount('posts')->get();
        return view('authors.index', compact('authors'));
    }
}
