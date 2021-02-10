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
    'sortorder'     => 'priority',
    'label'         => transup('schoollevel'),
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
    'key'           => 'id',
    'field'         => 'level',
    'defaultvalue'  =>  $record->level_id??null,
    'eventname'     => 'eventsetlevel',
    'uid'           => 'levelcomponent',
    'modelid'       => 'level_id',
    'isTop'         =>  true,
    'requiredfield' =>  true,
    'help'          =>  transup('mandatory'),
    'linknew'       =>  Auth::user()->hasAbility('school_levels.create')?route('school_levels.create'):'',
])
