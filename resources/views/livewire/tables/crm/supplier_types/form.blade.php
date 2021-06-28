<x-lopsoft.control.inputform
    wire:model.lazy='type'
    id='type'
    x-ref='type'
    label="{{ transup('type') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>
