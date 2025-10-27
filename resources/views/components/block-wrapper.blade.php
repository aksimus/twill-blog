@php
    // Check if block should be displayed on current language
    $displayLanguages = $block->input('display_languages') ?? [];
    $currentLocale = app()->getLocale();
    
    // If display_languages exists and is not empty, check if current locale is allowed
    $shouldDisplay = true;
    if (!empty($displayLanguages) && is_array($displayLanguages)) {
        // Check if current locale is in the allowed languages
        if (!in_array($currentLocale, $displayLanguages)) {
            // Don't render this block for current language
            $shouldDisplay = false;
        }
    }
    
    // In admin context, always display (for preview)
    if (app()->runningInConsole() || request()->is('cms/*') || request()->is('admin/*')) {
        $shouldDisplay = true;
    }
@endphp

@if($shouldDisplay)
{{ $slot }}
@endif
