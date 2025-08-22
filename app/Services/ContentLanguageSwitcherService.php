<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\DB;

class ContentLanguageSwitcherService
{
    /**
     * Get the localized URL for content based on route name and parameters
     */
    public function getLocalizedContentUrl(string $targetLocale, string $routeName, array $routeParams): ?string
    {
        switch ($routeName) {
            case 'blog.post':
                return $this->getLocalizedPostUrl($targetLocale, $routeParams['slug'] ?? null);

            case 'blog.category':
                return $this->getLocalizedCategoryUrl($targetLocale, $routeParams['slug'] ?? null);

            case 'blog.tag':
                return $this->getLocalizedTagUrl($targetLocale, $routeParams['slug'] ?? null);

            case 'blog.index':
                return $this->getLocalizedIndexUrl($targetLocale);

            case 'frontend.home':
                return $this->getLocalizedHomeUrl($targetLocale);

            case 'frontend.page':
                return $this->getLocalizedPageUrl($targetLocale, $routeParams['slug'] ?? null);

            default:
                return null;
        }
    }

    /**
     * Get the localized URL for a blog post
     */
    private function getLocalizedPostUrl(string $targetLocale, ?string $currentSlug): ?string
    {
        if (!$currentSlug) {
            return null;
        }

        // Use the repository to find the post by slug (this handles Twill's slug system correctly)
        $postRepository = app(\App\Repositories\BlogPostRepository::class);
        $currentPost = $postRepository->forSlug($currentSlug);

        if (!$currentPost) {
            return null;
        }

        // Get the slug for the target language
        $targetSlug = $this->getSlugForLocale($currentPost, $targetLocale);
        if (!$targetSlug) {
            return null;
        }

        // Generate the URL for the target language using the translated slug
        return $this->generateLocalizedUrl($targetLocale, 'blog', $targetSlug);
    }

    /**
     * Get the localized URL for a blog category
     */
    private function getLocalizedCategoryUrl(string $targetLocale, ?string $currentSlug): ?string
    {
        if (!$currentSlug) {
            return null;
        }

        // Use the repository to find the category by slug
        $categoryRepository = app(\App\Repositories\BlogCategoryRepository::class);
        $currentCategory = $categoryRepository->forSlug($currentSlug);

        if (!$currentCategory) {
            return null;
        }

        // Get the slug for the target language
        $targetSlug = $this->getSlugForLocale($currentCategory, $targetLocale);
        if (!$targetSlug) {
            return null;
        }

        // Generate the URL for the target language using the translated slug
        return $this->generateLocalizedUrl($targetLocale, 'blog/category', $targetSlug);
    }

    /**
     * Get the localized URL for a blog tag
     */
    private function getLocalizedTagUrl(string $targetLocale, ?string $currentSlug): ?string
    {
        if (!$currentSlug) {
            return null;
        }

        // Use the repository to find the tag by slug
        $tagRepository = app(\App\Repositories\BlogTagRepository::class);
        $currentTag = $tagRepository->forSlug($currentSlug);

        if (!$currentTag) {
            return null;
        }

        // Get the slug for the target language
        $targetSlug = $this->getSlugForLocale($currentTag, $targetLocale);
        if (!$targetSlug) {
            return null;
        }

        // Generate the URL for the target language using the translated slug
        return $this->generateLocalizedUrl($targetLocale, 'blog/tag', $targetSlug);
    }

    /**
     * Get the localized URL for blog index
     */
    private function getLocalizedIndexUrl(string $targetLocale): string
    {
        return $this->generateLocalizedUrl($targetLocale, 'blog');
    }

    /**
     * Get the localized URL for home page
     */
    private function getLocalizedHomeUrl(string $targetLocale): string
    {
        return $this->generateLocalizedUrl($targetLocale, '');
    }

    /**
     * Get the localized URL for a general page
     */
    private function getLocalizedPageUrl(string $targetLocale, ?string $currentSlug): ?string
    {
        if (!$currentSlug) {
            return null;
        }

        // Use the PageRepository to find the page by slug
        $pageRepository = app(\App\Repositories\PageRepository::class);
        $currentPage = $pageRepository->forSlug($currentSlug);

        if (!$currentPage) {
            return null;
        }

        // Get the slug for the target language
        $targetSlug = $this->getSlugForLocale($currentPage, $targetLocale);
        if (!$targetSlug) {
            return null;
        }

        // Generate the URL for the target language using the translated slug
        return $this->generateLocalizedUrl($targetLocale, $targetSlug);
    }

    /**
     * Get the slug for a specific locale from a Twill model
     */
    private function getSlugForLocale($model, string $locale): ?string
    {
        // Try to get the slug from the slugs relationship
        if (method_exists($model, 'slugs')) {
            $slug = $model->slugs()->where('locale', $locale)->first();
            if ($slug) {
                return $slug->slug;
            }
        }
        
        // Fallback: try to get from the current locale if it's the same
        if ($locale === app()->getLocale()) {
            return $model->getSlug();
        }
        
        return null;
    }

    /**
     * Generate a localized URL
     */
    private function generateLocalizedUrl(string $locale, string $path, ?string $slug = null): string
    {
        $fullPath = $slug ? "{$path}/{$slug}" : $path;
        
        if ($locale === config('app.locale') || $locale === config('app.fallback_locale')) {
            // Default language - no prefix
            return url($fullPath);
        }
        
        // Other languages - add prefix
        return url("{$locale}/{$fullPath}");
    }

    /**
     * Check if content exists in the target locale
     */
    public function contentExistsInLocale(string $targetLocale, string $routeName, array $routeParams): bool
    {
        // Check if content actually exists in the target locale
        $localizedUrl = $this->getLocalizedContentUrl($targetLocale, $routeName, $routeParams);
        return $localizedUrl !== null;
    }

    /**
     * Get all available locales for the current content
     */
    public function getAvailableLocales(string $routeName, array $routeParams): array
    {
        $availableLocales = [];
        $supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());

        foreach ($supportedLocales as $locale) {
            if ($this->contentExistsInLocale($locale, $routeName, $routeParams)) {
                $availableLocales[] = $locale;
            }
        }

        return $availableLocales;
    }
} 