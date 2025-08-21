<h1>{{ $tag->title }}</h1>
<p>{!! $tag->description !!}</p>
<ul>
@foreach($posts as $post)
    <li><a href="{{ route('blog.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a></li>
@endforeach
</ul>
