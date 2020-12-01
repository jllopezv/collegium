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
        'class' => 'bg-purple-500 hover:bg-purple-600 active:bg-purple-500 focus:border-purple-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>
