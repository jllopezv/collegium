@props([
    'width'         => '',
    'columnname'    => 'columnname',
    'order'         => '',
    'sortable'      => false,
    'justify'       => 'start'
])

<th

    {{ $attributes->merge([
        'class' => 'bg-gray-700',
        'width' =>  $width,
    ]) }}
    style='max-width: 100%; '>
    {{ $slot }}
</th>
