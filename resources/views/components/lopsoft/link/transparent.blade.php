@props([
    'text'  => '',
    'icon'  => '',
    'ref'   => '',
    'link'  => '',
    'help'  => '',
    'helpclass' =>  '',
    'textxs'    => false,
])

<x-lopsoft.link.link-base
    ref="{{$ref}}"
    :text='$text'
    :icon='$icon'
    :link='$link'
    :help='$help'
    :textxs='$textxs'
    :helpclass='$helpclass'
    {{ $attributes ->merge([
        'class' => 'bg-transparent hover:bg-transparent active:bg-gray-300 focus:border-gray-300'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>