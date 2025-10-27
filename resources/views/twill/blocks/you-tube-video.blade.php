@twillBlockTitle('YouTube Video')
@twillBlockIcon('video')
@twillBlockGroup('media')

<x-block-display-languages />

<x-block-title-description />

<x-twill::input
    name="caption"
    label="Video Caption"
    placeholder="Enter video caption (displayed below video)"
    :translated="true"
/>

<x-twill::input
    name="youtube_id"
    label="YouTube Video ID"
    placeholder="e.g., dQw4w9WgXcQ"
    note="Extract from YouTube URL: https://www.youtube.com/watch?v=dQw4w9WgXcQ"
    :required="true"
    :translated="true"
/>

@formField('wysiwyg', [
    'name' => 'rich_description',
    'label' => 'Description',
    'placeholder' => 'Detailed description with formatting',
    'translated' => true,
    'toolbarOptions' => [
        ['header' => [2, 3, 4, 5, 6, false]],
        'bold',
        'italic',
        'underline',
        'strike',
        'blockquote',
        'code-block',
        'ordered',
        'bullet',
        'hr',
        'code',
        'link',
        'clean',
        'table',
        'code-view'
    ]
])

@formField('medias', [
    'name' => 'cover_image',
    'label' => 'Custom Cover Image',
    'note' => 'Optional: Upload a custom cover image instead of using YouTube thumbnail'
])

<x-twill::select
    name="load_type"
    label="Load Type"
    :options="[
        ['value' => 'immediate', 'label' => 'Load Player Immediately'],
        ['value' => 'cover_modal', 'label' => 'Show Cover Image + Modal Popup'],
        ['value' => 'gallery_style', 'label' => 'Gallery Style (Lightbox)']
    ]"
    default="immediate"
    note="Choose how the video should be loaded"
/>

<x-twill::select
    name="aspect_ratio"
    label="Aspect Ratio"
    :options="[
        ['value' => '16:9', 'label' => '16:9 (Widescreen)'],
        ['value' => '4:3', 'label' => '4:3 (Standard)'],
        ['value' => '1:1', 'label' => '1:1 (Square)'],
        ['value' => '21:9', 'label' => '21:9 (Ultrawide)']
    ]"
    default="16:9"
/>

<x-twill::checkbox
    name="autoplay"
    label="Autoplay"
    note="Video will start playing automatically (may be blocked by browsers)"
/>

<x-twill::checkbox
    name="show_controls"
    label="Show Player Controls"
    default="true"
/>


<x-twill::checkbox
    name="responsive"
    label="Responsive Design"
    default="true"
    note="Video will scale with container width"
/>
