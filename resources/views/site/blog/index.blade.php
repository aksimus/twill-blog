<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    
    <x-seo-meta 
        title="{{ __('Blog') }}"
        description="{{ __('Discover our latest articles, insights, and stories.') }}"
        type="website"
    />
    
    @vite('resources/css/app.css')
</head>
<body>
    <x-menu/>
    
    <x-language-switcher />
    
    <div class="mx-auto max-w-4xl px-5 md:px-0">
        <div class="mt-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Blog') }}</h1>
            <p class="text-lg text-gray-600 mb-8">{{ __('Discover our latest articles, insights, and stories.') }}</p>
        </div>

        @forelse($items as $post)
            <article class="mb-8 p-6 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                <header class="mb-4">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">
                        <a href="{{ route('blog.post', $post->getSlug()) }}" 
                           class="hover:text-blue-600 transition-colors">
                            {{ $post->title }}
                        </a>
                    </h2>
                    
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                        <time datetime="{{ $post->created_at->toISOString() }}">
                            {{ $post->created_at->format('M j, Y') }}
                        </time>
                        
                        @if($post->category)
                            <span class="flex items-center gap-1">
                                <span class="text-gray-400">•</span>
                                <a href="{{ route('blog.category', $post->category->getSlug()) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    {{ $post->category->title }}
                                </a>
                            </span>
                        @endif
                    </div>
                </header>

                @if($post->description)
                    <div class="text-gray-700 mb-4 leading-relaxed">
                        {!! \Illuminate\Support\Str::limit($post->description, 200) !!}
                    </div>
                @endif

                @if($post->blogTags && $post->blogTags->count() > 0)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($post->blogTags as $tag)
                            <a href="{{ route('blog.tag', $tag->getSlug()) }}" 
                               class="inline-block px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition-colors">
                                {{ $tag->title }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <footer class="flex items-center justify-between">
                    <a href="{{ route('blog.post', $post->getSlug()) }}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                        {{ __('Read more') }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </footer>
            </article>
        @empty
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __('No posts found') }}</h3>
                <p class="text-gray-600">{{ __('The blog is empty. Check back soon for new content!') }}</p>
            </div>
        @endforelse

        @if($items->hasPages())
            <div class="mt-8 text-center">
                <div class="text-sm text-gray-600">
                    {{ __('Showing') }} {{ $items->firstItem() ?? 0 }} {{ __('of') }} {{ $items->total() }} {{ __('posts') }}
                </div>
            </div>
        @endif
    </div>
</body>
</html> 