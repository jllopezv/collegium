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
        'class' => 'bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-500 focus:border-indigo-500'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
