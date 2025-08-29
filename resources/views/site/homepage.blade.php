@extends('layouts.blog-layout')

@section('title', __('homepage.seo.title'))

@section('seo')
{{-- SEO meta tags are now handled by the controller via SeoMetaService --}}
<x-seo-meta :seoMeta="$seoMeta ?? []" />
@endsection

@section('content')

  @include('site.homepage-promo-section')

    <div id="front-page-demo-widget"></div>

    <main>@include('site.homepage-main-section')</main>
    <footer>@include('site.homepage-footer-section')</footer>


@endsection







