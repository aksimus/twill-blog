@extends('layouts.blog-layout')

@section('title', $post->title ?? 'Blog Post')

@section('seo')
{{-- SEO meta tags are now handled by the controller via SeoMetaService --}}
<x-seo-meta />
@endsection

@section('content')
  <!-- Breadcrumb -->
  <x-breadcrumb :items="[
    ['url' => route('frontend.home'), 'title' => 'Home'],
    ['url' => route('blog.index'), 'title' => 'Blog'],
    ...($post->category ? [['url' => route('blog.category', $post->category->getSlug()), 'title' => $post->category->title]] : []),
    ['url' => '#', 'title' => $post->title ?? 'Single Post']
  ]" />

  <!-- Post title + Meta  -->
  <section class="container mt-4 pt-lg-2 pb-3">
    <h1 class="pb-3" style="max-width: 970px;">{{ $post->title ?? 'This Long-Awaited Technology May Finally Change the World' }}</h1>
    <x-blog-post-meta :post="$post ?? null" />
  </section>

  @if($post->featured_image)
    <!-- Post image (parallax) -->
    <div class="jarallax mb-lg-5 mb-4" data-jarallax data-speed="0.35" style="height: 36.45vw; min-height: 300px;">
      <div class="jarallax-img" style="background-image: url({{ $post->featured_image }});"></div>
    </div>
  @endif

  <!-- Post content + Sharing -->
  <section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">
      <!-- Content -->
      <x-blog-post-content :post="$post ?? null" />

      <!-- Sharing -->
      <x-blog-post-sidebar :post="$post ?? null" />
    </div>
  </section>

  <!-- Subscription form + Sharing -->
  <section class="container mb-4 pb-2 mb-md-5 pb-lg-5">
    <div class="row gy-5">
      <!-- Subscription form + Sharing -->
      <div class="col-lg-3 position-relative">
        <div class="sticky-top ms-xl-5 ms-lg-4 ps-xxl-4" style="top: 70px !important;">
          <div class="row gy-lg-5 gy-4 justify-content-center text-lg-start text-center">
            <!-- Subscription form -->
            <div class="col-lg-12 col-sm-7 col-11">
              <h6 class="fs-lg">Enjoy this post? Join our newsletter</h6>
              <form class="needs-validation" novalidate>
                <div class="input-group mb-3">
                  <i class="bx bx-envelope position-absolute start-0 top-50 translate-middle-y zindex-5 ms-3 text-muted d-lg-inline-block d-none"></i>
                  <input type="email" placeholder="Your Email" class="form-control ps-lg-5 rounded text-lg-start text-center" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Subscribe</button>
              </form>
            </div>

            <!-- Sharing -->
            <div class="col-lg-12 col-sm-7 col-11">
              <h6 class="fs-lg">Don't forget to share it</h6>
              <div class="mb-4 pb-lg-3">
                <a href="#" class="btn btn-icon btn-secondary btn-linkedin me-2 mb-2" aria-label="LinkedIn">
                  <i class="bx bxl-linkedin"></i>
                </a>
                <a href="#" class="btn btn-icon btn-secondary btn-facebook me-2 mb-2" aria-label="Facebook">
                  <i class="bx bxl-facebook"></i>
                </a>
                <a href="#" class="btn btn-icon btn-secondary btn-twitter me-2 mb-2" aria-label="Twitter">
                  <i class="bx bxl-twitter"></i>
                </a>
                <a href="#" class="btn btn-icon btn-secondary btn-instagram me-2 mb-2" aria-label="Instagram">
                  <i class="bx bxl-instagram"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if(isset($relatedPosts) && $relatedPosts->count() > 0)
    <!-- Related articles (Slider below lg breakpoint) -->
    <section class="container mb-5 pt-md-4">
      <div class="d-flex flex-sm-row flex-column align-items-center justify-content-between mb-4 pb-1 pb-md-3">
        <h2 class="h1 mb-sm-0">Related Articles</h2>
        <a href="{{ route('blog.index') }}" class="btn btn-lg btn-outline-primary ms-4">
          All posts
          <i class="bx bx-right-arrow-alt ms-1 me-n1 lh-1 lead"></i>
        </a>
      </div>

      <div class="swiper mx-n2" data-swiper-options='{
        "slidesPerView": 1,
        "spaceBetween": 8,
        "pagination": {
          "el": ".swiper-pagination",
          "clickable": true
        },
        "breakpoints": {
          "500": {
            "slidesPerView": 2
          },
          "1000": {
            "slidesPerView": 3
          }
        }
      }'>
        <div class="swiper-wrapper">
          @foreach($relatedPosts as $relatedPost)
            <div class="swiper-slide h-auto pb-3">
              <article class="card border-0 shadow-sm h-100 mx-2">
                <div class="position-relative">
                  <a href="{{ route('blog.post', $relatedPost->getSlug()) }}" class="position-absolute top-0 start-0 w-100 h-100" aria-label="Read more"></a>
                  <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-5 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Read later" aria-label="Read later">
                    <i class="bx bx-bookmark"></i>
                  </a>
                  @if($relatedPost->featured_image)
                    <img src="{{ $relatedPost->featured_image }}" class="card-img-top" alt="{{ $relatedPost->title }}">
                  @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                      <i class="bx bx-image fs-1 text-white"></i>
                    </div>
                  @endif
                </div>
                <div class="card-body pb-4">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    @if($relatedPost->category)
                      <a href="{{ route('blog.category', $relatedPost->category->getSlug()) }}" class="badge fs-sm text-nav bg-secondary text-decoration-none">{{ $relatedPost->category->title }}</a>
                    @endif
                    <span class="fs-sm text-muted">{{ $relatedPost->created_at->format('M d, Y') }}</span>
                  </div>
                  <h3 class="h5 mb-0">
                    <a href="{{ route('blog.post', $relatedPost->getSlug()) }}">{{ $relatedPost->title }}</a>
                  </h3>
                </div>
                <div class="card-footer py-4">
                  @if($relatedPost->author)
                    <a href="#" class="d-flex align-items-center fw-bold text-dark text-decoration-none">
                      @if($relatedPost->author->avatar)
                        <img src="{{ $relatedPost->author->avatar }}" class="rounded-circle me-3" width="48" alt="{{ $relatedPost->author->name }}">
                      @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                          <i class="bx bx-user fs-4 text-white"></i>
                        </div>
                      @endif
                      {{ $relatedPost->author->name }}
                    </a>
                  @endif
                </div>
              </article>
            </div>
          @endforeach
        </div>

        <!-- Pagination (bullets) -->
        <div class="swiper-pagination position-relative pt-2 pt-sm-3 mt-4"></div>
      </div>
    </section>
  @endif
@endsection
