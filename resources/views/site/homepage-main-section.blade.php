{{-- Homepage Main Section --}}
{{-- Add your main section content here --}}

@php
$widgets = [
    'en' => [
        [
            'title' => 'Easy to use',
            'content' => 'In just a few clicks all necessary information for reports generation is at hand per all the equipment you have or just per one unit.',
        ],
        [
            'title' => 'Time saving', 
            'content' => 'No more manual tracking of miles — enter your trips and we do the math.',
        ],
        [
            'title' => 'Report generation',
            'content' => 'Your quarterly tax reports are generated just in one click and can be downloaded in a necessary format at any moment.',
        ]
    ],
    'es' => [
    [
        'title' => 'Fácil de usar',
        'content' => 'Con solo unos clics tienes toda la información que necesitas para tus reportes, ya sea de toda tu flota o de un solo camión.',
    ],
    [
        'title' => 'Ahorra tiempo',
        'content' => 'Olvídate del conteo manual de millas — ingresa tus viajes y nosotros hacemos los cálculos.',
    ],
    [
        'title' => 'Generación de reportes',
        'content' => 'Tus reportes trimestrales de impuestos IFTA se generan con un solo clic y los puedes descargar en el formato que necesites en cualquier momento.',
    ]
],  
    'ru' => [
        [
            'title' => 'Простота использования',
            'content' => 'Всего за несколько кликов вся необходимая информация для составления отчетов доступна для всего вашего флота или только для одного юнита.',
        ],
        [
            'title' => 'Экономия времени',
            'content' => 'Больше никакого ручного отслеживания миль — вводите трипы, а расчёты мы берём на себя.',
        ],
        [
            'title' => 'Генерация отчетов',
            'content' => 'Ваши квартальные налоговые отчеты генерируются одним кликом и могут быть загружены в PDF или Excel формате',
        ]
    ]
];

// Get current locale or default to English
$currentLocale = app()->getLocale();
$currentWidgets = $widgets[$currentLocale] ?? $widgets['en'];
@endphp

<div>
  <div class="front-page__video">
    <h4>{{ __('homepage.video.title') }}</h4>
    <div class="front-page__video-container" data-yt-id="LjUtSkVyAp0">
      <div class="youtube-video-placeholder" style="position:relative; width:560px; max-width:100%; cursor:pointer;">
        <img
          src="/img/youtube_how_to_cover.webp"
          alt="YouTube Video: Watch how IFTA calculator works"
          width="560"
          height="315"
          style="width:100%; height:auto; display:block; border-radius:8px;"
        >
        <button
          type="button"
          class="yt-poster"
          aria-label="Play video"
          style="
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            background:rgba(0,0,0,0.6);
            border:none;
            border-radius:50%;
            width:64px;
            height:64px;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
          "
        >
          <svg width="40" height="40" viewBox="0 0 40 40" fill="white" xmlns="http://www.w3.org/2000/svg">
            <polygon points="15,10 30,20 15,30" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="front-page__widgets">
    @foreach($currentWidgets as $widget)
    <div class="front-page__widget">
      <h4>{{ $widget['title'] }}</h4>
      <p>{!! $widget['content'] !!}</p>
    </div>
    @endforeach

    <a href="/ifta-mileage-tracker" class="front-page__widget front-page__widget--tracker">
      <h4>IFTA Mileage Tracker App</h4>
      <p>Your phone logs every state line you cross automatically — no more manual mileage sheets.</p>
      <span class="front-page__tracker-cta">Try the IFTA tracker app &rarr;</span>
    </a>
  </div>

  <style>
    .front-page__widget--tracker {
      display: block;
      text-decoration: none;
      border: 1px solid hsl(210, 82%, 82%);
      border-radius: 12px;
      padding: 20px;
      background: hsl(210, 82%, 97%);
      transition: box-shadow .15s ease, transform .15s ease;
    }
    .front-page__widget--tracker:hover {
      text-decoration: none;
      box-shadow: 0 10px 24px hsla(210, 82%, 40%, .15);
      transform: translateY(-2px);
    }
    .front-page__tracker-cta {
      display: inline-block;
      font-weight: 600;
      color: hsl(210, 82%, 42%) !important;
    }
  </style>
</div>

<!-- YouTube Video Lazy Loading JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.front-page__video-container').forEach(container => {
      const id = container.dataset.ytId;
      const posterBtn = container.querySelector('.yt-poster');

      if (!posterBtn || !id) return;

      const activate = () => {
        if (container.dataset.loaded) return;

        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube-nocookie.com/embed/${id}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
        iframe.title = 'YouTube video player';
        iframe.allow =
          'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
        iframe.allowFullscreen = true;
        iframe.style.width = '100%';
        iframe.style.height = '315px';
        iframe.setAttribute('frameborder', '0');

        container.dataset.loaded = '1';
        container.innerHTML = '';
        container.appendChild(iframe);
      };

      // Click or keyboard (Enter/Space) to activate
      posterBtn.addEventListener('click', activate);
      posterBtn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          activate();
        }
      });
    });
  });
</script>