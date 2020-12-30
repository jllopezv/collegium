@props([
    'text' => '',
    'icon' => '',
    'ref' => '',
    'help' => '',
    'helpclass' => '' ,
    'textxs'    => false,
    'buttonxs'  => false,
    ])

<x-lopsoft.button.button-base
    ref="{{$ref}}"
    :text='$text'
    :icon='$icon'
    :help='$help'
    :helpclass='$helpclass'
    :buttonxs='$buttonxs'
    :textxs='$textxs'
    {{ $attributes ->merge([
        'class' => 'bg-yellow-300 hover:bg-yellow-400 active:bg-yellow-300 focus:border-yellow-300'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
