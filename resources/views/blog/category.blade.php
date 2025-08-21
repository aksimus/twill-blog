<h1>{{ $category->title }}</h1>
<p>{!! $category->description !!}</p>
<ul>
@foreach($posts as $post)
    <li><a href="{{ route('blog.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a></li>
@endforeach
</ul>
