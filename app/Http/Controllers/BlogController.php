<?php

namespace App\Http\Controllers;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogTagRepository;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
	public function index(BlogPostRepository $posts, BlogCategoryRepository $categories): View
	{
		$items = $posts->get(with: ['category', 'blogTags'], scopes: ['published' => true], orders: ['created_at' => 'desc'], perPage: 10);
		
		// Get categories with posts count
		$allCategories = $categories->get(scopes: ['published' => true], orders: ['title' => 'asc']);
		$allCategories->each(function($category) {
			$category->posts_count = $category->posts()->where('published', true)->count();
		});
		
		return view('site.blog.index', compact('items', 'allCategories'));
	}

	public function category(string $slug, BlogCategoryRepository $categories, BlogPostRepository $posts): View
	{
		$category = $categories->forSlug($slug);
		if (!$category) abort(404);
		
		$perPage = config('blog.post_per_page', 2);
		$items = $posts->get(with: ['category', 'blogTags'], scopes: ['blog_category_id' => $category->id, 'published' => true], orders: ['created_at' => 'desc'], perPage: $perPage);
		
		return view('site.blog.category', compact('category', 'items'));
	}

	public function tag(string $slug, BlogTagRepository $tags, BlogPostRepository $posts): View
	{
		$tag = $tags->forSlug($slug);
		if (!$tag) abort(404);
		
		$perPage = config('blog.post_per_page', 2);
		
		// Get posts that have this tag, with pagination
		$items = $posts->get(with: ['blogTags'], orders: ['created_at' => 'desc'], perPage: -1);
		$filteredItems = $items->filter(fn($p) => $p->blogTags->contains('id', $tag->id));
		
		// Manually paginate the filtered results
		$currentPage = request()->get('page', 1);
		$perPage = config('blog.post_per_page', 2);
		$offset = ($currentPage - 1) * $perPage;
		$paginatedItems = $filteredItems->slice($offset, $perPage);
		
		// Create a LengthAwarePaginator instance
		$items = new \Illuminate\Pagination\LengthAwarePaginator(
			$paginatedItems,
			$filteredItems->count(),
			$perPage,
			$currentPage,
			['path' => request()->url(), 'query' => request()->query()]
		);
		
		return view('site.blog.tag', compact('tag', 'items'));
	}

	public function tags(BlogTagRepository $tags): View
	{
		$allTags = $tags->get(scopes: ['published' => true], orders: ['title' => 'asc']);
		
		// Add posts count for each tag
		$allTags->each(function($tag) {
			$tag->posts_count = $tag->blogPosts()->where('published', true)->count();
		});
		
		return view('site.blog.tags', compact('allTags'));
	}

	public function show(string $slug, BlogPostRepository $posts): View
	{
		$item = $posts->forSlug($slug, with: ['category', 'blogTags']);
		if (!$item) abort(404);
		return view('site.blog.post', compact('item'));
	}
} 