@props(['author'])

@if($author)
<div class="blog-author-card border rounded-lg p-4 bg-light mb-4">
    <div class="d-flex align-items-center">
        <div class="me-3">
            @if($author->avatar)
                <img src="{{ $author->getAvatarUrlAttribute() }}" 
                     class="rounded-circle" 
                     width="64" 
                     height="64" 
                     alt="{{ $author->full_name }}">
            @else
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                     style="width: 64px; height: 64px;">
                    <i class="bx bx-user fs-3 text-white"></i>
                </div>
            @endif
        </div>
        
        <div class="flex-grow-1">
            <h5 class="mb-1">{{ $author->full_name }}</h5>
            @if($author->job_title)
                <p class="text-muted mb-2">{{ $author->job_title }}</p>
            @endif
            @if($author->bio)
                <p class="mb-2">{{ Str::limit($author->bio, 150) }}</p>
            @endif
            
            <div class="d-flex gap-2">
                @if($author->website)
                    <a href="{{ $author->website }}" 
                       class="btn btn-sm btn-outline-primary" 
                       target="_blank" 
                       rel="noopener">
                        <i class="bx bx-globe me-1"></i>Website
                    </a>
                @endif
                
                @if($author->twitter)
                    <a href="https://twitter.com/{{ $author->twitter }}" 
                       class="btn btn-sm btn-outline-info" 
                       target="_blank" 
                       rel="noopener">
                        <i class="bx bxl-twitter me-1"></i>Twitter
                    </a>
                @endif
                
                @if($author->linkedin)
                    <a href="https://linkedin.com/in/{{ $author->linkedin }}" 
                       class="btn btn-sm btn-outline-primary" 
                       target="_blank" 
                       rel="noopener">
                        <i class="bx bxl-linkedin me-1"></i>LinkedIn
                    </a>
                @endif
                
                @if($author->github)
                    <a href="https://github.com/{{ $author->github }}" 
                       class="btn btn-sm btn-outline-dark" 
                       target="_blank" 
                       rel="noopener">
                        <i class="bx bxl-github me-1"></i>GitHub
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif 