<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    
    <x-seo-meta 
        title="{{ __('Tags') }}"
        description="{{ __('Browse all blog tags and discover content by topic.') }}"
        type="website"
    />
    
    @vite('resources/css/app.css')
</head>
<body>
    <x-menu/>
    
    <x-language-switcher />
    
    <div class="mx-auto max-w-4xl px-5 md:px-0">
        <div class="mt-16">
            <div class="mb-8">
                <nav class="text-sm text-gray-500 mb-4">
                    <a href="@localizedUrl('blog')" class="hover:text-blue-600 transition-colors">
                        {{ __('Blog') }}
                    </a>
                    <span class="mx-2">→</span>
                    <span class="text-gray-900">{{ __('Tags') }}</span>
                </nav>
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Tags') }}</h1>
                <p class="text-lg text-gray-600">{{ __('Browse all blog tags and discover content by topic.') }}</p>
            </div>

            @if($allTags && $allTags->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($allTags as $tag)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h2 class="text-xl font-semibold text-gray-900">
                                        <a href="@localizedUrl('blog/tag/' . $tag->getSlug())" 
                                           class="hover:text-blue-600 transition-colors">
                                            {{ $tag->title }}
                                        </a>
                                    </h2>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                        {{ $tag->posts_count }} {{ __('posts') }}
                                    </span>
                                </div>
                                
                                @if($tag->description)
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                        {{ \Illuminate\Support\Str::limit($tag->description, 120) }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <a href="@localizedUrl('blog/tag/' . $tag->getSlug())" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                        {{ __('View Posts') }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 text-center">
                    <a href="@localizedUrl('blog')" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        {{ __('Back to Blog') }}
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __('No Tags Found') }}</h3>
                    <p class="text-gray-600 mb-4">{{ __('No tags have been created yet.') }}</p>
                    <a href="@localizedUrl('blog')" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        {{ __('Back to Blog') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html> 