@twillBlockTitle('Image')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-block-display-languages />

<x-block-title-description />

<x-twill::checkbox
    name="enable_gallery"
    label="Open in Gallery (Lightbox)"
    note="If enabled, clicking the image will open it in a lightbox gallery. If disabled, the image will be displayed without click interaction."
    default="false"
/>

<x-twill::medias
    name="highlight"
    label="Highlight"
/>
