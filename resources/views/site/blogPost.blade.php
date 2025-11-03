@php
  // Support both preview ($item) and regular ($post) contexts
  $post = $post ?? $item ?? null;
@endphp

@extends('layouts.blog-layout')

@section('title', $post->title ?? 'Blog Post')

@section('seo')
@php
    $seo = $post->seo ?? [];
@endphp
<x-seo-meta 
    :title="$post->title"
    :description="$seo['meta_description'] ?? strip_tags($post->description ?? '')"
    :keywords="$seo['meta_keywords'] ?? ''"
    type="article"
    :author="$post->author->name ?? ''"
    :publishedTime="$post->created_at?->toISOString()"
    :modifiedTime="$post->updated_at?->toISOString()"
    :image="$post->hasImage('cover') ? $post->image('cover') : null"
/>
@endsection

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="container mt-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
      @if($post->category && method_exists($post->category, 'getSlug'))
        <li class="breadcrumb-item"><a href="{{ route('blog.category', $post->category->getSlug()) }}">{{ $post->category->title }}</a></li>
      @endif
      <li class="breadcrumb-item active" aria-current="page">{{ $post->title ?? 'Single Post' }}</li>
    </ol>
  </nav>

  <!-- Post title + Meta  -->
  <section class="container mt-4 pt-lg-2 pb-3">
    <h1 class="pb-3" style="max-width: 970px;">{{ $post->title ?? 'This Long-Awaited Technology May Finally Change the World' }}</h1>
    <div class="d-flex flex-wrap align-items-center fs-sm text-muted border-bottom pb-3">
      @if($post->category && method_exists($post->category, 'getSlug'))
        <a href="{{ route('blog.category', $post->category->getSlug()) }}" class="text-decoration-none me-3">{{ $post->category->title }}</a>
      @endif
      <span class="me-3">{{ $post->created_at->format('M d, Y') }}</span>
      @if($post->author)
        <span>by {{ $post->author->name }}</span>
      @endif
    </div>
  </section>

  <!-- Post content + Sharing -->
  <section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">
      <!-- Content -->
      @php $hasHero = $post->hasImage('hero', 'post_desktop') && !$post->hide_on_post_page; @endphp
      
      @if($hasHero)
        <!-- Post hero image -->
        <div class="col-lg-9">
          <picture class="d-block mb-4 pb-2 rounded-3 overflow-hidden">
            {{-- Mobile: 5:4 ratio (post_mobile: 1.25) --}}
            <source media="(max-width: 576px)"
              srcset="
                {{ $post->image('hero','post_mobile',['w'=>375,'h'=>300,'fit'=>'crop']) }} 1x,
                {{ $post->image('hero','post_mobile',['w'=>750,'h'=>600,'fit'=>'crop']) }} 2x
              ">
            {{-- Desktop: 11:4 ratio (post_desktop: 2.75) --}}
            <img
              src="{{ $post->image('hero','post_desktop',['w'=>1320,'h'=>480,'fit'=>'crop']) }}"
              srcset="
                {{ $post->image('hero','post_desktop',['w'=>1320,'h'=>480,'fit'=>'crop']) }} 1x,
                {{ $post->image('hero','post_desktop',['w'=>2640,'h'=>960,'fit'=>'crop']) }} 2x
              "
              alt="{{ optional($post->medias('hero')->first())->alt_text ?? $post->title }}"
              class="w-100" loading="lazy" decoding="async">
          </picture>
        </div>
      @endif

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
@endsection

