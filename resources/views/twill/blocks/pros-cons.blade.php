@twillBlockTitle('Pros and Cons')
@twillBlockIcon('list')
@twillBlockGroup('app')

<x-block-display-languages />

@formField('repeater', [
    'type' => 'pro_item',
    'label' => 'Pros',
    'trigger' => 'Add Pro',
    'max' => 20
])

@formField('repeater', [
    'type' => 'con_item',
    'label' => 'Cons',
    'trigger' => 'Add Con',
    'max' => 20
])

