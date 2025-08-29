<?php

namespace App\Http\Controllers;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogTagRepository;
use App\Traits\HasSeoMeta;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
	use HasSeoMeta;
	
	public function index(BlogPostRepository $posts, BlogCategoryRepository $categories): View
	{
		$items = $posts->get(with: ['category', 'blogTags', 'author'], scopes: ['published' => true], orders: ['created_at' => 'desc'], perPage: 10);
		
		// Get categories with posts count
		$allCategories = $categories->get(scopes: ['published' => true], orders: ['title' => 'asc']);
		$allCategories->each(function($category) {
			$category->posts_count = $category->posts()->where('published', true)->count();
		});
		
		// Share SEO meta data
		$this->shareSeoMeta();
		
		return view('site.blog.index', compact('items', 'allCategories'));
	}

	public function category(string $slug, BlogCategoryRepository $categories, BlogPostRepository $posts): View
	{
		$category = $categories->forSlug($slug);
		if (!$category) abort(404);
		
		$perPage = config('blog.post_per_page', 2);
		$items = $posts->get(with: ['category', 'blogTags', 'author'], scopes: ['blog_category_id' => $category->id, 'published' => true], orders: ['created_at' => 'desc'], perPage: $perPage);
		
		// Share SEO meta data for category
		$this->shareSeoMeta($this->getBlogCategorySeoMeta($category));
		
		return view('site.blog.category', compact('category', 'items'));
	}

	public function tag(string $slug, BlogTagRepository $tags, BlogPostRepository $posts): View
	{
		$tag = $tags->forSlug($slug);
		if (!$tag) abort(404);
		
		$perPage = config('blog.post_per_page', 2);
		
		// Get posts that have this tag, with pagination
		$items = $posts->get(with: ['blogTags', 'author'], orders: ['created_at' => 'desc'], perPage: -1);
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
		
		// Share SEO meta data for tag
		$this->shareSeoMeta($this->getBlogTagSeoMeta($tag));
		
		return view('site.blog.tag', compact('tag', 'items'));
	}

	public function tags(BlogTagRepository $tags): View
	{
		$allTags = $tags->get(scopes: ['published' => true], orders: ['title' => 'asc']);
		
		// Add posts count for each tag
		$allTags->each(function($tag) {
			$tag->posts_count = $tag->blogPosts()->where('published', true)->count();
		});
		
		// Get SEO meta data for tags index
		$seoMeta = $this->getSeoMeta();
		
		return view('site.blog.tags', compact('allTags', 'seoMeta'));
	}

	public function show(string $slug, BlogPostRepository $posts): View
	{
		$post = $posts->forSlug($slug, with: ['category', 'blogTags', 'author']);
		if (!$post) abort(404);
		
		// Get related posts from the same category
		$relatedPosts = collect();
		if ($post->category) {
			$relatedPosts = $posts->get(
				with: ['category', 'author'], 
				scopes: ['blog_category_id' => $post->category->id, 'published' => true], 
				orders: ['created_at' => 'desc'], 
				perPage: 3
			)->filter(fn($relatedPost) => $relatedPost->id !== $post->id)->take(3);
		}
		
		// Add reading time estimation (rough estimate: 200 words per minute)
		$wordCount = str_word_count(strip_tags($post->description ?? ''));
		$readingTime = max(1, round($wordCount / 200));
		$post->reading_time = $readingTime . ' min read';
		
		// Add social media counts (placeholder values)
		$post->likes_count = rand(5, 25);
		$post->shares_count = rand(2, 10);
		
		// Share SEO meta data for blog post
		$this->shareSeoMeta($this->getBlogPostSeoMeta($post));
		
		return view('site.blog.post', compact('post', 'relatedPosts'));
	}
} 