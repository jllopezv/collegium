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
        'class' => 'bg-purple-500 hover:bg-purple-600 active:bg-purple-500 focus:border-purple-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
