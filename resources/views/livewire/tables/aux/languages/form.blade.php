<x-lopsoft.control.inputform
    wire:model.lazy='language'
    id='language'
    x-ref='language'
    label="{{ trans('language') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    nextref='code'
    mode="{{ $mode }}"
/>

<x-lopsoft.control.inputform
    wire:model.lazy='code'
    id='code'
    x-ref='code'
    label="{{ trans('code') }}"
    nextref='btnCreate'
    classcontainer='w-60'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
/>
