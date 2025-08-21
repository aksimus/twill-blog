<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<title>Blog</title>
	@vite('resources/css/app.css')
</head>
<body>
<x-menu/>
<div class="mx-auto max-w-2xl px-5 md:px-0">
	<h1 class="mt-16 text-3xl font-semibold">Blog</h1>
	<ul class="mt-6 space-y-6">
		@foreach($items as $post)
			<li>
				<a href="{{ url(app()->getLocale() !== config('translatable.fallback_locale') ? '/'.app()->getLocale().'/blog/'.$post->getSlug() : '/blog/'.$post->getSlug()) }}" class="text-blue-600 hover:underline">
					{{ $post->title }}
				</a>
				@if($post->description)
					<p class="text-gray-600">{!! \Illuminate\Support\Str::limit($post->description, 180) !!}</p>
				@endif
			</li>
		@endforeach
	</ul>
</div>
</body>
</html> 