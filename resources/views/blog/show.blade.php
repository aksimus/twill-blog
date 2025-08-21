@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{!! $post->description !!}</p>
<p>{{ __('Category') }}: @if($post->category)<a href="{{ url(LaravelLocalization::localizeURL('blog/category/'.$post->category->slug)) }}">{{ $post->category->title }}</a>@endif</p>
<p>{{ __('Tags') }}:
@foreach($post->tags as $tag)
    <a href="{{ url(LaravelLocalization::localizeURL('blog/tag/'.$tag->slug)) }}">{{ $tag->title }}</a>@if(!$loop->last), @endif
@endforeach
</p>
@endsection
