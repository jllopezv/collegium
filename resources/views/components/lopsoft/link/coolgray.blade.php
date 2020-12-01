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
        'class' => 'bg-cool-gray-400 hover:bg-cool-gray-500 active:bg-cool-gray-500 focus:border-cool-gray-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>
