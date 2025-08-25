@props(['post'])

<div class="col-lg-3 position-relative">
  <div class="sticky-top ms-xl-5 ms-lg-4 ps-xxl-4" style="top: 105px !important;">
    <span class="d-block mb-3">{{ $post->reading_time ?? '5 min read' }}</span>
    <h6>Share this post:</h6>
    <div class="mb-4 pb-lg-3">
      <a href="#" class="btn btn-icon btn-secondary btn-linkedin me-2 mb-2" aria-label="LinkedIn">
        <i class="bx bxl-linkedin"></i>
      </a>
      <a href="#" class="btn btn-icon btn-secondary btn-facebook me-2 mb-2" aria-label="Facebook">
        <i class="bx bxl-facebook"></i>
      </a>
      <a href="#" class="btn btn-icon btn-secondary btn-twitter me-2 mb-2" aria-label="Twitter">
        <i class="bx bxl-twitter"></i>
      </a>
      <a href="#" class="btn btn-icon btn-secondary btn-instagram me-2 mb-2" aria-label="Instagram">
        <i class="bx bxl-instagram"></i>
      </a>
    </div>
    <button type="button" class="btn btn-lg btn-outline-secondary">
      <i class="bx bx-like me-2 lead"></i>
      Like it
      <span class="badge bg-primary shadow-primary mt-n1 ms-3">{{ $post->likes_count ?? 0 }}</span>
    </button>
  </div>
</div> 