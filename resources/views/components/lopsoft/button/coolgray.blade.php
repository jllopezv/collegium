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
        'class' => 'bg-cool-gray-400 hover:bg-cool-gray-500 active:bg-cool-gray-500 focus:border-cool-gray-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
