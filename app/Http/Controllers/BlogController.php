<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->with('translations')->get();

        return view('blog.index', compact('posts'));
    }
}
