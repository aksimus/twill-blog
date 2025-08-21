<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>{{ $category->title }}</title>
	@vite('resources/css/app.css')
</head>
<body>
<x-menu/>
<div class="mx-auto max-w-2xl px-5 md:px-0">
	<h1 class="mt-16 text-3xl font-semibold">{{ $category->title }}</h1>
	@if($category->description)
		<div class="prose mt-4">{!! $category->description !!}</div>
	@endif
	<ul class="mt-6 space-y-6">
		@foreach($items as $post)
			<li>
				<a href="{{ url(app()->getLocale() !== config('translatable.fallback_locale') ? '/'.app()->getLocale().'/blog/'.$post->getSlug() : '/blog/'.$post->getSlug()) }}" class="text-blue-600 hover:underline">
					{{ $post->title }}
				</a>
			</li>
		@endforeach
	</ul>
</div>
</body>
</html>