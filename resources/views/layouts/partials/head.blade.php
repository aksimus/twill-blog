<meta charset="utf-8">
<title>@yield('title', 'Silicon | Blog')</title>

<!-- SEO Meta Tags -->
@yield('meta')
<meta name="keywords" content="bootstrap, business, creative agency, mobile app showcase, saas, fintech, finance, online courses, software, medical, conference landing, services, e-commerce, shopping cart, multipurpose, shop, ui kit, marketing, seo, landing, blog, portfolio, html5, css3, javascript, gallery, slider, touch, creative">
<meta name="author" content="Createx Studio">

<!-- Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Theme switcher (color modes) -->
<script src="/assets/js/theme-switcher.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{config('services.google_maps.api_key')}}&language=en"></script>
<!-- Favicon and Touch Icons -->
<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
<link rel="manifest" href="/assets/favicon/site.webmanifest">
<link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#6366f1">
<link rel="shortcut icon" href="/assets/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#080032">
<meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<!-- Vendor Styles -->
<link rel="stylesheet" media="screen" href="/assets/vendor/boxicons/css/boxicons.min.css">
<link rel="stylesheet" media="screen" href="/assets/vendor/lightgallery/css/lightgallery-bundle.min.css">
<link rel="stylesheet" media="screen" href="/assets/vendor/swiper/swiper-bundle.min.css">

<!-- Main Theme Styles + Bootstrap -->
<link rel="stylesheet" media="screen" href="/assets/css/theme.min.css">

<!-- Page loading styles -->
<style>
  .page-loading {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    -webkit-transition: all .4s .2s ease-in-out;
    transition: all .4s .2s ease-in-out;
    background-color: #fff;
    opacity: 0;
    visibility: hidden;
    z-index: 9999;
  }
  [data-bs-theme="dark"] .page-loading {
    background-color: #0b0f19;
  }
  .page-loading.active {
    opacity: 1;
    visibility: visible;
  }
  .page-loading-inner {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    text-align: center;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -webkit-transition: opacity .2s ease-in-out;
    transition: opacity .2s ease-in-out;
    opacity: 0;
  }
  .page-loading.active > .page-loading-inner {
    opacity: 1;
  }
  .page-loading-inner > span {
    display: block;
    font-size: 1rem;
    font-weight: normal;
    color: #9397ad;
  }
  [data-bs-theme="dark"] .page-loading-inner > span {
    color: #fff;
    opacity: .6;
  }
  .page-spinner {
    display: inline-block;
    width: 2.75rem;
    height: 2.75rem;
    margin-bottom: .75rem;
    vertical-align: text-bottom;
    border: .15em solid #b4b7c9;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: spinner .75s linear infinite;
    animation: spinner .75s linear infinite;
  }
  [data-bs-theme="dark"] .page-spinner {
    border-color: rgba(255,255,255,.4);
    border-right-color: transparent;
  }
  @-webkit-keyframes spinner {
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @keyframes spinner {
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  /* Header Language Switcher Styles */
  .language-switcher-header .language-switcher {
    margin: 0;
    padding: 0;
  }
  
  .language-switcher-header .language-switcher .btn {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid #dee2e6;
    background-color: #fff;
    color: #495057;
    transition: all 0.2s ease-in-out;
  }
  
  .language-switcher-header .language-switcher .btn:hover {
    background-color: #f8f9fa;
    border-color: #adb5bd;
    color: #212529;
  }
  
  .language-switcher-header .language-switcher .btn:focus {
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
    border-color: #6366f1;
  }
  
  .language-switcher-header .language-switcher .dropdown-menu {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    padding: 0.5rem 0;
    min-width: 160px;
    margin-top: 0.25rem;
  }
  
  .language-switcher-header .language-switcher .dropdown-item {
    padding: 0.5rem 1rem;
    color: #495057;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .language-switcher-header .language-switcher .dropdown-item:hover {
    background-color: #f8f9fa;
    color: #212529;
  }
  
  .language-switcher-header .language-switcher .dropdown-item:active {
    background-color: #6366f1;
    color: #fff;
  }
  
  /* Ensure proper spacing and alignment */
  .language-switcher-header {
    position: relative;
    display: flex;
    align-items: center;
  }
</style> 