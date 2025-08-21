<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Blog') }}</title>
</head>
<body>
    <nav>
        <a href="{{ url(LaravelLocalization::localizeURL('/')) }}">Home</a>
        <a href="{{ url(LaravelLocalization::localizeURL('blog')) }}">Blog</a>
    </nav>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
