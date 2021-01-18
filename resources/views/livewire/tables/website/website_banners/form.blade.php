<x-lopsoft.control.inputform
    wire:model.lazy='banner'
    id='banner'
    x-ref='banner'
    label="{{ transup('banner') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='width'
/>

<div class='flex items-center justify-start'>

    <x-lopsoft.control.inputform
        wire:model.lazy='width'
        id='width'
        x-ref='width'
        label="{{ transup('width') }}"
        class='w-full'
        autofocus
        classcontainer='w-40 mr-2'
        requiredfield
        help="{{ transup('mandatory') }}"
        mode="{{ $mode }}"
        nextref='height'
    />

    <x-lopsoft.control.inputform
        wire:model.lazy='height'
        id='height'
        x-ref='height'
        label="{{ transup('height') }}"
        class='w-full'
        autofocus
        classcontainer='w-40'
        requiredfield
        help="{{ transup('mandatory') }}"
        mode="{{ $mode }}"
        nextref='btnCreate'
    />
</div>
