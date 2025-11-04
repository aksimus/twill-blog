@extends('layouts.blog-layout')

@section('title', __('Blog'))

@section('seo')
<x-seo-meta />
@endsection

@push('styles')
<style>
.category-card {
  transition: all 0.3s ease;
}
.category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}
.category-card:hover .text-primary {
  color: #6366f1 !important;
}
.tag-cloud-item {
  transition: all 0.3s ease;
}
.tag-cloud-item:hover {
  transform: scale(1.05);
  box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
}
</style>
@endpush

@section('content')
  <!-- Breadcrumb -->
  <nav class="container mt-lg-4 pt-5" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 pt-5">
      <li class="breadcrumb-item">
        <a href="{{ route('frontend.home') }}"><i class="bx bx-home-alt fs-lg me-1"></i>{{ __('Home') }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ __('Blog') }}</li>
    </ol>
  </nav>

  <!-- Page content -->
  <section class="container mt-4 mb-lg-5 pt-lg-2 pb-5">

    <!-- Page title + Search/Filter -->
    <div class="row align-items-end gy-3 mb-4 pb-lg-3 pb-1">
      <div class="col-lg-5 col-md-4">
        <h1 class="mb-2 mb-md-0">{{ __('Blog') }}</h1>
        <p class="text-muted mb-0">{{ __('Discover our latest articles, insights, and stories') }}</p>
      </div>
      <div class="col-lg-7 col-md-8">
        <div class="d-flex justify-content-end">
          <div class="nav flex-nowrap me-sm-4 me-3">
            <a href="{{ route('blog.index') }}" class="nav-link me-2 p-0 active" aria-label="List view">
              <i class="bx bx-list-ul fs-4"></i>
            </a>
          </div>
          <div class="input-group" style="max-width: 300px;">
            <input type="text" class="form-control pe-5 rounded" placeholder="{{ __('Search the blog...') }}">
            <i class="bx bx-search position-absolute top-50 end-0 translate-middle-y me-3 zindex-5 fs-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Categories Section -->
    @if($allCategories && $allCategories->count() > 0)
      <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-4">
          <h2 class="h5 mb-4">
            <i class="bx bx-category-alt me-2 text-primary"></i>
            {{ __('Browse by Category') }}
          </h2>
          <div class="row g-3">
            @foreach($allCategories as $category)
              <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="{{ route('blog.category', $category->getSlug()) }}" class="card border-0 bg-secondary text-decoration-none h-100 category-card">
                  @php $hasHero = $category->hasImage('hero', 'list_desktop'); @endphp
                  @if($hasHero)
                    <div class="card-img-top position-relative" style="height: 150px; overflow: hidden;">
                      <img
                        src="{{ $category->image('hero','list_desktop',['w'=>300,'h'=>150,'fit'=>'crop']) }}"
                        srcset="
                          {{ $category->image('hero','list_desktop',['w'=>300,'h'=>150,'fit'=>'crop']) }} 1x,
                          {{ $category->image('hero','list_desktop',['w'=>600,'h'=>300,'fit'=>'crop']) }} 2x
                        "
                        alt="{{ optional($category->medias('hero')->first())->alt_text ?? $category->title }}"
                        width="300" height="150"
                        class="w-100 h-100" style="object-fit:cover" loading="lazy" decoding="async">
                    </div>
                  @endif
                  <div class="card-body p-3 text-center">
                    @if(!$hasHero)
                      <i class="bx bx-folder fs-2 text-primary mb-2"></i>
                    @endif
                    <h6 class="mb-1">{{ $category->title }}</h6>
                    <small class="text-muted">{{ $category->posts_count ?? 0 }} {{ __('posts') }}</small>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif

    @forelse($items as $post)
      <!-- Item -->
      <article class="card border-0 shadow-sm overflow-hidden mb-4">
        <div class="row g-0">
          <div class="col-sm-4 position-relative" style="min-height: 15rem;">
            @php $hasHero = $post->hasImage('hero', 'cat_desktop'); @endphp

            @if($hasHero)
              <picture>
                {{-- Mobile: 3:2 ratio (cat_mobile: 1.46) --}}
                <source media="(max-width: 576px)"
                  srcset="
                    {{ $post->image('hero','cat_mobile',['w'=>351,'h'=>240,'fit'=>'crop']) }} 1x,
                    {{ $post->image('hero','cat_mobile',['w'=>702,'h'=>480,'fit'=>'crop']) }} 2x
                  ">
                {{-- Desktop: 3:2 ratio (cat_desktop: 1.51) --}}
                <img
                  src="{{ $post->image('hero','cat_desktop',['w'=>432,'h'=>286,'fit'=>'crop']) }}"
                  srcset="
                    {{ $post->image('hero','cat_desktop',['w'=>432,'h'=>286,'fit'=>'crop']) }} 1x,
                    {{ $post->image('hero','cat_desktop',['w'=>864,'h'=>572,'fit'=>'crop']) }} 2x
                  "
                  alt="{{ optional($post->medias('hero')->first())->alt_text ?? $post->title }}"
                  width="432" height="286"
                  class="w-100 h-100" style="object-fit:cover" loading="lazy" decoding="async">
              </picture>
            @else
              <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="bx bx-image text-white" style="font-size: 3rem; opacity: 0.5;"></i>
              </div>
            @endif
            <a href="{{ route('blog.post', $post->getSlug()) }}" class="position-absolute top-0 start-0 w-100 h-100" aria-label="Read more"></a>
            <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-5 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Read later" aria-label="Read later">
              <i class="bx bx-bookmark"></i>
            </a>
          </div>
          <div class="col-sm-8">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                @if($post->category)
                  <a href="{{ route('blog.category', $post->category->getSlug()) }}" class="badge fs-sm text-nav bg-secondary text-decoration-none">{{ $post->category->title }}</a>
                @else
                  <span class="badge fs-sm text-nav bg-secondary">{{ __('Uncategorized') }}</span>
                @endif
                <span class="fs-sm text-muted border-start ps-3 ms-3">{{ $post->created_at->format('M j, Y') }}</span>
              </div>
              <h3 class="h4">
                <a href="{{ route('blog.post', $post->getSlug()) }}">{{ $post->title }}</a>
              </h3>
              <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->description), 150) }}</p>
              <hr class="my-4">
              <div class="d-flex align-items-center justify-content-between">
                @if($post->author)
                  <div class="d-flex align-items-center me-3">
                    @if($post->author->avatar_url)
                      <img src="{{ $post->author->avatar_url }}" class="rounded-circle me-3" width="48" height="48" alt="{{ $post->author->full_name }}" style="object-fit: cover;">
                    @else
                      <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                        <i class="bx bx-user text-white"></i>
                      </div>
                    @endif
                    <div>
                      <div class="fw-bold text-dark">{{ $post->author->full_name }}</div>
                      @if($post->author->job_title)
                        <div class="text-muted fs-sm">{{ $post->author->job_title }}</div>
                      @endif
                    </div>
                  </div>
                @else
                  <div class="d-flex align-items-center fw-bold text-dark me-3">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                      <i class="bx bx-user text-white"></i>
                    </div>
                    {{ __('Admin') }}
                  </div>
                @endif
                <div class="d-flex align-items-center text-muted">
                  @if($post->blogTags && $post->blogTags->count() > 0)
                    <div class="d-flex align-items-center me-3">
                      <i class="bx bx-purchase-tag fs-lg me-1"></i>
                      <span class="fs-sm">{{ $post->blogTags->count() }}</span>
                    </div>
                  @endif
                  <div class="d-flex align-items-center me-3">
                    <i class="bx bx-like fs-lg me-1"></i>
                    <span class="fs-sm">{{ $post->likes_count ?? rand(5, 25) }}</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <i class="bx bx-share-alt fs-lg me-1"></i>
                    <span class="fs-sm">{{ $post->shares_count ?? rand(2, 10) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

    <!-- Pagination -->
    @if($items->hasPages())
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center pt-lg-3 pt-1">
          <li class="page-item{{ $items->onFirstPage() ? ' disabled' : '' }}">
            @if($items->onFirstPage())
              <span class="page-link" aria-label="Previous page">
                <i class="bx bx-chevron-left mx-n1"></i>
              </span>
            @else
              <a href="{{ $items->previousPageUrl() }}" class="page-link" aria-label="Previous page">
                <i class="bx bx-chevron-left mx-n1"></i>
              </a>
            @endif
          </li>
          <li class="page-item disabled d-sm-none">
            <span class="page-link text-body">{{ $items->currentPage() }} / {{ $items->lastPage() }}</span>
          </li>
          
          @foreach ($items->getUrlRange(max(1, $items->currentPage() - 2), min($items->lastPage(), $items->currentPage() + 2)) as $page => $url)
            <li class="page-item d-none d-sm-block{{ $page == $items->currentPage() ? ' active' : '' }}" {{ $page == $items->currentPage() ? 'aria-current="page"' : '' }}>
              @if($page == $items->currentPage())
                <span class="page-link">
                  {{ $page }}
                  <span class="visually-hidden">(current)</span>
                </span>
              @else
                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
              @endif
            </li>
          @endforeach
          
          <li class="page-item{{ !$items->hasMorePages() ? ' disabled' : '' }}">
            @if($items->hasMorePages())
              <a href="{{ $items->nextPageUrl() }}" class="page-link" aria-label="Next page">
                <i class="bx bx-chevron-right mx-n1"></i>
              </a>
            @else
              <span class="page-link" aria-label="Next page">
                <i class="bx bx-chevron-right mx-n1"></i>
              </span>
            @endif
          </li>
        </ul>
      </nav>
    @endif
  </section>

  <!-- Popular Tags Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
          <div class="text-center mb-5">
            <h2 class="h3 mb-2">
              <i class="bx bx-purchase-tag me-2 text-primary"></i>
              {{ __('Popular Tags') }}
            </h2>
            <p class="text-muted mb-0">{{ __('Discover content by topics that interest you') }}</p>
          </div>
          
          <div class="d-flex flex-wrap justify-content-center gap-3">
            @php
              // Get tags from posts and count their usage
              $tagCounts = [];
              foreach($items as $post) {
                if($post->blogTags) {
                  foreach($post->blogTags as $tag) {
                    $tagCounts[$tag->id] = [
                      'tag' => $tag,
                      'count' => ($tagCounts[$tag->id]['count'] ?? 0) + 1
                    ];
                  }
                }
              }
              // Sort by count and take top 10
              $popularTags = collect($tagCounts)->sortByDesc('count')->take(10);
            @endphp
            
            @forelse($popularTags as $tagData)
              @php $tag = $tagData['tag']; $count = $tagData['count']; @endphp
              <a href="{{ route('blog.tag', $tag->getSlug()) }}" class="btn btn-outline-primary btn-lg rounded-pill tag-cloud-item">
                {{ $tag->title }}
                <span class="badge bg-primary text-white ms-2">{{ $count }}</span>
              </a>
            @empty
              <p class="text-muted">{{ __('No tags available yet.') }}</p>
            @endforelse
            
            @if($popularTags->count() > 0)
              <div class="w-100 text-center mt-4">
                <a href="{{ route('blog.tags') }}" class="btn btn-primary">
                  <i class="bx bx-collection me-1"></i>
                  {{ __('View All Tags') }}
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Subscription CTA -->
  <section class="py-5 bg-secondary">
    <div class="container py-md-3 py-lg-5">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-11">
          <h2 class="h1 d-md-inline-block position-relative mb-md-5 mb-sm-4 text-sm-start text-center">
            {{ __('Don\'t Want to Miss Anything?') }}

            <!-- Arrow shape -->
            <svg class="d-md-block d-none position-absolute top-0 ms-4 ps-1" style="left: 100%;" xmlns="http://www.w3.org/2000/svg" width="65" height="68" fill="#6366f1"><path d="M53.9527 51.0012c8.396-10.5668 2.0302-26.0134-11.7481-26.7511-.6899-.0646-1.4612.0015-2.1258.0431.1243 9.0462-4.1714 18.8896-11.5618 21.3814-6.6695 2.2133-10.3337-4.2224-7.5813-9.676 3.2966-6.4755 9.103-11.8504 16.1678-13.8189-.5654-5.6953-3.3436-10.7672-9.485-12.48517C17.2678 6.8204 6.49364 16.3681 4.98841 26.127c-.09276 1.0297-1.68569.9497-1.59293-.0801C3.98732 12.9139 19.7395 2.55212 31.9628 8.5787c4.7253 2.3813 7.2649 7.3963 7.9368 13.067 7.4237-.9311 14.5154 3.3683 18.3422 9.5422 4.3988 7.1623 2.3584 15.1401-2.6322 21.1108-.7826.9653-2.3331-.3572-1.6569-1.2975zM26.7754 32.1845c-1.9411 2.2411-4.076 5.0872-4.3542 8.1764-.3036 2.9829 3.7601 3.0525 5.4905 2.7645 2.1568-.3863 3.7221-2.3164 4.8863-4.0419 2.6228-3.6308 4.3657-9.0752 4.4844-14.2563-4.0808 1.279-7.6514 4.2327-10.507 7.3573zm24.6311 25.592c-.7061-2.9738-1.2243-6.1031-1.1591-9.143.0423-1.242 1.767-1.0805 1.8313.1372.1284 2.435.815 4.8532 1.4764 7.1651l4.1619-1.4098c1.0153-.4586 2.4373-1.5714 3.6544-1.1804.6087.1954.7347.7264.6475 1.3068-.2302 1.3976-2.4683 1.9147-3.5901 2.398-1.8429.7619-3.6293 1.2865-5.5477 1.7298-.6391.1476-1.3233-.3665-1.4746-1.0037z"/></svg>
          </h2>

          <!-- Email field -->
          <form class="d-flex flex-sm-row flex-column mb-3 needs-validation" novalidate>
            <div class="input-group me-sm-3 mb-sm-0 mb-3">
              <input type="email" class="form-control form-control-lg rounded-3 ps-5" placeholder="{{ __('Your email') }}" required>
              <i class="bx bx-envelope position-absolute start-0 top-50 translate-middle-y ms-3 zindex-5 fs-5 text-muted"></i>
              <div class="invalid-tooltip position-absolute start-0 top-0 mt-n4">{{ __('Please provide a valid email address!') }}</div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary">{{ __('Subscribe') }} *</button>
          </form>
          <div class="form-text fs-sm text-sm-start text-center">
            * {{ __('Yes, I agree to the terms and privacy policy.') }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
