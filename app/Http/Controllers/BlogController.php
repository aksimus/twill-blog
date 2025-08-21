<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(PostRepository $posts): View
    {
        $items = $posts->published()->get();
        return view('site.blog.index', ['posts' => $items]);
    }

    public function post(string $slug, PostRepository $posts): View
    {
        $post = $posts->forSlug($slug);
        abort_unless($post, 404);
        return view('site.blog.post', ['item' => $post]);
    }

    public function category(string $slug, CategoryRepository $categories, PostRepository $posts): View
    {
        $category = $categories->forSlug($slug);
        abort_unless($category, 404);
        $items = $posts->published()->where('category_id', $category->id)->get();
        return view('site.blog.category', ['category' => $category, 'posts' => $items]);
    }

    public function tag(string $slug, TagRepository $tags, PostRepository $posts): View
    {
        $tag = $tags->forSlug($slug);
        abort_unless($tag, 404);
        $items = $posts->published()->whereHas('tags', function ($q) use ($tag) {
            $q->where('tags.id', $tag->id);
        })->get();
        return view('site.blog.tag', ['tag' => $tag, 'posts' => $items]);
    }
}
