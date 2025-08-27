{{-- Homepage Main Section --}}
{{-- Add your main section content here --}}

@php
$widgets = [
    [
        'title' => 'Easy to use',
        'content' => 'In just a few clicks all necessary information for reports generation is at hand per all the equipment you have or just per one unit.',
    ],
    [
        'title' => 'Time saving', 
        'content' => 'No more constant tracking of miles or manual calculations - you input some basic information about your trips and fuel and we do the rest.',
    ],
    [
        'title' => 'Report generation',
        'content' => 'Your quarterly tax reports are generated just in one click and can be downloaded in a necessary format at any moment.',
    ],
    [
        'title' => 'AI data extraction',
        'content' => 'Upload your Rate Confirmation PDF to instantly get your trip data',
    ]
];
@endphp

<div>
  <div class="front-page__video">
    <h4>Watch How it works</h4>
    <div class="front-page__video-container">
      <iframe
        width="560"
        height="315"
        src="https://www.youtube.com/embed/LjUtSkVyAp0"
        frameborder="0"
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>
  </div>

  <div class="front-page__widgets">
    @foreach($widgets as $widget)
    <div class="front-page__widget">
      <h4>{{ $widget['title'] }}</h4>
      <p>{!! $widget['content'] !!}</p>
    </div>
    @endforeach
  </div>
</div>