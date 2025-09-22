<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // раскомментируй после `php artisan install:api`
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api-front',
    )
    ->withMiddleware(function (Middleware $middleware) {



        // === Аналог $routeMiddleware (aliases) из старого Kernel ===
        $middleware->alias([
            'localize'              => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'  => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'  => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'        => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'SetLocale'             => \App\Http\Middleware\SetLocale::class,
            'handleVisitorData'     => \App\Http\Middleware\HandleVisitorData::class,
            'EncryptCookies'        => \App\Http\Middleware\EncryptCookies::class,
        ]);
        $middleware->removeFromGroup('web', [\Illuminate\Cookie\Middleware\EncryptCookies::class] );
        $middleware->appendToGroup('web', [\App\Http\Middleware\HandleVisitorData::class, \App\Http\Middleware\EncryptCookies::class]);

   
       // dd($middleware->web());
        // Примеры (опционально), если нужно вмешаться в группы:
        // $middleware->appendToGroup('web', \App\Http\Middleware\SomeGlobalWebMiddleware::class);
        // $middleware->prepend(\App\Http\Middleware\StartOfStack::class); // глобально
        // $middleware->append(\App\Http\Middleware\EndOfStack::class);    // глобально
        // $middleware->priority([...]); // если нужно задать приоритет
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Здесь можно сконфигурировать обработку исключений
    })
    ->create();
