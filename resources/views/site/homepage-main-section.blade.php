{{-- Homepage Main Section --}}
{{-- Add your main section content here --}}

@php
$widgets = [
    'en' => [
        [
            'title' => '1. IFTA Mileage Calculator',
            'content' => 'Enter or import your trips and get state-by-state miles for your truck.',
        ],
        [
            'title' => '2. Fuel Purchases',
            'content' => 'Enter or import fuel purchases by state. IFTA tax rates are already built in.',
        ],
        [
            'title' => '3. IFTA Tax Report',
            'content' => 'Generate reports for a single truck or your entire fleet. Get a filing-ready PDF.',
        ]
    ],
    'es' => [
    [
        'title' => 'Calculadora de millas',
        'content' => 'Introduce tus viajes y obtén el kilometraje de tu camión por cada estado.',
    ],
    [
        'title' => 'Compras de combustible',
        'content' => 'Introduce o importa tus compras de combustible por estado. Las tasas de impuestos IFTA ya están incluidas.',
    ],
    [
        'title' => 'Informe de impuestos IFTA',
        'content' => 'Genera informes para un solo camión o para toda tu flota. Obtén un PDF listo para presentar.',
    ]
],  
    'ru' => [
        [
            'title' => 'Калькулятор пробега',
            'content' => 'Добавьте поездки и получите пробег вашего грузовика по каждому штату.',
        ],
        [
            'title' => 'Покупки топлива',
            'content' => 'Добавляйте или импортируйте покупки топлива по штатам. Ставки налогов IFTA уже включены.',
        ],
        [
            'title' => 'Налоговый отчёт IFTA',
            'content' => 'Создавайте отчёты для одного грузовика или всего автопарка. Получайте PDF, готовый для подачи.',
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
    <p class="front-page__video-subtitle">{{ __('homepage.video.subtitle') }}</p>
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
      <h4>Bonus: IFTA Mileage Tracker</h4>
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