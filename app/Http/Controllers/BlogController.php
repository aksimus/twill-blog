<?php

namespace App\Http\Controllers;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogTagRepository;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
	public function index(BlogPostRepository $posts): View
	{
		$items = $posts->get(with: ['category', 'blogTags'], scopes: ['published' => true, 'visible' => true], orders: ['created_at' => 'desc'], perPage: 10);
		return view('site.blog.index', compact('items'));
	}

	public function category(string $slug, BlogCategoryRepository $categories, BlogPostRepository $posts): View
	{
		$category = $categories->forSlug($slug);
		if (!$category) abort(404);
		$items = $posts->get(with: ['category', 'blogTags'], scopes: ['blog_category_id' => $category->id, 'published' => true, 'visible' => true], orders: ['created_at' => 'desc'], perPage: 10);
		return view('site.blog.category', compact('category', 'items'));
	}

	public function tag(string $slug, BlogTagRepository $tags, BlogPostRepository $posts): View
	{
		$tag = $tags->forSlug($slug);
		if (!$tag) abort(404);
		$items = $posts->get(with: ['blogTags'], orders: ['created_at' => 'desc'], perPage: -1);
		$items = $items->filter(fn($p) => $p->blogTags->contains('id', $tag->id));
		return view('site.blog.tag', compact('tag', 'items'));
	}

	public function show(string $slug, BlogPostRepository $posts): View
	{
		$item = $posts->forSlug($slug, with: ['category', 'blogTags']);
		if (!$item) abort(404);
		return view('site.blog.post', compact('item'));
	}
} 