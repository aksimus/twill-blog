@props([
    'seoMeta' => null,
    'title' => null, 'description' => null, 'keywords' => null, 'image' => null,
    'type' => 'website', 'author' => null, 'publishedTime' => null, 'modifiedTime' => null
])

@php
    // Get SEO meta data from the service (shared by controllers)
    $seoMeta = $seoMeta ?? [];
    
    // Start with service data
    $meta = $seoMeta;
    

    
    // Override with component props only if they are provided (not null)
    if ($title !== null) $meta['title'] = $title;
    if ($description !== null) $meta['description'] = $description;
    if ($keywords !== null) $meta['keywords'] = $keywords;
    if ($image !== null) $meta['image'] = $image;
    if ($type !== null) $meta['type'] = $type;
    if ($author !== null) $meta['author'] = $author;
    if ($publishedTime !== null) $meta['publishedTime'] = $publishedTime;
    if ($modifiedTime !== null) $meta['modifiedTime'] = $modifiedTime;
    
    // Remove null values but keep empty strings for title/description
    $meta = array_filter($meta, function($value, $key) {
        if (in_array($key, ['title', 'description'])) {
            return $value !== null; // Keep empty strings for title/description
        }
        return $value !== null; // Remove only null values for other fields
    }, ARRAY_FILTER_USE_BOTH);
    

@endphp

@if(!empty($meta))
    @php
        $seoService = app(\App\Services\SeoMetaService::class);
        echo $seoService->generateMetaTags($meta);
    @endphp
@else
    <!-- No meta data to generate. Meta: {{ json_encode($meta) }} -->
@endif 