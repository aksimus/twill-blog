<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ $item->title }}</title>
    @vite('resources/css/app.css')
</head>
<body>
<x-menu/>
<div class="mx-auto max-w-2xl px-5 md:px-0">
    <div class="prose md:prose-lg lg:prose-xl prose-a:font-normal mt-16 first:mt-0">
        <h1>{{ $item->title }}</h1>
    </div>
    <div class="prose md:prose-lg lg:prose-xl prose-a:font-normal mt-8">
        {!! $item->description !!}
    </div>
    @if($item->category)
        <p class="mt-8">{{ __('Category') }}: <a href="{{ route('blog.category', $item->category->slug) }}">{{ $item->category->title }}</a></p>
    @endif
    @if($item->tags->count())
        <p class="mt-2">{{ __('Tags') }}:
            @foreach($item->tags as $tag)
                <a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->title }}</a>@if(!$loop->last), @endif
            @endforeach
        </p>
    @endif
</div>
</body>
</html>
