<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
  <head>
    @include('layouts.partials.head')
  </head>

  <body>
    <!-- Page loading spinner -->
    @include('layouts.partials.page-loading')

    <!-- Page wrapper for sticky footer -->
    <main class="page-wrapper">
      <!-- Navbar -->
      @include('layouts.partials.header')

      <!-- Main Content -->
      @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Back to top button -->
    @include('layouts.partials.back-to-top')

    <!-- Vendor Scripts -->
    @include('layouts.partials.scripts')
  </body>
</html> 