<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::whereTranslation('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('published', true)->with('translations')->get();

        return view('blog.category', compact('category', 'posts'));
    }
}
