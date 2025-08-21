<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::whereTranslation('slug', $slug)->where('published', true)->with(['category', 'tags'])->firstOrFail();

        return view('blog.post', compact('post'));
    }
}
