@props(['post'])

@if($post && method_exists($post, 'renderBlocks'))
    <div class="blog-blocks">
        {!! $post->renderBlocks() !!}
    </div>
@endif 