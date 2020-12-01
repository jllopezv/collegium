@props( [
    'text'         => 'text-gray-400',
])

<span
    {{ $attributes->merge([
        'class' => $text ])
    }}
    >
    {!! $slot !!}
</span>
