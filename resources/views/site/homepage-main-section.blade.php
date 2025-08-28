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
            'content' => 'En solo unos clics toda la información necesaria para la generación de reportes está a mano para todo el equipo que tienes o solo para una unidad.',
        ],
        [
            'title' => 'Ahorro de tiempo',
            'content' => 'No más seguimiento constante de millas o cálculos manuales - ingresas información básica sobre tus viajes y combustible y nosotros hacemos el resto.',
        ],
        [
            'title' => 'Generación de reportes',
            'content' => 'Tus reportes de impuestos trimestrales se generan con solo un clic y se pueden descargar en el formato necesario en cualquier momento.',
        ],
        [
            'title' => 'Extracción de datos con IA',
            'content' => 'Sube tu PDF de Confirmación de Tarifa para obtener instantáneamente los datos de tu viaje',
        ]
    ],
    'ru' => [
        [
            'title' => 'Простота использования',
            'content' => 'Всего за несколько кликов вся необходимая информация для составления отчетов доступна для всего вашего оборудования или только для одной единицы.',
        ],
        [
            'title' => 'Экономия времени',
            'content' => 'Больше никакого постоянного отслеживания миль или ручных расчетов - вы вводите основную информацию о поездках и топливе, а мы делаем все остальное.',
        ],
        [
            'title' => 'Генерация отчетов',
            'content' => 'Ваши квартальные налоговые отчеты генерируются одним кликом и могут быть загружены в нужном формате в любой момент.',
        ],
        [
            'title' => 'ИИ-извлечение данных',
            'content' => 'Загрузите PDF-файл подтверждения тарифа, чтобы мгновенно получить данные о поездке',
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
    @foreach($currentWidgets as $widget)
    <div class="front-page__widget">
      <h4>{{ $widget['title'] }}</h4>
      <p>{!! $widget['content'] !!}</p>
    </div>
    @endforeach
  </div>
</div>