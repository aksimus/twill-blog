@props(['post'])

<div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between mb-3">
  <div class="d-flex align-items-center flex-wrap text-muted mb-md-0 mb-4">
    @if($post->category)
      <div class="fs-xs border-end pe-3 me-3 mb-2">
        <span class="badge bg-faded-primary text-primary fs-base">{{ $post->category->title }}</span>
      </div>
    @endif
    <div class="fs-sm border-end pe-3 me-3 mb-2">{{ $post->created_at->diffForHumans() }}</div>
    <div class="d-flex mb-2">
      <!-- Likes -->
      <div class="d-flex align-items-center me-4">
        <i class="bx bx-heart fs-base me-1"></i>
        <span class="fs-sm">{{ $post->likes_count ?? 0 }}</span>
      </div>

      <!-- Shares -->
      <div class="d-flex align-items-center">
        <i class="bx bx-share fs-base me-1"></i>
        <span class="fs-sm">{{ $post->shares_count ?? 0 }}</span>
      </div>
    </div>
  </div>
  @if($post->author)
    <div class="d-flex align-items-center position-relative ps-md-3 pe-lg-5 mb-2">
      @if($post->author->avatar_url)
        <img src="{{ $post->author->avatar_url }}" class="rounded-circle" width="60" height="60" alt="{{ $post->author->full_name }}" style="object-fit: cover;">
      @else
        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
          <i class="bx bx-user fs-4 text-white"></i>
        </div>
      @endif
      <div class="ps-3">
        <h6 class="mb-1">Author</h6>
        <div>
          <span class="fw-semibold d-block">{{ $post->author->full_name }}</span>
          @if($post->author->job_title)
            <span class="text-muted fs-sm">{{ $post->author->job_title }}</span>
          @endif
        </div>
      </div>
    </div>
  @else
    <!-- Default author display if no author is set -->
    <div class="d-flex align-items-center position-relative ps-md-3 pe-lg-5 mb-2">
      <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
        <i class="bx bx-user fs-4 text-white"></i>
      </div>
      <div class="ps-3">
        <h6 class="mb-1">Author</h6>
        <span class="fw-semibold">Admin</span>
      </div>
    </div>
  @endif
</div> 