<x-block-wrapper :block="$block">
@php
    // Extract block data using proper Twill methods
    $title = $block->translatedInput('title') ?? '';
    $youtubeId = $block->translatedInput('youtube_id') ?? '';
    $description = $block->translatedInput('description') ?? '';
    $richDescription = $block->translatedInput('rich_description') ?? '';
    $coverImage = $block->medias('cover_image')->first();
    $loadType = $block->input('load_type') ?? 'immediate';
    $aspectRatio = $block->input('aspect_ratio') ?? '16:9';
    $autoplay = $block->input('autoplay') ?? false;
    $showControls = $block->input('show_controls') ?? true;
    $responsive = $block->input('responsive') ?? true;
    
    // Build YouTube URL with parameters
    $youtubeUrl = "https://www.youtube.com/embed/{$youtubeId}";
    $youtubeWatchUrl = "https://www.youtube.com/watch?v={$youtubeId}";
    $params = [];
    
    if ($autoplay) $params[] = 'autoplay=1&mute=1';
    if (!$showControls) $params[] = 'controls=0';
    $params[] = 'rel=0'; // Don't show related videos
    
    if (!empty($params)) {
        $youtubeUrl .= '?' . implode('&', $params);
    }
    
    // Calculate aspect ratio CSS
    $aspectRatios = [
        '16:9' => '56.25%',
        '4:3' => '75%',
        '1:1' => '100%',
        '21:9' => '42.86%'
    ];
    $paddingBottom = $aspectRatios[$aspectRatio] ?? '56.25%';
    
    // Generate unique ID for this block instance
    $blockId = 'youtube-video-' . uniqid();
    
    // Determine cover image source
    $coverImageSrc = $coverImage ? asset('storage/uploads/' . $coverImage->uuid) : "https://img.youtube.com/vi/{$youtubeId}/maxresdefault.jpg";
    $coverImageAlt = $coverImage ? $coverImage->alt_text : ($title ?: 'YouTube video thumbnail');
    
    // Determine description to use
    $displayDescription = $richDescription ?: $description;
@endphp
<div class="youtube-video-block my-8" id="{{ $blockId }}">
    @if($title)
        <h2 class="h5 mb-4 pb-2 fw-medium">{{ $title }}</h2>
    @endif
    
    <div class="youtube-video-container {{ $responsive ? 'w-full' : 'max-w-4xl mx-auto' }}">
        
        @if($loadType === 'cover_modal')
            <!-- Gallery Style Video -->
            <div class="gallery mb-4 pb-2" data-video="true">
                <a href="{{ $youtubeWatchUrl }}" 
                   class="gallery-item video-item is-hovered rounded-3" 
                   data-sub-html='<h6 class="fs-sm text-light">{{ $title ?: "YouTube Video" }}</h6>{!! $displayDescription !!}'>
                    <img src="{{ $coverImageSrc }}" 
                         alt="{{ $coverImageAlt }}"
                         @if(!$coverImage) onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/0.jpg'" @endif>
                </a>
            </div>
            
        @elseif($loadType === 'gallery_style')
            <!-- Gallery Style Video (same as cover_modal but with different class) -->
            <div class="gallery mb-4 pb-2" data-video="true">
                <a href="{{ $youtubeWatchUrl }}" 
                   class="gallery-item video-item is-hovered rounded-3" 
                   data-sub-html='<h6 class="fs-sm text-light">{{ $title ?: "YouTube Video" }}</h6>{!! $displayDescription !!}'>
                    <img src="{{ $coverImageSrc }}" 
                         alt="{{ $coverImageAlt }}"
                         @if(!$coverImage) onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/0.jpg'" @endif>
                </a>
            </div>
            
        @else
            <!-- Immediate Loading -->
            @if($responsive)
                <div class="relative w-full" style="padding-bottom: {{ $paddingBottom }};">
                    <iframe 
                        src="{{ $youtubeUrl }}"
                        class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        title="{{ $title ?: 'YouTube video' }}"
                        loading="lazy">
                    </iframe>
                </div>
            @else
                <iframe 
                    src="{{ $youtubeUrl }}"
                    width="800"
                    height="{{ $aspectRatio === '16:9' ? '450' : ($aspectRatio === '4:3' ? '600' : ($aspectRatio === '1:1' ? '800' : '343')) }}"
                    class="rounded-lg shadow-lg"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    title="{{ $title ?: 'YouTube video' }}"
                    loading="lazy">
                </iframe>
            @endif
        @endif
    </div>
    
    @if($displayDescription && $loadType !== 'cover_modal' && $loadType !== 'gallery_style')
        <div class="mt-4 text-gray-600 text-sm">
            @if($richDescription)
                {!! $richDescription !!}
            @else
                {{ $description }}
            @endif
        </div>
    @endif
</div>
</x-block-wrapper>
