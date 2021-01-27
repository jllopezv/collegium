@props([
    'text' => '',
    'icon' => '',
    'ref' => '',
    'help' => '',
    'helpclass' => '' ,
    'textxs'    => false,
    'buttonxs'  => false,
    'nopadding'   => false,
    ])

<x-lopsoft.button.button-base
    ref="{{$ref}}"
    :text='$text'
    :icon='$icon'
    :help='$help'
    :helpclass='$helpclass'
    :buttonxs='$buttonxs'
    :textxs='$textxs'
    :nopadding='$nopadding'
    {{ $attributes ->merge([
        'class' => 'bg-gray-500 hover:bg-gray-600 active:bg-gray-500 focus:border-gray-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
