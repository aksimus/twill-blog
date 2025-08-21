<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Blog</title>
    @vite('resources/css/app.css')
</head>
<body>
<x-menu/>
<div class="mx-auto max-w-2xl px-5 md:px-0">
    <h1 class="mt-16">{{ __('Blog') }}</h1>
    <ul class="mt-8 space-y-2">
        @foreach($posts as $post)
            <li><a href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
</div>
</body>
</html>
