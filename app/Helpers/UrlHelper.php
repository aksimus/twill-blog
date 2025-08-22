<?php

namespace App\Helpers;

class UrlHelper
{
    /**
     * Generate a localized URL based on the current request locale
     *
     * @param string $path The path to localize (without leading slash)
     * @param array $query Query parameters to add to the URL
     * @return string The localized URL
     */
    public static function localizedUrl(string $path = '', array $query = []): string
    {
        $locale = app()->getLocale();
        $isLocalized = $locale && in_array($locale, ['es', 'ru']);
        
        $url = $isLocalized ? url('/' . $locale . ($path ? '/' . $path : '')) : url('/' . $path);
        
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }
        
        return $url;
    }
} 