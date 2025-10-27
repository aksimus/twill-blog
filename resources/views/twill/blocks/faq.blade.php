@twillBlockTitle('FAQ')
@twillBlockIcon('question')
@twillBlockGroup('app')

<x-block-display-languages />

<x-block-title-description />

@formField('repeater', [
    'type' => 'faq_item',
    'label' => 'FAQ Items',
    'trigger' => 'Add FAQ Item',
    'max' => 50
])


