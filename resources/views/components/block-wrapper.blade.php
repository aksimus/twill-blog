@php
    // Check if block should be displayed on current language
    $displayLanguages = $block->input('display_languages') ?? [];
    $currentLocale = app()->getLocale();
    
    // If no languages are selected or it's null, don't display the block on any language
    if (empty($displayLanguages) || !is_array($displayLanguages) || $displayLanguages === null) {
        return;
    }
    
    // Check if current locale is in the allowed languages
    if (!in_array($currentLocale, $displayLanguages)) {
        // Don't render this block for current language
        return;
    }
@endphp

{{ $slot }}
