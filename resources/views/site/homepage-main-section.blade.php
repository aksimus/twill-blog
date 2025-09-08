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