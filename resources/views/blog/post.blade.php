<h1>{{ $post->title }}</h1>
<p>{!! $post->description !!}</p>
@if($post->category)
    <p>Category: <a href="{{ route('blog.category', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a></p>
@endif
@if($post->tags->isNotEmpty())
    <ul>
    @foreach($post->tags as $tag)
        <li><a href="{{ route('blog.tag', ['slug' => $tag->slug]) }}">{{ $tag->title }}</a></li>
    @endforeach
    </ul>
@endif
