@props([
    'width'         => '',
    'columnname'    => 'columnname',
    'order'         => '',
    'sortable'      => false,
    'justify'       => 'start'
])

<th

    {{ $attributes->merge([
        'class' => '',
        'width' =>  $width,
    ]) }}
    style='max-width: 100%; width: auto'>
    {{ $slot }}
</th>
