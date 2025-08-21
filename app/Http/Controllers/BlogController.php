<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('translations')->where('published', true)->get();
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::whereTranslation('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }

    public function category(string $slug)
    {
        $category = BlogCategory::whereTranslation('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('published', true)->get();
        return view('blog.category', compact('category', 'posts'));
    }

    public function tag(string $slug)
    {
        $tag = BlogTag::whereTranslation('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('published', true)->get();
        return view('blog.tag', compact('tag', 'posts'));
    }
}

