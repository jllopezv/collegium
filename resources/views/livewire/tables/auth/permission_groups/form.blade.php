<x-lopsoft.control.inputform
    wire:model.lazy='group'
    id='group'
    x-ref='group'
    label="{{ transup('group') }}"
    class='w-full'
    nextref='priority'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode='{{ $mode }}'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='priority'
    id='priority'
    x-ref='priority'
    label="{{ transup('order') }}"
    sublabel='Orden en el que aparecerán en la ficha de ROL. Debe ser un número. Siendo el 1 el de mayor prioridad.'
    class='w-full'
    @keydown.enter='$refs.btnCreate.click()'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode='{{ $mode }}'
/>
