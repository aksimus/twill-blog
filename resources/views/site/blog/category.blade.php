<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    
    <x-seo-meta 
        :title="$category->title"
        :description="$category->description"
        type="website"
    />
    
    @vite('resources/css/app.css')
</head>
<body>
    <x-menu/>
    
    <x-language-switcher />
    
    <div class="mx-auto max-w-4xl px-5 md:px-0">
        <!-- Breadcrumb Navigation -->
        <nav class="mt-16 mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li>
                    <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition-colors">
                        {{ __('Blog') }}
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $category->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- Category Header -->
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $category->title }}</h1>
            
            @if($category->description)
                <div class="text-lg text-gray-600 mb-4">
                    {!! $category->description !!}
                </div>
            @endif
            
            <div class="text-sm text-gray-500">
                {{ __('Found') }} {{ $items->count() }} {{ __('posts in this category') }}
            </div>
        </header>

        <!-- Posts List -->
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
                        
                        @if($post->blogTags && $post->blogTags->count() > 0)
                            <span class="flex items-center gap-1">
                                <span class="text-gray-400">•</span>
                                <span class="text-gray-600">{{ __('Tags') }}:</span>
                                @foreach($post->blogTags as $tag)
                                    <a href="{{ route('blog.tag', $tag->getSlug()) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors">
                                        {{ $tag->title }}
                                    </a>
                                    @if(!$loop->last), @endif
                                @endforeach
                            </span>
                        @endif
                    </div>
                </header>

                @if($post->description)
                    <div class="text-gray-700 mb-4 leading-relaxed">
                        {!! \Illuminate\Support\Str::limit($post->description, 200) !!}
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
                <p class="text-gray-600">{{ __('This category doesn\'t have any posts yet.') }}</p>
            </div>
        @endforelse

        <!-- Back to Blog Link -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('blog.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('Back to Blog') }}
            </a>
        </div>
    </div>
</body>
</html>