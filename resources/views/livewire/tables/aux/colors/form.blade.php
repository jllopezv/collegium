<x-lopsoft.control.inputform
    wire:model.lazy='name'
    id='name'
    x-ref='name'
    label="{{ transup('name') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    nextref='textcolor'
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='textcolor'
    id='textcolor'
    x-ref='textcolor'
    label="{{ transup('textcolor') }}"
    sublabel='Color en forma de clase de Tailwind (ej. text-blue-300)'
    autofocus
    classcontainer='w-1/3'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='background'
    id='background'
    x-ref='textcolor'
    label="{{ transup('backgroundcolor') }}"
    sublabel='Color en forma de clase de Tailwind (ej. bg-blue-600)'
    autofocus
    classcontainer='w-1/3'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<div class='py-4'>
    <x-lopsoft.control.label
        class="font-bold"
        text="{{ transup('preview') }}"
    />
    <div class=''>
        {!! $muestra !!}
    </div>
</div>
