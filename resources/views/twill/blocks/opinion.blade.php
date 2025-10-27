@twillBlockTitle('Opinion')
@twillBlockIcon('quote')
@twillBlockGroup('app')

<x-block-display-languages />

<x-block-title-description />

@formField('wysiwyg', [
    'name' => 'quote',
    'label' => 'Quote Text',
    'placeholder' => 'Enter the opinion/quote text',
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


