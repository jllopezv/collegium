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
    wire:model.lazy='section'
    id='section'
    x-ref='section'
    label="{{ transup('section') }}"
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='btnCreate'
/>


@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\School\SchoolGrade::class,
    'mode'          => $mode,
    'filterraw'     => '',
    'sortorder'     => 'priority',
    'label'         => transup('grade'),
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
    'key'           => 'id',
    'field'         => 'grade',
    'defaultvalue'  =>  $record->grade_id??null,
    'eventname'     => 'eventsetgrade',
    'uid'           => 'gradecomponent',
    'modelid'       => 'grade_id',
    'isTop'         =>  true,
    'requiredfield' =>  true,
    'help'          =>  transup('mandatory'),
    'linknew'       =>  Auth::user()->hasAbility('school_grades.create')?route('school_grades.create'):'',
])
