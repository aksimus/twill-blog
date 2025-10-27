@twillRepeaterTitle('FAQ Item')
@twillRepeaterTrigger('Add FAQ Item')

<x-twill::input
    name="question"
    label="Question"
    placeholder="Enter the question"
    :translated="true"
/>

@formField('wysiwyg', [
    'name' => 'answer',
    'label' => 'Answer',
    'placeholder' => 'Enter the answer',
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


