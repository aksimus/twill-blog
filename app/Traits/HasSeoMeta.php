<?php

namespace App\Traits;

use App\Services\SeoMetaService;

trait HasSeoMeta
{
    /**
     * Get SEO meta data with controller overrides
     */
    protected function getSeoMeta(array $overrides = []): array
    {
        $seoService = app(SeoMetaService::class);
        return $seoService->getMetaData($overrides);
    }

    /**
     * Share SEO meta data with the view
     */
    protected function shareSeoMeta(array $overrides = []): void
    {
        $seoMeta = $this->getSeoMeta($overrides);
        view()->share('seoMeta', $seoMeta);
    }

    /**
     * Get SEO meta data for blog posts
     */
    protected function getBlogPostSeoMeta($post, array $additionalMeta = []): array
    {
        $meta = [
            'title' => $post->title ?? '',
            'description' => $post->meta_description ?? $post->description ?? '',
            'keywords' => $post->meta_keywords ?? '',
            'type' => 'article',
            'publishedTime' => $post->created_at?->toISOString(),
            'modifiedTime' => $post->updated_at?->toISOString(),
        ];

        if ($post->author) {
            $meta['author'] = $post->author->name ?? '';
        }

        if ($post->hasImage('cover')) {
            $meta['image'] = $post->image('cover');
        }

        return array_merge($meta, $additionalMeta);
    }

    /**
     * Get SEO meta data for blog categories
     */
    protected function getBlogCategorySeoMeta($category, array $additionalMeta = []): array
    {
        $meta = [
            'title' => $category->title ?? '',
            'description' => $category->meta_description ?? $category->description ?? '',
            'keywords' => $category->meta_keywords ?? '',
            'type' => 'website',
        ];

        if ($category->hasImage('cover')) {
            $meta['image'] = $category->image('cover');
        }

        return array_merge($meta, $additionalMeta);
    }

    /**
     * Get SEO meta data for blog tags
     */
    protected function getBlogTagSeoMeta($tag, array $additionalMeta = []): array
    {
        $meta = [
            'title' => $tag->title ?? '',
            'description' => $tag->meta_description ?? $tag->description ?? '',
            'keywords' => $tag->meta_keywords ?? '',
            'type' => 'website',
        ];

        if ($tag->hasImage('cover')) {
            $meta['image'] = $tag->image('cover');
        }

        return array_merge($meta, $additionalMeta);
    }

    /**
     * Get SEO meta data for pages
     */
    protected function getPageSeoMeta($page, array $additionalMeta = []): array
    {
        $meta = [
            'title' => $page->title ?? '',
            'description' => $page->meta_description ?? $page->description ?? '',
            'keywords' => $page->meta_keywords ?? '',
            'type' => 'article',
        ];

        if ($page->hasImage('cover')) {
            $meta['image'] = $page->image('cover');
        }

        return array_merge($meta, $additionalMeta);
    }
}
