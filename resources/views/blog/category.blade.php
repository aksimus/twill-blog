@extends('layouts.app')

@section('content')
<h1>{{ $category->title }}</h1>
<p>{!! $category->description !!}</p>
<ul>
@foreach($posts as $post)
    <li><a href="{{ url(LaravelLocalization::localizeURL('blog/'.$post->slug)) }}">{{ $post->title }}</a></li>
@endforeach
</ul>
@endsection
