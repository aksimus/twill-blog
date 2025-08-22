@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    use App\Services\ContentLanguageSwitcherService;

    $currentLocale = app()->getLocale();
    $supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());
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
            // Handle general page routes (e.g., /about, /ru/about, /es/about)
            // The slug is the last part of the path
            $pathParts = explode('/', $path);
            if (count($pathParts) > 0) {
                $lastPart = end($pathParts);
                if (!empty($lastPart) && !in_array($lastPart, ['en', 'es', 'ru'])) {
                    $routeParams['slug'] = $lastPart;
                }
            }
        }
    }
    
    // Define which routes support language switching
    $localizableRoutes = ['blog.index', 'blog.category', 'blog.tag', 'blog.post', 'frontend.home', 'frontend.page'];
    
    // Use the content language switcher service
    $contentLanguageService = app(ContentLanguageSwitcherService::class);
@endphp

@if($routeName && in_array($routeName, $localizableRoutes))
    <div class="language-switcher">
        <div class="language-switcher__current">
            <span class="language-switcher__label">
                <svg class="language-switcher__icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.01-4.65.77-6.99-.97-1.53-2.49-2.73-4.23-3.4C5.54.88 3.61 1.92 2.72 3.73c-.89 1.81-.29 3.91 1.5 5.47 1.79 1.56 4.51 2.13 6.65 1.65l2.54 2.51.03.03c.19.19.49.19.68 0 .19-.19.19-.49 0-.68z"/>
                </svg>
                {{ __('Language') }}:
            </span>
            <span class="language-switcher__current-lang">
                {{ LaravelLocalization::getSupportedLocales()[$currentLocale]['native'] ?? $currentLocale }}
            </span>
        </div>
        
        <ul class="language-switcher__list">
            @foreach($supportedLocales as $locale)
                @if($locale !== $currentLocale)
                    @php
                        // Get the localized URL for the same content in different language
                        $localeUrl = $contentLanguageService->getLocalizedContentUrl($locale, $routeName, $routeParams);
                        $isAvailable = $localeUrl !== null;
                    @endphp
                    
                    <li class="language-switcher__item">
                        @if($isAvailable)
                            <a href="{{ $localeUrl }}" 
                               class="language-switcher__link"
                               hreflang="{{ $locale }}"
                               title="{{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}">
                                <span class="language-switcher__flag">
                                    @switch($locale)
                                        @case('en')
                                            🇺🇸
                                            @break
                                        @case('es')
                                            🇪🇸
                                            @break
                                        @case('ru')
                                            🇷🇺
                                            @break
                                        @default
                                            🌐
                                    @endswitch
                                </span>
                                {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}
                            </a>
                        @else
                            <span class="language-switcher__link language-switcher__link--unavailable"
                                  title="{{ __('Content not available in this language') }}">
                                <span class="language-switcher__flag">
                                    @switch($locale)
                                        @case('en')
                                            🇺🇸
                                            @break
                                        @case('es')
                                            🇪🇸
                                            @break
                                        @case('ru')
                                            🇷🇺
                                            @break
                                        @default
                                            🌐
                                    @endswitch
                                </span>
                                {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}
                                <span class="language-switcher__unavailable-indicator">*</span>
                            </span>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif 