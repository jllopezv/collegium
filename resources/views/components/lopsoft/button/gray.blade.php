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
        'class' => 'bg-gray-300 hover:bg-gray-400 active:bg-gray-300 focus:border-gray-300'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
