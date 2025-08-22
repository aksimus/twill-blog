<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    
    <x-seo-meta 
        title="{{ $item->title }}"
        description="{{ $item->description }}"
        type="article"
    />
    
    @vite('resources/css/app.css')
</head>
<body>
    <x-menu/>
    
    <x-language-switcher />
    
    <div class="mx-auto max-w-2xl px-5 md:px-0">
        <div class="prose md:prose-lg lg:prose-xl prose-a:font-normal mt-16 first:mt-0">
            @if($item->hasImage('cover'))
                <img src="{{ $item->image('cover') }}" alt="{{ $item->imageAltText('cover') }}" />
            @endif

            <h1>{{ $item->title }}</h1>
            
            @if($item->description)
                <div class="text-gray-700 mb-6 leading-relaxed">
                    {!! $item->description !!}
                </div>
            @endif
        </div>

        {!! $item->renderBlocks() !!}
    </div>
</body>
</html>
