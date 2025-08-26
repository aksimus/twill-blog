@extends('layouts.blog-layout')

@section('title', __('Tags'))

@section('meta')
<meta name="description" content="{{ __('Browse all blog tags and discover content by topic.') }}">
@endsection

@section('content')
  <div class="container mt-4 pt-lg-2 pb-3">
    <div class="mb-4">
      <nav class="text-sm text-muted mb-4">
        <a href="@localizedUrl('blog')" class="text-decoration-none">
          {{ __('Blog') }}
        </a>
        <span class="mx-2">→</span>
        <span class="text-dark">{{ __('Tags') }}</span>
      </nav>
      
      <h1 class="h1 mb-3">{{ __('Tags') }}</h1>
      <p class="fs-lg text-muted">{{ __('Browse all blog tags and discover content by topic.') }}</p>
    </div>

    @if($allTags && $allTags->count() > 0)
      <div class="row g-4">
        @foreach($allTags as $tag)
          <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <h2 class="h5 mb-0">
                    <a href="@localizedUrl('blog/tag/' . $tag->getSlug())" 
                       class="text-decoration-none">
                      {{ $tag->title }}
                    </a>
                  </h2>
                  <span class="badge bg-primary-subtle text-primary">
                    {{ $tag->posts_count }} {{ __('posts') }}
                  </span>
                </div>
                
                @if($tag->description)
                  <p class="text-muted mb-4">
                    {{ \Illuminate\Support\Str::limit($tag->description, 120) }}
                  </p>
                @endif
                
                <div class="mt-auto">
                  <a href="@localizedUrl('blog/tag/' . $tag->getSlug())" 
                     class="btn btn-outline-primary btn-sm">
                    {{ __('View Posts') }}
                    <i class="bx bx-right-arrow-alt ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <div class="mt-5 text-center">
        <a href="@localizedUrl('blog')" 
           class="btn btn-primary">
          {{ __('Back to Blog') }}
        </a>
      </div>
    @else
      <div class="text-center py-5">
        <div class="text-muted mb-4">
          <i class="bx bx-purchase-tag display-4"></i>
        </div>
        <h3 class="h4 mb-2">{{ __('No Tags Found') }}</h3>
        <p class="text-muted mb-4">{{ __('No tags have been created yet.') }}</p>
        <a href="@localizedUrl('blog')" 
           class="btn btn-primary">
          {{ __('Back to Blog') }}
        </a>
      </div>
    @endif
  </div>
@endsection
