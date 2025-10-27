<x-block-wrapper :block="$block">
@php
    // Get block title and description
    $title = $block->translatedInput('title') ?? '';
    $description = $block->translatedInput('description') ?? '';
    
    // Get pros and cons from textarea fields
    $prosText = $block->translatedInput('pros') ?? '';
    $consText = $block->translatedInput('cons') ?? '';
    
    // Split by newlines and filter empty lines
    $pros = $prosText ? array_filter(array_map('trim', explode("\n", $prosText)), fn($item) => !empty($item)) : [];
    $cons = $consText ? array_filter(array_map('trim', explode("\n", $consText)), fn($item) => !empty($item)) : [];
@endphp

@if(!empty($pros) || !empty($cons))
<div class="pros-cons-block mb-4">
    @if($title)
        <h2 class="mb-3">{{ $title }}</h2>
    @endif
    
    @if($description)
        <div class="mb-3">{!! $description !!}</div>
    @endif
    
    @if(!empty($pros))
    <div class="mb-4">
        <h4 class="h6">
            <i class="bx bx-plus-circle me-1 mt-n1 align-middle fs-5 text-primary"></i>
            {{ __('Pros') }}
        </h4>
        <ul class="mb-4 pb-2 ps-4">
            @foreach($pros as $pro)
                <li class="mb-1">{{ $pro }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(!empty($cons))
    <div class="mb-4">
        <h4 class="h6">
            <i class="bx bx-minus-circle me-1 mt-n1 align-middle fs-5 text-primary"></i>
            {{ __('Cons') }}
        </h4>
        <ul class="mb-4 pb-2 ps-4">
            @foreach($cons as $con)
                <li class="mb-1">{{ $con }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endif
</x-block-wrapper>

