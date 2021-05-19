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
    wire:model.lazy='code'
    id='code'
    x-ref='code'
    label="{{ transup('code') }}"
    sublabel="Use - para obtener un código automático"
    class='w-full'
    autofocus
    classcontainer='w-24'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='subject'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='subject'
    id='subject'
    x-ref='subject'
    label="{{ transup('schoolsubject') }}"
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
    'sortorder'     => 'id',
    'label'         => transup('level'),
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

@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\School\SchoolGrade::class,
    'mode'          => $mode,
    'filterraw'     => '',
    'sortorder'     => 'id',
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

@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\School\SchoolPeriod::class,
    'mode'          => $mode,
    'filterraw'     => '',
    'sortorder'     => 'id',
    'label'         => transup('period'),
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-3/4',
    'key'           => 'id',
    'field'         => 'period',
    'defaultvalue'  =>  null,
    'eventname'     => 'eventsetperiod',
    'uid'           => 'periodcomponent',
    'modelid'       => 'period_id',
    'isTop'         =>  true,
    'requiredfield' =>  true,
    'help'          =>  transup('mandatory'),
    'linknew'       =>  Auth::user()->hasAbility('school_periods.create')?route('school_periods.create'):'',
])
