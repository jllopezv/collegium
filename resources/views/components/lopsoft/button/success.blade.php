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
        'class' => 'bg-green-400 hover:bg-green-500 active:bg-green-400 focus:border-green-400'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
