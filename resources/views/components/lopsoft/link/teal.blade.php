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
        'class' => 'bg-teal-400 hover:bg-teal-500 active:bg-teal-400 focus:border-teal-400'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>
