@props(['items'])

@if(!empty($items))
<div class="table-of-contents mb-4">
    <h6 class="mb-3 fw-semibold text-uppercase">Table of Contents</h6>
    <nav>
        <ol class="toc-list list-unstyled mb-0">
            @foreach($items as $item)
                <li class="toc-item toc-level-{{ $item['level'] }}">
                    <a href="#{{ $item['id'] }}" class="toc-link">{{ $item['text'] }}</a>
                </li>
            @endforeach
        </ol>
    </nav>
</div>
@endif

