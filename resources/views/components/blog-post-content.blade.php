@props(['post'])

@php
  // Get content with table of contents
  $content = $post->getContentWithToc();
  $toc = $content['toc'] ?? [];
  $html = $content['html'] ?? '';
@endphp

<div class="col-lg-9">
  @if($post->show_toc && !empty($toc))
    <x-table-of-contents :items="$toc" />
  @endif
  
  @if(!empty($html))
    <div class="blog-content">
      {!! $html !!}
    </div>
  @endif

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