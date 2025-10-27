{{-- Common component for block display languages setting --}}
@formField('multi_select', [
    'name' => 'display_languages',
    'label' => 'Display Languages',
    'options' => [
        ['value' => 'en', 'label' => 'English'],
        ['value' => 'es', 'label' => 'Spanish'],
        ['value' => 'ru', 'label' => 'Russian']
    ],
    'unpack' => true,
    'searchable' => false,
    'note' => 'Leave empty to display on all languages. Select specific languages to restrict where this block appears.'
])
