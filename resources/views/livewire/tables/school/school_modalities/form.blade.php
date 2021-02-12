<x-lopsoft.control.inputform
    wire:model.lazy='priority'
    id='priority'
    x-ref='priority'
    label="{{ transup('priority') }}"
    sublabel='Orden en el que se mostrará cuando vaya a elegir el grado en otro formulario'
    nextref='grade'
    classcontainer='w-24'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='modality'
    id='modality'
    x-ref='modality'
    label="{{ transup('modality') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>
