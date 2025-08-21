<h1>Blog</h1>
<ul>
@foreach($posts as $post)
    <li><a href="{{ route('blog.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a></li>
@endforeach
</ul>
