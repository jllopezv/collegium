@props([
    'text' => '',
    'icon' => '',
    'ref' => '',
    'help' => '',
    'helpclass' => '' ,
    'textxs'    => false,
    ])

<x-lopsoft.button.button-base
    ref="{{$ref}}"
    :text='$text'
    :icon='$icon'
    :help='$help'
    :helpclass='$helpclass'
    :textxs='$textxs'
    {{ $attributes ->merge([
        'class' => 'bg-red-500 hover:bg-red-600 active:bg-red-500 focus:border-red-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
