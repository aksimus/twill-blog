@props([
    'title' => null, 'description' => null, 'keywords' => null, 'image' => null,
    'type' => 'website', 'author' => null, 'publishedTime' => null, 'modifiedTime' => null
])
@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    use App\Services\ContentLanguageSwitcherService;
    
    $currentRoute = request()->route();
    $routeName = $currentRoute ? $currentRoute->getName() : null;
    $routeParams = $currentRoute ? $currentRoute->parameters() : [];
    
    // Fallback: extract slug from URL path if route parameters are empty
    if (empty($routeParams) && $routeName) {
        $path = request()->path();
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
    }
    
    $localizableRoutes = ['blog.index', 'blog.category', 'blog.tag', 'blog.post', 'frontend.home', 'frontend.page', 'rates.index', 'rates.show'];
    $contentLanguageService = app(ContentLanguageSwitcherService::class);
    $supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());
    $currentLocale = app()->getLocale();
@endphp

<!-- Basic Meta Tags -->
@if($title)
    <title>{{ $title }}</title>
    <meta name="title" content="{{ $title }}">
@endif

@if($description)
    <meta name="description" content="{{ $description }}">
@endif

@if($keywords)
    <meta name="keywords" content="{{ $keywords }}">
@endif

@if($author)
    <meta name="author" content="{{ $author }}">
@endif

<!-- Open Graph Meta Tags -->
@if($title)
    <meta property="og:title" content="{{ $title }}">
@endif

@if($description)
    <meta property="og:description" content="{{ $description }}">
@endif

<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ request()->url() }}">

@if($image)
    <meta property="og:image" content="{{ $image }}">
@endif

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
@if($title)
    <meta name="twitter:title" content="{{ $title }}">
@endif

@if($description)
    <meta name="twitter:description" content="{{ $description }}">
@endif

@if($image)
    <meta name="twitter:image" content="{{ $image }}">
@endif

<!-- Article Specific Meta Tags -->
@if($type === 'article')
    @if($publishedTime)
        <meta property="article:published_time" content="{{ $publishedTime }}">
    @endif
    
    @if($modifiedTime)
        <meta property="article:modified_time" content="{{ $modifiedTime }}">
    @endif
    
    @if($author)
        <meta property="article:author" content="{{ $author }}">
    @endif
@endif

<!-- Canonical URL -->
@if($routeName && in_array($routeName, $localizableRoutes))
    @php $currentUrl = $contentLanguageService->getLocalizedContentUrl($currentLocale, $routeName, $routeParams); @endphp
    @if($currentUrl) <link rel="canonical" href="{{ $currentUrl }}" /> @endif
@endif

<!-- Alternate Language Links (Hreflang) -->
@if($routeName && in_array($routeName, $localizableRoutes))
    @foreach($supportedLocales as $locale)
        @php
            $localeUrl = $contentLanguageService->getLocalizedContentUrl($locale, $routeName, $routeParams);
            $isAvailable = $localeUrl !== null;
        @endphp
        @if($isAvailable)
            <link rel="alternate" hreflang="{{ $locale }}" href="{{ $localeUrl }}" />
        @endif
    @endforeach
    
    @php
        $defaultLocale = config('app.locale') ?? 'en';
        $defaultUrl = $contentLanguageService->getLocalizedContentUrl($defaultLocale, $routeName, $routeParams);
    @endphp
    @if($defaultUrl && $currentLocale !== $defaultLocale)
        <link rel="alternate" hreflang="x-default" href="{{ $defaultUrl }}" />
    @endif
@endif 