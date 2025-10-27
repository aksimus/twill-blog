<x-block-wrapper :block="$block">
@php
    // Get block title and description
    $title = $block->translatedInput('title') ?? '';
    $description = $block->translatedInput('description') ?? '';
    
    // Get FAQ items using Twill's children API
    $faqItems = $block->children->where('type', 'faq_item') ?? collect();
    $accordionId = 'faq-' . uniqid();
@endphp

@if($faqItems->isNotEmpty())
<div class="faq-block mb-4">
    @if($title)
        <h2 class="mb-3">{{ $title }}</h2>
    @endif
    
    @if($description)
        <div class="mb-3">{!! $description !!}</div>
    @endif
    
    <div class="accordion" id="{{ $accordionId }}">
    @foreach($faqItems as $index => $item)
        @php
            $question = $item->translatedInput('question') ?? '';
            $answer = $item->translatedInput('answer') ?? '';
            $collapseId = 'collapse-' . $accordionId . '-' . $index;
            $headingId = 'heading-' . $accordionId . '-' . $index;
            $isFirst = $index === 0;
        @endphp
        
        @if($question && $answer)
        <div class="accordion-item">
            <h3 class="accordion-header" id="{{ $headingId }}">
                <button class="accordion-button {{ $isFirst ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $isFirst ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                    {{ $question }}
                </button>
            </h3>
            <div class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}" id="{{ $collapseId }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#{{ $accordionId }}">
                <div class="accordion-body">
                    {!! $answer !!}
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div>
</div>
@endif
</x-block-wrapper>


