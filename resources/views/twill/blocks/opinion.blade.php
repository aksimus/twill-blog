@twillBlockTitle('Opinion')
@twillBlockIcon('quote')
@twillBlockGroup('app')

<x-block-display-languages />

<x-twill::wysiwyg
    type="quill"
    name="quote"
    label="Quote Text"
    placeholder="Enter the opinion/quote text"
    :toolbar-options="[
        'bold',
        'italic',
        'link',
        'clean'
    ]"
    :translated="true"
/>

<x-twill::medias
    name="avatar"
    label="Author Avatar"
    note="Optional: Upload author avatar image (square format recommended)"
    crop="avatar"
/>

<x-twill::input
    name="author_name"
    label="Author Name"
    placeholder="Enter author name"
    :translated="true"
/>

<x-twill::input
    name="author_title"
    label="Author Title"
    placeholder="e.g., CEO of Company Name"
    :translated="true"
/>


