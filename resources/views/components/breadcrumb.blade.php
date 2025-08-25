@props(['items' => []])

<nav class="container pt-4 mt-lg-3" aria-label="breadcrumb">
  <ol class="breadcrumb mb-0">
    @foreach($items as $index => $item)
      @if($index === 0)
        <li class="breadcrumb-item">
          <a href="{{ $item['url'] }}">
            <i class="bx bx-home-alt fs-lg me-1"></i>{{ $item['title'] }}
          </a>
        </li>
      @elseif($index === count($items) - 1)
        <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
      @else
        <li class="breadcrumb-item">
          <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
        </li>
      @endif
    @endforeach
  </ol>
</nav> 