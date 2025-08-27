<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
  <head>
    <title>Basic Layout</title>
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
  <base href="/">
  </head>

  <body>
  <h1>Basic Layout</h1>
  @yield('content')
  </body>
  </html> 