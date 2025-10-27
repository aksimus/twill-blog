<x-block-wrapper :block="$block">
@php
    // Get block title and description
    $title = $block->translatedInput('title') ?? '';
    $description = $block->translatedInput('description') ?? '';
    
    // Get gallery mode setting
    $enableGallery = $block->input('enable_gallery') ?? false;
    
    // Get image media
    $image = $block->medias('highlight')->first();
    $imageUrl = $image ? $block->image('highlight', 'desktop') : null;
    
    // Get metadata from pivot
    $metadata = $image && $image->pivot && $image->pivot->metadatas ? json_decode($image->pivot->metadatas, true) : [];
    $currentLocale = app()->getLocale();
    
    // Get alt_text from metadata with fallback to direct property
    $imageAlt = '';
    if (!empty($metadata['altText'][$currentLocale])) {
        $imageAlt = $metadata['altText'][$currentLocale];
    } elseif (!empty($metadata['altText']['en'])) {
        $imageAlt = $metadata['altText']['en'];
    } elseif ($image && $image->alt_text) {
        $imageAlt = $image->alt_text;
    } else {
        $imageAlt = 'Image';
    }
    
    // Get caption from metadata with fallback
    $imageCaption = '';
    if (!empty($metadata['caption'][$currentLocale])) {
        $imageCaption = $metadata['caption'][$currentLocale];
    } elseif (!empty($metadata['caption']['en'])) {
        $imageCaption = $metadata['caption']['en'];
    } elseif ($image && $image->caption) {
        $imageCaption = $image->caption;
    } elseif ($imageAlt && $imageAlt !== 'Image') {
        $imageCaption = $imageAlt;
    }
@endphp

<div class="image-block my-8">
    @if($title)
        <h2 class="mb-3">{{ $title }}</h2>
    @endif
    
    @if($description)
        <div class="mb-3">{!! $description !!}</div>
    @endif
    
    @if($imageUrl)
        @if($enableGallery)
        <!-- Gallery mode with lightbox -->
        <div class="gallery">
            <a href="{{ $imageUrl }}" class="gallery-item is-hovered rounded-3" data-sub-html='<h6 class="fs-sm text-light">{{ $imageCaption ?: "Image" }}</h6>'>
                <img class="block max-w-full" src="{{ $imageUrl }}" alt="{{ $imageAlt }}"/>
                @if($imageCaption)
                <div class="gallery-item-caption p-4">
                    <h4 class="text-light mb-1">{{ $imageCaption }}</h4>
                </div>
                @endif
            </a>
        </div>
        @else
        <!-- Static image without lightbox -->
        <div class="image-static {{ $imageCaption ? 'has-caption' : '' }}">
            <img class="block max-w-full rounded-3" src="{{ $imageUrl }}" alt="{{ $imageAlt }}"/>
            @if($imageCaption)
            <div class="image-caption mt-3 text-center text-muted">
                {{ $imageCaption }}
            </div>
            @endif
        </div>
        @endif
    @endif
</div>
</x-block-wrapper>
