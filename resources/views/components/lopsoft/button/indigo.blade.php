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
        'class' => 'bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-500 focus:border-indigo-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
