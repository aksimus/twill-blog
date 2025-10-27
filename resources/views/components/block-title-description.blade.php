{{-- Common component for block title and description --}}
<x-twill::input
    name="title"
    label="Block Title"
    placeholder="Optional: Add a heading for this block"
    :translated="true"
/>

@formField('wysiwyg', [
    'name' => 'description',
    'label' => 'Block Description',
    'placeholder' => 'Optional: Add a description for this block',
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
