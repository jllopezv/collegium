<x-lopsoft.control.inputform
    wire:model.lazy='configable_type'
    id='configable_type'
    x-ref='configable_type'
    label="{{ transup('model') }}"
    class='w-full'
    autofocus
    classcontainer='w-full md:w-1/2'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='configable_id'
/>

<x-lopsoft.control.inputform
    wire:model.lazy='configable_id'
    id='configable_id'
    x-ref='configable_id'
    label="{{ transup('id') }}"
    class='w-full'
    autofocus
    classcontainer='w-28'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='data'
/>

<x-lopsoft.control.textareaform
    wire:model.lazy='datafield'
    id='data'
    x-ref='data'
    label="{{ transup('data') }}"
    sublabel='Deberá estar en formato JSON ej. {"key1":"value1","key2":"value2"}'
    class='w-full'
    autofocus
    classcontainer='w-full'
    mode="{{ $mode }}"
    nextref='btnCreate'
/>
