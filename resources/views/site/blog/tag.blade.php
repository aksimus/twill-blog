<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ $tag->title }}</title>
    @vite('resources/css/app.css')
</head>
<body>
<x-menu/>
<div class="mx-auto max-w-2xl px-5 md:px-0">
    <div class="prose md:prose-lg lg:prose-xl prose-a:font-normal mt-16 first:mt-0">
        <h1>{{ $tag->title }}</h1>
    </div>
    <div class="prose md:prose-lg lg:prose-xl prose-a:font-normal mt-8">
        {!! $tag->description !!}
    </div>
    <ul class="mt-8 space-y-2">
        @foreach($posts as $post)
            <li><a href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
</div>
</body>
</html>
