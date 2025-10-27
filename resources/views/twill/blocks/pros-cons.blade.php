@twillBlockTitle('Pros and Cons')
@twillBlockIcon('list')
@twillBlockGroup('app')

<x-block-display-languages />

<x-block-title-description />

@formField('input', [
    'type' => 'textarea',
    'name' => 'pros',
    'label' => 'Pros',
    'placeholder' => 'Enter one pro per line',
    'note' => 'Enter each pro on a new line',
    'rows' => 6,
    'translated' => true
])

@formField('input', [
    'type' => 'textarea',
    'name' => 'cons',
    'label' => 'Cons',
    'placeholder' => 'Enter one con per line',
    'note' => 'Enter each con on a new line',
    'rows' => 6,
    'translated' => true
])

