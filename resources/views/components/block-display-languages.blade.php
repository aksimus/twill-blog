{{-- Common component for block display languages setting --}}
<x-twill::multi-select
    name="display_languages"
    label="Display Languages"
    :options="[
        ['value' => 'en', 'label' => 'English'],
        ['value' => 'es', 'label' => 'Spanish'],
        ['value' => 'ru', 'label' => 'Russian']
    ]"
    :unpack="true"
    :searchable="false"
    :default="['en']"
    note="Select languages where this block should be displayed. By default, only English is selected."
/>
