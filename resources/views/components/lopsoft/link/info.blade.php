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
        'class' => 'bg-blue-500 hover:bg-blue-600 active:bg-blue-500 focus:border-blue-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>
