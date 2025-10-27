<x-block-wrapper :block="$block">
@php
    // Get block title and description
    $title = $block->translatedInput('title') ?? '';
    $description = $block->translatedInput('description') ?? '';
    
    $quote = $block->translatedInput('quote') ?? '';
    $authorName = $block->translatedInput('author_name') ?? '';
    $authorTitle = $block->translatedInput('author_title') ?? '';
    
    // Get avatar URL
    $avatar = $block->medias('avatar')->first();
    $avatarSrc = $avatar ? $block->image('avatar', 'default') : null;
@endphp

@if($quote)
<div class="opinion-block mb-4">
    @if($title)
        <h2 class="mb-3">{{ $title }}</h2>
    @endif
    
    @if($description)
        <div class="mb-3">{!! $description !!}</div>
    @endif
    
    <figure class="position-relative ps-4">
    <span class="position-absolute top-0 start-0 w-3 h-100 bg-primary"></span>
    <blockquote class="blockquote fs-xl fw-medium text-dark ps-1 ps-sm-3">
        <p>{!! $quote !!}</p>
    </blockquote>
    @if($authorName || $authorTitle)
    <figcaption class="d-flex align-items-center pt-3 ps-1 ps-sm-3">
        <div class="flex-shrink-0">
            @if($avatarSrc)
                <img src="{{ $avatarSrc }}" width="48" height="48" class="rounded-circle" alt="{{ $authorName }}" style="object-fit: cover; display: block;">
            @else
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; min-width: 48px; background-color: #e9ecef; color: #6c757d;">
                    <span style="font-size: 18px; font-weight: 600;">{{ strtoupper(substr($authorName ?? '?', 0, 1)) }}</span>
                </div>
            @endif
        </div>
        <div class="ps-3">
            @if($authorName)
                <h6 class="fw-semibold lh-base mb-0">{{ $authorName }}</h6>
            @endif
            @if($authorTitle)
                <span class="fs-sm text-muted">{{ $authorTitle }}</span>
            @endif
        </div>
    </figcaption>
    @endif
    </figure>
</div>
@endif
</x-block-wrapper>

