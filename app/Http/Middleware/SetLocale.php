<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the locale from the route parameter
        $locale = $request->route('locale');
        
        // Check if the locale parameter is a valid locale
        $supportedLocales = ['en', 'es', 'ru'];
        
        if ($locale && in_array($locale, $supportedLocales)) {
            app()->setLocale($locale);
        } else {
            // No locale in URL, use default (English)
            app()->setLocale('en');
        }
        
        return $next($request);
    }
} 