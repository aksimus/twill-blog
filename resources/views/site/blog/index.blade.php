@extends('layouts.blog-layout')

@section('title', __('Blog'))

@section('seo')
{{-- SEO meta tags are now handled by the controller via SeoMetaService --}}
<x-seo-meta />
@endsection

@section('content')
  <div class="container mt-4 pt-lg-2 pb-3">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="h1 mb-4">{{ __('Blog') }}</h1>
        <p class="fs-lg text-muted mb-5">{{ __('Discover our latest articles, insights, and stories.') }}</p>
        
        <!-- Categories Widget -->
        <x-blog-categories-widget :allCategories="$allCategories" />
        
        <!-- Blog Navigation -->
        <div class="d-flex flex-wrap gap-3 mb-5 p-4 bg-light rounded-3">
          <div class="text-sm text-muted">
            <span class="fw-semibold">{{ __('Categories') }}:</span>
            <a href="{{ route('blog.index') }}" class="ms-2 text-primary text-decoration-none">
              {{ __('All') }}
            </a>
          </div>
          
          <div class="text-sm text-muted">
            <span class="fw-semibold">{{ __('Popular Tags') }}:</span>
            <a href="@localizedUrl('blog/tags')" class="ms-2 text-primary text-decoration-none">
              {{ __('View All') }}
            </a>
          </div>
        </div>

        @forelse($items as $post)
          <article class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
              <header class="mb-3">
                <h2 class="h4 mb-2">
                  <a href="{{ route('blog.post', $post->getSlug()) }}" 
                     class="text-decoration-none">
                    {{ $post->title }}
                  </a>
                </h2>
                
                <div class="d-flex align-items-center gap-3 text-sm text-muted mb-3">
                  <time datetime="{{ $post->created_at->toISOString() }}">
                    {{ $post->created_at->format('M j, Y') }}
                  </time>
                  
                  @if($post->category)
                    <span class="d-flex align-items-center gap-1">
                      <span class="text-muted">•</span>
                      <a href="{{ route('blog.category', $post->category->getSlug()) }}" 
                         class="text-primary text-decoration-none">
                        {{ $post->category->title }}
                      </a>
                    </span>
                  @endif
                </div>
              </header>

              @if($post->description)
                <div class="text-muted mb-4">
                  {!! \Illuminate\Support\Str::limit($post->description, 200) !!}
                </div>
              @endif

              @if($post->blogTags && $post->blogTags->count() > 0)
                <div class="d-flex flex-wrap gap-2 mb-4">
                  @foreach($post->blogTags as $tag)
                    <a href="{{ route('blog.tag', $tag->getSlug()) }}" 
                       class="badge bg-primary-subtle text-primary text-decoration-none">
                      {{ $tag->title }}
                    </a>
                  @endforeach
                </div>
              @endif

              <footer class="d-flex align-items-center justify-content-between">
                <a href="{{ route('blog.post', $post->getSlug()) }}" 
                   class="btn btn-outline-primary btn-sm">
                  {{ __('Read more') }}
                  <i class="bx bx-right-arrow-alt ms-1"></i>
                </a>
              </footer>
            </div>
          </article>
        @empty
          <div class="text-center py-5">
            <div class="text-muted mb-4">
              <i class="bx bx-file-blank display-4"></i>
            </div>
            <h3 class="h4 mb-2">{{ __('No posts found') }}</h3>
            <p class="text-muted">{{ __('The blog is empty. Check back soon for new content!') }}</p>
          </div>
        @endforelse

        @if($items->hasPages())
          <div class="mt-5 text-center">
            <div class="text-sm text-muted">
              {{ __('Showing') }} {{ $items->firstItem() ?? 0 }} {{ __('of') }} {{ $items->total() }} {{ __('posts') }}
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
