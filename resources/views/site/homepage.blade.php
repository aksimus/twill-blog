@extends('layouts.blog-layout')

@section('content')

  @include('site.homepage-promo-section')

    <div id="front-page-demo-widget"></div>

    <main>@include('site.homepage-main-section')</main>
    <footer>@include('site.homepage-footer-section')</footer>


@endsection







