<?php

namespace App\Services;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class SeoMetaService
{
    protected ContentLanguageSwitcherService $contentLanguageService;
    protected array $localizableRoutes;
    protected array $supportedLocales;
    protected string $currentLocale;
    protected string $defaultLocale;

    public function __construct(ContentLanguageSwitcherService $contentLanguageService)
    {
        $this->contentLanguageService = $contentLanguageService;
        $this->localizableRoutes = [
            'blog.index', 'blog.category', 'blog.tag', 'blog.post', 'blog.tags',
            'frontend.home', 'frontend.page', 'rates.index', 'rates.show'
        ];
        $this->supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());
        $this->currentLocale = app()->getLocale();
        $this->defaultLocale = 'en'; // Always use 'en' as the default locale
    }

    /**
     * Get SEO meta data for the current route
     */
    public function getMetaData(array $overrides = []): array
    {
        $currentRoute = request()->route();
        $routeName = $currentRoute ? $currentRoute->getName() : null;
        $routeParams = $this->extractRouteParams($currentRoute);

        $defaultMeta = $this->getDefaultMetaForRoute($routeName, $routeParams);
        
        // Merge with controller overrides
        $meta = array_merge($defaultMeta, $overrides);

        // Add canonical and hreflang URLs
        if ($routeName && in_array($routeName, $this->localizableRoutes)) {
            $meta['canonical'] = $this->getCanonicalUrl($routeName, $routeParams);
            $meta['hreflang'] = $this->getHreflangUrls($routeName, $routeParams);
        }

        return $meta;
    }

    /**
     * Extract route parameters with fallback logic
     */
    protected function extractRouteParams($currentRoute): array
    {
        $routeParams = $currentRoute ? $currentRoute->parameters() : [];
        
        // Fallback: extract slug from URL path if route parameters are empty
        if (empty($routeParams) && $currentRoute) {
            $path = request()->path();
            $routeParams = $this->extractSlugFromPath($path, $currentRoute->getName());
        }
        
        return $routeParams;
    }

    /**
     * Extract slug from URL path for various route types
     */
    protected function extractSlugFromPath(string $path, ?string $routeName): array
    {
        $routeParams = [];

        if (str_contains($path, 'blog/category/')) {
            $parts = explode('blog/category/', $path);
            if (count($parts) > 1) {
                $routeParams['slug'] = $parts[1];
            }
        } elseif (str_contains($path, 'blog/tag/')) {
            $parts = explode('blog/tag/', $path);
            if (count($parts) > 1) {
                $routeParams['slug'] = $parts[1];
            }
        } elseif (str_contains($path, 'blog/') && !str_contains($path, 'blog/category/') && !str_contains($path, 'blog/tag/')) {
            $parts = explode('blog/', $path);
            if (count($parts) > 1) {
                $routeParams['slug'] = $parts[1];
            }
        } elseif ($routeName === 'frontend.page' && !str_contains($path, 'blog/')) {
            $pathParts = explode('/', $path);
            if (count($pathParts) > 0) {
                $lastPart = end($pathParts);
                if (!empty($lastPart) && !in_array($lastPart, ['en', 'es', 'ru'])) {
                    $routeParams['slug'] = $lastPart;
                }
            }
        }

        return $routeParams;
    }

    /**
     * Get default meta data for specific routes
     */
    protected function getDefaultMetaForRoute(?string $routeName, array $routeParams): array
    {
        switch ($routeName) {
            case 'frontend.home':
                return [
                    'title' => __('homepage.seo.title'),
                    'description' => __('homepage.seo.description'),
                    'type' => 'website',
                    'keywords' => __('homepage.seo.keywords'),
                ];

            case 'blog.index':
                return [
                    'title' => __('Blog - Our Latest Articles'),
                    'description' => __('Read our latest blog posts about technology, business, and innovation.'),
                    'type' => 'website',
                    'keywords' => 'blog, articles, technology, business, innovation',
                ];

            case 'rates.index':
                return [
                    'title' => __('IFTA Rates'),
                    'description' => __('Current IFTA rates by year and quarter.'),
                    'type' => 'website',
                    'keywords' => 'ifta rates',
                ];

            case 'rates.show':
                return [
                    'title' => __('IFTA Rates for :year Q:quarter', [
                        'year' => $routeParams['year'] ?? '',
                        'quarter' => $routeParams['quarter'] ?? ''
                    ]),
                    'description' => __('IFTA rates for :year Q:quarter period.', [
                        'year' => $routeParams['year'] ?? '',
                        'quarter' => $routeParams['quarter'] ?? ''
                    ]),
                    'type' => 'website',
                    'keywords' => 'IFTA rates, :year, Q:quarter, currency',
                ];

            default:
                return [
                    'title' => config('app.name', 'Laravel'),
                    'description' => __('Welcome to our website.'),
                    'type' => 'website',
                    'keywords' => '',
                ];
        }
    }

    /**
     * Get canonical URL for the current page
     */
    protected function getCanonicalUrl(string $routeName, array $routeParams): ?string
    {
        return $this->contentLanguageService->getLocalizedContentUrl(
            $this->currentLocale, 
            $routeName, 
            $routeParams
        );
    }

    /**
     * Get hreflang URLs for all supported locales
     */
    protected function getHreflangUrls(string $routeName, array $routeParams): array
    {
        $hreflangUrls = [];

        // Add alternate language links
        foreach ($this->supportedLocales as $locale) {
            $localeUrl = $this->contentLanguageService->getLocalizedContentUrl(
                $locale, 
                $routeName, 
                $routeParams
            );
            
            if ($localeUrl !== null) {
                $hreflangUrls[$locale] = $localeUrl;
            }
        }

        // Add x-default link
        $defaultUrl = $this->contentLanguageService->getLocalizedContentUrl(
            $this->defaultLocale, 
            $routeName, 
            $routeParams
        );
        
        if ($defaultUrl && $this->currentLocale !== $this->defaultLocale) {
            $hreflangUrls['x-default'] = $defaultUrl;
        }

        return $hreflangUrls;
    }

    /**
     * Generate HTML meta tags from meta data
     */
    public function generateMetaTags(array $metaData): string
    {
        $html = '';

        // Basic Meta Tags (don't generate title tag - it's handled by layout)
        if (!empty($metaData['title'])) {
            $html .= "<meta name=\"title\" content=\"{$metaData['title']}\">\n";
        }

        if (!empty($metaData['description'])) {
            $html .= "<meta name=\"description\" content=\"{$metaData['description']}\">\n";
        }

        if (!empty($metaData['keywords'])) {
            $html .= "<meta name=\"keywords\" content=\"{$metaData['keywords']}\">\n";
        }

        if (!empty($metaData['author'])) {
            $html .= "<meta name=\"author\" content=\"{$metaData['author']}\">\n";
        }

        // Open Graph Meta Tags
        if (!empty($metaData['title'])) {
            $html .= "<meta property=\"og:title\" content=\"{$metaData['title']}\">\n";
        }

        if (!empty($metaData['description'])) {
            $html .= "<meta property=\"og:description\" content=\"{$metaData['description']}\">\n";
        }

        $type = $metaData['type'] ?? 'website';
        $html .= "<meta property=\"og:type\" content=\"{$type}\">\n";
        $html .= "<meta property=\"og:url\" content=\"" . request()->url() . "\">\n";

        if (!empty($metaData['image'])) {
            $html .= "<meta property=\"og:image\" content=\"{$metaData['image']}\">\n";
        }

        // Twitter Card Meta Tags
        $html .= "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
        
        if (!empty($metaData['title'])) {
            $html .= "<meta name=\"twitter:title\" content=\"{$metaData['title']}\">\n";
        }

        if (!empty($metaData['description'])) {
            $html .= "<meta name=\"twitter:description\" content=\"{$metaData['description']}\">\n";
        }

        if (!empty($metaData['image'])) {
            $html .= "<meta name=\"twitter:image\" content=\"{$metaData['image']}\">\n";
        }

        // Article Specific Meta Tags
        if ($type === 'article') {
            if (!empty($metaData['publishedTime'])) {
                $html .= "<meta property=\"article:published_time\" content=\"{$metaData['publishedTime']}\">\n";
            }
            
            if (!empty($metaData['modifiedTime'])) {
                $html .= "<meta property=\"article:modified_time\" content=\"{$metaData['modifiedTime']}\">\n";
            }
            
            if (!empty($metaData['author'])) {
                $html .= "<meta property=\"article:author\" content=\"{$metaData['author']}\">\n";
            }
        }

        // Canonical URL
        if (!empty($metaData['canonical'])) {
            $html .= "<link rel=\"canonical\" href=\"{$metaData['canonical']}\" />\n";
        }

        // Alternate Language Links (Hreflang)
        if (!empty($metaData['hreflang'])) {
            foreach ($metaData['hreflang'] as $locale => $url) {
                $html .= "<link rel=\"alternate\" hreflang=\"{$locale}\" href=\"{$url}\" />\n";
            }
        }

        return $html;
    }
}
