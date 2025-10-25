<x-block-wrapper :block="$block">
@php
    // Get repeater items using Twill's children API
    $pros = $block->children->where('type', 'pro_item') ?? collect();
    $cons = $block->children->where('type', 'con_item') ?? collect();
@endphp

@if($pros->isNotEmpty() || $cons->isNotEmpty())
<div class="pros-cons-block mb-4">
    @if($pros->isNotEmpty())
    <div class="mb-4">
        <h4 class="h6">
            <i class="bx bx-plus-circle me-1 mt-n1 align-middle fs-5 text-primary"></i>
            PROS
        </h4>
        <ul class="mb-4 pb-2 ps-4">
            @foreach($pros as $pro)
                <li class="mb-1">{{ $pro->translatedInput('text') }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($cons->isNotEmpty())
    <div class="mb-4">
        <h4 class="h6">
            <i class="bx bx-minus-circle me-1 mt-n1 align-middle fs-5 text-primary"></i>
            CONS
        </h4>
        <ul class="mb-4 pb-2 ps-4">
            @foreach($cons as $con)
                <li class="mb-1">{{ $con->translatedInput('text') }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endif
</x-block-wrapper>

