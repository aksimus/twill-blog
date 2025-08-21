@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $locales = ['en' => 'English', 'ru' => 'Русский', 'es' => 'Español'];
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('home.title') }}</title>
</head>
<body>
    <h1>{{ __('home.title') }}</h1>
    <p>{{ __('home.welcome') }}</p>

    <p>
        <a href="{{ route('about') }}">{{ __('about.title') }}</a>
    </p>

    <hr>
    <div>
        <span>{{ __('home.switch_label') }}</span>
        @foreach($locales as $code => $label)
            <a href="{{ LaravelLocalization::getLocalizedURL($code, route('home', [], false)) }}"
               class="{{ app()->getLocale() === $code ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</body>
</html>
