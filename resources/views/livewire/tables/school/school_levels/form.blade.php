<x-lopsoft.control.inputform
    wire:model.lazy='showorder'
    id='showorder'
    x-ref='showorder'
    label="{{ transup('showorder') }}"
    sublabel='Orden en el que se mostrará cuando vaya a elegir el nivel en otro formulario'
    nextref='level'
    classcontainer='w-24'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='level'
    id='level'
    x-ref='level'
    label="{{ transup('schoollevel') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>
