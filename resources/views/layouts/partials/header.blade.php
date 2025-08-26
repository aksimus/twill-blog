<header class="header navbar navbar-expand-lg bg-light navbar-sticky">
  <div class="container px-3">
    <a href="{{ route('frontend.home') }}" class="navbar-brand pe-3">
      <img src="/assets/img/logo.png" width="200" alt="Logo">
    </a>
    <div id="navbarNav" class="offcanvas offcanvas-end">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        @include('layouts.partials.nav')
      </div>
      <div class="offcanvas-header border-top">
        <a href="https://themes.getbootstrap.com/product/silicon-business-technology-template-ui-kit/" class="btn btn-primary w-100" target="_blank" rel="noopener">
          <i class="bx bx-cart fs-4 lh-1 me-1"></i>
          &nbsp;Buy now
        </a>
      </div>      
    </div>
    <div class="language-switcher-header pe-lg-1 ms-auto me-4">
      <x-language-switcher />
    </div>
    <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href="https://themes.getbootstrap.com/product/silicon-business-technology-template-ui-kit/" class="btn btn-primary btn-sm fs-sm rounded d-none d-lg-inline-flex" target="_blank" rel="noopener">
      <i class="bx bx-cart fs-5 lh-1 me-1"></i>
      &nbsp;Buy now
    </a>
  </div>
</header> 