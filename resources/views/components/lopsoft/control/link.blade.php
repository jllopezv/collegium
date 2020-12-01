@props( [
    'textcolor'         => 'text-gray-400',
    'hovertextcolor'    => 'text-white',
    'link'              => ''
])

<a
    {{ $attributes->merge([
        'class' => 'cursor-pointer '.$textcolor." hover:".$hovertextcolor ])
    }}
    href='{!! $link !!}'
    >
    {!! $slot !!}
</a>
