<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
  <head>
  <base href="/">
    @include('layouts.partials.head')
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @yield('seo')
    
  </head>

  <body>
    <!-- Page loading spinner -->
     @if(0)   
     @include('layouts.partials.page-loading')
    @endif
    
    <!-- Page wrapper for sticky footer -->
    <div class="page-wrapper">
      <!-- Navbar -->
      @include('layouts.partials.header')

      <!-- Main Content -->
      @yield('content')
  </div>

    <!-- Footer -->
    @include('layouts.partials.footer')


    <!-- Vendor Scripts -->
    @include('layouts.partials.scripts')
  </body>
</html> 