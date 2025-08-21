@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $locales = ['en' => 'English', 'ru' => 'Русский', 'es' => 'Español'];
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('about.title') }}</title>
</head>
<body>
    <h1>{{ __('about.title') }}</h1>

    <p><strong>{{ __('about.greeting') }}</strong></p>
    <p>{{ __('about.intro') }}</p>

    <p>
        <a href="{{ route('home') }}">{{ __('home.title') }}</a>
    </p>

    <hr>
    <div>
        <span>{{ __('about.switch_label') }}</span>
        @foreach($locales as $code => $label)
            <a href="{{ LaravelLocalization::getLocalizedURL($code, route('about', [], false)) }}"
               class="{{ app()->getLocale() === $code ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</body>
</html>
