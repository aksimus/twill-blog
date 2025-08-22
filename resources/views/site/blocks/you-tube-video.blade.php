@php
    // Extract block data using proper Twill methods
    $title = $block->translatedInput('title') ?? '';
    $youtubeId = $block->input('youtube_id') ?? '';
    $description = $block->translatedInput('description') ?? '';
    $loadType = $block->input('load_type') ?? 'immediate';
    $aspectRatio = $block->input('aspect_ratio') ?? '16:9';
    $autoplay = $block->input('autoplay') ?? false;
    $showControls = $block->input('show_controls') ?? true;
    $showInfo = $block->input('show_info') ?? true;
    $responsive = $block->input('responsive') ?? true;
    
    // Build YouTube URL with parameters
    $youtubeUrl = "https://www.youtube.com/embed/{$youtubeId}";
    $params = [];
    
    if ($autoplay) $params[] = 'autoplay=1&mute=1';
    if (!$showControls) $params[] = 'controls=0';
    if (!$showInfo) $params[] = 'showinfo=0';
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
@endphp

<div class="youtube-video-block my-8" id="{{ $blockId }}">
    @if($title)
        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ $title }}</h3>
    @endif
    
    <div class="youtube-video-container {{ $responsive ? 'w-full' : 'max-w-4xl mx-auto' }}">
        
        @if($loadType === 'cover_modal')
            <!-- Cover Image with Play Button -->
            <div class="relative w-full cursor-pointer" style="padding-bottom: {{ $paddingBottom }};" 
                 onclick="openYouTubeModal('{{ $blockId }}-modal', '{{ $youtubeUrl }}')">
                
                <!-- YouTube Thumbnail -->
                <img src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg" 
                     alt="{{ $title ?: 'YouTube video thumbnail' }}"
                     class="absolute top-0 left-0 w-full h-full object-cover rounded-lg shadow-lg"
                     onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/0.jpg'">
                
                <!-- Play Button Overlay -->
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 hover:bg-opacity-40 transition-all duration-200 rounded-lg">
                    <div class="bg-red-600 hover:bg-red-700 text-white rounded-full p-4 shadow-lg transform hover:scale-110 transition-transform duration-200">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <!-- Click to Play Text -->
                <div class="absolute bottom-4 left-4 text-white text-sm font-medium bg-black bg-opacity-50 px-2 py-1 rounded">
                    Click to play
                </div>
            </div>
            
            <!-- Modal -->
            <div id="{{ $blockId }}-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75">
                <div class="absolute inset-0" onclick="closeYouTubeModal('{{ $blockId }}-modal')"></div>
                <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
                    <div class="relative w-full max-w-4xl">
                        <!-- Close Button -->
                        <button onclick="closeYouTubeModal('{{ $blockId }}-modal')" 
                                class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        <!-- Video Container -->
                        <div class="relative w-full" style="padding-bottom: {{ $paddingBottom }};">
                            <iframe 
                                src=""
                                class="absolute top-0 left-0 w-full h-full rounded-lg"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                title="{{ $title ?: 'YouTube video' }}">
                            </iframe>
                        </div>
                    </div>
                </div>
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
    
    @if($description)
        <div class="mt-4 text-gray-600 text-sm">
            {{ $description }}
        </div>
    @endif
</div>

<!-- Global JavaScript for YouTube Modal functionality -->
<script>
// Check if functions already exist to avoid redefinition
if (typeof window.openYouTubeModal === 'undefined') {
    window.openYouTubeModal = function(modalId, videoUrl) {
        console.log('Opening modal:', modalId, 'with URL:', videoUrl);
        const modal = document.getElementById(modalId);
        const iframe = modal.querySelector('iframe');
        
        if (modal && iframe) {
            // Set the video URL
            iframe.src = videoUrl;
            
            // Show modal - use multiple approaches to ensure visibility
            modal.classList.remove('hidden');
            modal.style.display = 'block';
            modal.style.visibility = 'visible';
            modal.style.opacity = '1';
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            console.log('Modal opened successfully');
            console.log('Modal classes:', modal.className);
            console.log('Modal display:', modal.style.display);
            console.log('Modal visibility:', modal.style.visibility);
        } else {
            console.error('Modal or iframe not found:', modalId);
        }
    };
}

if (typeof window.closeYouTubeModal === 'undefined') {
    window.closeYouTubeModal = function(modalId) {
        console.log('Closing modal:', modalId);
        const modal = document.getElementById(modalId);
        const iframe = modal.querySelector('iframe');
        
        if (modal && iframe) {
            // Hide modal - use multiple approaches
            modal.classList.add('hidden');
            modal.style.display = 'none';
            modal.style.visibility = 'hidden';
            modal.style.opacity = '0';
            
            // Restore body scroll
            document.body.style.overflow = '';
            
            // Stop video by removing src
            iframe.src = '';
            
            console.log('Modal closed successfully');
        } else {
            console.error('Modal or iframe not found:', modalId);
        }
    };
}
</script>