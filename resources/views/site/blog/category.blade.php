@extends('layouts.blog-layout')

@section('title', $category->title)

@section('meta')
<meta name="description" content="{{ $category->description }}">
@endsection

@section('content')
  <div class="container mt-4 pt-lg-2 pb-3">
    <!-- Breadcrumb Navigation -->
    <nav class="mb-4" aria-label="Breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('blog.index') }}" class="text-decoration-none">
            {{ __('Blog') }}
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ $category->title }}
        </li>
      </ol>
    </nav>

    <!-- Category Header -->
    <header class="mb-5">
      <h1 class="h1 mb-3">{{ $category->title }}</h1>
      
      @if($category->description)
        <div class="fs-lg text-muted mb-3">
          {!! $category->description !!}
        </div>
      @endif
      
      <div class="text-sm text-muted">
        {{ __('Found') }} {{ $items->count() }} {{ __('posts in this category') }}
      </div>
    </header>

    <!-- Posts List -->
    <div class="row">
      @forelse($items as $post)
        <article class="col-lg-6 mb-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
              <header class="mb-3">
                <h2 class="h5 mb-2">
                  <a href="{{ route('blog.post', $post->getSlug()) }}" 
                     class="text-decoration-none">
                    {{ $post->title }}
                  </a>
                </h2>
                
                <div class="d-flex align-items-center gap-3 text-sm text-muted mb-3">
                  <time datetime="{{ $post->created_at->toISOString() }}">
                    {{ $post->created_at->format('M j, Y') }}
                  </time>
                  
                  @if($post->blogTags && $post->blogTags->count() > 0)
                    <span class="d-flex align-items-center gap-1">
                      <span class="text-muted">•</span>
                      <span class="text-muted">{{ __('Tags') }}:</span>
                      @foreach($post->blogTags as $tag)
                        <a href="{{ route('blog.tag', $tag->getSlug()) }}" 
                           class="text-primary text-decoration-none">
                          {{ $tag->title }}
                        </a>
                        @if(!$loop->last), @endif
                      @endforeach
                    </span>
                  @endif
                </div>
              </header>

              @if($post->description)
                <div class="text-muted mb-4">
                  {!! \Illuminate\Support\Str::limit($post->description, 150) !!}
                </div>
              @endif

              <footer class="mt-auto">
                <a href="{{ route('blog.post', $post->getSlug()) }}" 
                   class="btn btn-outline-primary btn-sm">
                  {{ __('Read more') }}
                  <i class="bx bx-right-arrow-alt ms-1"></i>
                </a>
              </footer>
            </div>
          </div>
        </article>
      @empty
        <div class="col-12">
          <div class="text-center py-5">
            <div class="text-muted mb-4">
              <i class="bx bx-file-blank display-4"></i>
            </div>
            <h3 class="h4 mb-2">{{ __('No posts found') }}</h3>
            <p class="text-muted">{{ __('This category doesn\'t have any posts yet.') }}</p>
          </div>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($items->hasPages())
      <div class="mt-5 pt-4 border-top">
        <div class="d-flex align-items-center justify-content-between">
          <div class="text-sm text-muted">
            {{ __('Showing') }} {{ $items->firstItem() }} - {{ $items->lastItem() }} {{ __('of') }} {{ $items->total() }} {{ __('posts') }}
          </div>
          
          <div class="d-flex align-items-center gap-2">
            @if($items->onFirstPage())
              <span class="btn btn-outline-secondary btn-sm disabled">
                {{ __('Previous') }}
              </span>
            @else
              <a href="@localizedUrl('blog/category/' . $category->getSlug(), ['page' => $items->currentPage() - 1])" 
                 class="btn btn-outline-primary btn-sm">
                {{ __('Previous') }}
              </a>
            @endif
            
            @if($items->hasMorePages())
              <a href="@localizedUrl('blog/category/' . $category->getSlug(), ['page' => $items->currentPage() + 1])" 
                 class="btn btn-outline-primary btn-sm">
                {{ __('Next') }}
              </a>
            @else
              <span class="btn btn-outline-secondary btn-sm disabled">
                {{ __('Next') }}
              </span>
            @endif
          </div>
        </div>
      </div>
    @endif

    <!-- Back to Blog Link -->
    <div class="mt-5 pt-4 border-top">
      <a href="{{ route('blog.index') }}" 
         class="btn btn-outline-secondary">
        <i class="bx bx-left-arrow-alt me-1"></i>
        {{ __('Back to Blog') }}
      </a>
    </div>
  </div>
@endsection
