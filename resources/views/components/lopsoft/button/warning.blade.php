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
        'class' => 'bg-orange-400 hover:bg-orange-500 active:bg-orange-400 focus:border-orange-400'
    ]) }}>
    {{ $slot }}
</x-lopsoft.button.button-base>
