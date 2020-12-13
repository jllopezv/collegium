<x-lopsoft.control.inputform
    wire:model.lazy='showorder'
    id='showorder'
    x-ref='showorder'
    label="{{ transup('showorder') }}"
    sublabel='Orden en el que se mostrará cuando vaya a elegir el grado en otro formulario'
    nextref='grade'
    classcontainer='w-24'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>
<x-lopsoft.control.inputform
    wire:model.lazy='grade'
    id='grade'
    x-ref='grade'
    label="{{ transup('schoolgrade') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>

@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\School\SchoolLevel::class,
    'mode'          => $mode,
    'filterraw'     => '',
    'sortorder'     => 'showorder',
    'label'         => transup('schoollevel'),
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
    'key'           => 'id',
    'field'         => 'level',
    'defaultvalue'  =>  $record->level_id??null,
    'eventname'     => 'eventsetlevel',
    'uid'           => 'levelcomponent',
    'modelid'       => 'level_id',
    'isTop'         =>  true,
])
