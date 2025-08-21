@extends('layouts.app')

@section('content')
<h1>{{ $tag->title }}</h1>
<p>{!! $tag->description !!}</p>
<ul>
@foreach($posts as $post)
    <li><a href="{{ url(LaravelLocalization::localizeURL('blog/'.$post->slug)) }}">{{ $post->title }}</a></li>
@endforeach
</ul>
@endsection
