@props(['post'])

<div class="col-lg-9">
  @if($post->description && !$post->hide_description_on_post_page)
    <h3 class="h5 mb-4 pb-2 fw-medium">{{ $post->description }}</h3>
  @endif
  
  @if($post->content)
    <div class="blog-content">
      {!! $post->content !!}
    </div>
  @endif






  <!-- Render Twill blocks -->
  <x-twill-blocks :post="$post" />




  <!-- Author information -->
  @if($post->author)
    <x-blog-author-card :author="$post->author" />
  @endif

  @if($post->blogTags && $post->blogTags->count() > 0)
    <!-- Tags -->
    <hr class="mb-4">
    <div class="d-flex flex-sm-row flex-column pt-2">
      <h6 class="mt-sm-1 mb-sm-2 mb-3 me-2 text-nowrap">Related Tags:</h6>
      <div>
        @foreach($post->blogTags as $tag)
          <a href="{{ route('blog.tag', $tag->getSlug()) }}" class="btn btn-sm btn-outline-secondary me-2 mb-2">#{{ $tag->title }}</a>
        @endforeach
      </div>
    </div>
  @endif
</div> 