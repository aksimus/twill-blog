<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    
    <x-seo-meta 
        :title="$item->title"
        :description="$item->description"
        type="article"
        :publishedTime="$item->created_at->toISOString()"
        :modifiedTime="$item->updated_at->toISOString()"
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
                    @if($item->category)
                        <a href="{{ route('blog.category', $item->category->getSlug()) }}" 
                           class="hover:text-blue-600 transition-colors">
                            {{ $item->category->title }}
                        </a>
                        <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    @endif
                    <span class="text-gray-900 font-medium">{{ $item->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- Post Header -->
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $item->title }}</h1>
            
            <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                <time datetime="{{ $item->created_at->toISOString() }}">
                    {{ $item->created_at->format('M j, Y') }}
                </time>
                
                @if($item->category)
                    <span class="flex items-center gap-1">
                        <span class="text-gray-400">•</span>
                        <a href="{{ route('blog.category', $item->category->getSlug()) }}" 
                           class="text-blue-600 hover:text-blue-800 transition-colors">
                            {{ $item->category->title }}
                        </a>
                    </span>
                @endif
            </div>

            @if($item->description)
                <div class="text-lg text-gray-600 mb-6">
                    {!! $item->description !!}
                </div>
            @endif
        </header>

        <!-- Post Content -->
        <article class="prose prose-lg max-w-none mb-12">
            {!! $item->renderBlocks() !!}
        </article>

        <!-- Post Footer -->
        <footer class="border-t border-gray-200 pt-8">
            <!-- Tags -->
            @if($item->blogTags && $item->blogTags->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Tags') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($item->blogTags as $tag)
                            <a href="{{ route('blog.tag', $tag->getSlug()) }}" 
                               class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition-colors">
                                {{ $tag->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Navigation Links -->
            <div class="flex flex-col sm:flex-row gap-4 justify-between">
                @if($item->category)
                    <a href="{{ route('blog.category', $item->category->getSlug()) }}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {{ __('Back to') }} {{ $item->category->title }}
                    </a>
                @endif
                
                <a href="{{ route('blog.index') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    {{ __('Back to Blog') }}
                </a>
            </div>
        </footer>
    </div>
</body>
</html> 