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
        'class' => 'bg-teal-400 hover:bg-teal-500 active:bg-teal-400 focus:border-teal-400'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
