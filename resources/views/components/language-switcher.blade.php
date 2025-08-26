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
        } elseif ($routeName === 'frontend.home' && !str_contains($path, 'blog/')) {
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
    <div class="dropdown language-switcher">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bx bx-globe me-1"></i>
            @switch($currentLocale)
                @case('en')
                    EN
                    @break
                @case('es')
                    ES
                    @break
                @case('ru')
                    RU
                    @break
                @default
                    {{ strtoupper($currentLocale) }}
            @endswitch
        </button>
        
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            @foreach($supportedLocales as $locale)
                @if(1 || $locale !== $currentLocale)
                    @php
                        // Get the localized URL for the same content in different language
                        $localeUrl = $contentLanguageService->getLocalizedContentUrl($locale, $routeName, $routeParams);
                        $isAvailable = $localeUrl !== null;
                    @endphp
                    
              

                    <li>
                        @if($isAvailable)
                            <a class="dropdown-item" href="{{ $localeUrl }}" hreflang="{{ $locale }}" title="{{ LaravelLocalization::getSupportedLocales()[$locale]['native'] }}">
                                @switch($locale)
                                    @case('en')
                                    🇺🇸 English
                                        @break
                                    @case('es')
                                    🇪🇸 Español
                                        @break
                                    @case('ru')
                                    🇷🇺 Русский
                                        @break
                                    @default
                                        {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] ?? $locale }}
                                @endswitch
                            </a>
                        @else
                            <span class="dropdown-item text-muted" title="{{ __('Content not available in this language') }}">
                                @switch($locale)
                                    @case('en')
                                        English
                                        @break
                                    @case('es')
                                        Español
                                        @break
                                    @case('ru')
                                        Русский
                                        @break
                                    @default
                                        {{ LaravelLocalization::getSupportedLocales()[$locale]['native'] ?? $locale }}
                                @endswitch
                                <small class="text-muted ms-1">*</small>
                            </span>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
