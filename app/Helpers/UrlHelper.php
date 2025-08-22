<?php

namespace App\Helpers;

class UrlHelper
{
    /**
     * Generate a localized URL based on the current request locale
     *
     * @param string $path The path to localize (without leading slash)
     * @return string The localized URL
     */
    public static function localizedUrl(string $path = ''): string
    {
        $locale = request()->segment(1);
        $isLocalized = $locale && in_array($locale, ['es', 'ru']);
        
        if ($isLocalized) {
            return url('/' . $locale . ($path ? '/' . $path : ''));
        }
        
        return url('/' . $path);
    }
} 