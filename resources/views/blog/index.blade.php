@extends('layouts.app')

@section('content')
<h1>{{ __('Blog') }}</h1>
<ul>
@foreach($posts as $post)
    <li><a href="{{ url(LaravelLocalization::localizeURL('blog/'.$post->slug)) }}">{{ $post->title }}</a></li>
@endforeach
</ul>
@endsection
