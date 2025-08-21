<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show(string $slug)
    {
        $tag = Tag::whereTranslation('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('published', true)->with('translations')->get();

        return view('blog.tag', compact('tag', 'posts'));
    }
}
