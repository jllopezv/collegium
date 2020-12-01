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
    {{ $attributes ->merge([
        'class' => 'bg-green-400 hover:bg-green-500 active:bg-green-400 focus:border-green-400'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>
