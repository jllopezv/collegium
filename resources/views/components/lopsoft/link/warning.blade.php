@props([
    'text'  => '',
    'icon'  => '',
    'ref'   => '',
    'link'  => '',
    'help'  => '',
    'helpclass' =>  '',
    'textxs'    => false,

<x-lopsoft.link.link-base
    ref="{{$ref}}"
    :text='$text'
    :icon='$icon'
    :link='$link'
    :help='$help'
    :textxs='$textxs'
    {{ $attributes ->merge([
        'class' => 'bg-orange-400 hover:bg-orange-500 active:bg-orange-400 focus:border-orange-400'
    ]) }}>
    {{ $slot }}
</x-lopsoft.link.link-base>
