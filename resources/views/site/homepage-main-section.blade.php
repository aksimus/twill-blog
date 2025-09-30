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
    ],
    'es' => [
    [
        'title' => 'Fácil de usar',
        'content' => 'Con solo unos clics tienes toda la información que necesitas para tus reportes, ya sea de toda tu flota o de un solo camión.',
    ],
    [
        'title' => 'Ahorra tiempo',
        'content' => 'Olvídate de llevar la cuenta de las millas o de hacer cálculos manuales — solo ingresas la información básica de tus viajes y del combustible, y nosotros hacemos el resto.',
    ],
    [
        'title' => 'Generación de reportes',
        'content' => 'Tus reportes trimestrales de impuestos IFTA se generan con un solo clic y los puedes descargar en el formato que necesites en cualquier momento.',
    ],
    [
        'title' => 'Extracción de datos con IA',
        'content' => 'Sube tu PDF de Rate Confirmation y obtén al instante los datos de tu viaje.',
    ]
],  
    'ru' => [
        [
            'title' => 'Простота использования',
            'content' => 'Всего за несколько кликов вся необходимая информация для составления отчетов доступна для всего вашего флота или только для одного юнита.',
        ],
        [
            'title' => 'Экономия времени',
            'content' => 'Больше никакого постоянного отслеживания миль или ручных расчетов - вы вводите начало и конец трипа и информацию о приобретенном топливе, а калькулятор делает все остальное.',
        ],
        [
            'title' => 'Генерация отчетов',
            'content' => 'Ваши квартальные налоговые отчеты генерируются одним кликом и могут быть загружены в PDF или Excel формате',
        ],
        [
            'title' => 'AI-извлечение данных',
            'content' => 'Загрузите PDF-файл Rate Confirmation, чтобы извлечь данные о трипе и избежать ручного ввода данных',
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
          style="width:100%; display:block; border-radius:8px;"
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
  </div>
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