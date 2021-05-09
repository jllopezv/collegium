@props([
    'text'  => '',
    'icon'  => '',
    'ref'   => '',
    'link'  => '',
    'help'  => '',
    'helpclass' =>  '',
    'textxs'    => false,
])

<x-lopsoft.inlinelink.inlinelink-base
    ref="{{$ref}}"
    :text='$text'
    :icon='$icon'
    :link='$link'
    :help='$help'
    :textxs='$textxs'
    :helpclass='$helpclass'
    {{ $attributes ->merge([
        'class' => 'text-gray-500 hover:text-gray-600 active:text-gray-300 focus:border-gray-300'
    ]) }}>
    {!! $slot !!}
</x-lopsoft.link.link-base>
