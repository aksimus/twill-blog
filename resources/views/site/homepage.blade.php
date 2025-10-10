@extends('layouts.blog-layout')

@section('title', __('homepage.seo.title'))

@section('seo')
{{-- SEO meta tags are now handled by the controller via SeoMetaService --}}
<x-seo-meta :seoMeta="$seoMeta ?? []" />
@endsection

@section('content')

  @include('site.homepage-promo-section')

    <div id="front-page-demo-widget" style="min-height: 450px;"></div>

    <main>
      @include('site.homepage-main-section')
      @include('site.homepage-footer-section')
    </main>

@endsection







