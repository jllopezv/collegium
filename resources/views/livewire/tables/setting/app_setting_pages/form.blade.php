<x-lopsoft.control.inputform
    wire:model.lazy='settingpage'
    id='settingpage'
    x-ref='settingpage'
    label="{{ transup('page') }}"
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    nextref='description'
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='description'
    id='description'
    x-ref='description'
    label="{{ transup('description') }}"
    autofocus
    classcontainer='w-full'
    nextref='priority'
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='priority'
    id='priority'
    x-ref='priority'
    label="{{ transup('order') }}"
    sublabel='Orden en el que aparecerán en la ficha de configuraciones. Debe ser un número. Siendo el 1 el de mayor prioridad.'
    @keydown.enter='$refs.btnCreate.click()'
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode='{{ $mode }}'
/>
@isSuperadmin
<div class='mt-2'>
    <x-lopsoft.control.checkbox
        label='SOLO SUPERADMIN'
        model='onlysuperadmin'
        color='text-blue-400'
        classlabel='font-bold'
        mode='{{ $mode }}'
    />
</div>
@endisSuperadmin

