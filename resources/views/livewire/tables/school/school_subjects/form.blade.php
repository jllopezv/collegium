
<x-lopsoft.control.inputform
    wire:model.lazy='code'
    id='code'
    x-ref='code'
    label="{{ transup('code') }}"
    sublabel="Use - para obtener un código automático"
    class='w-full'
    autofocus
    classcontainer='w-48'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='abbr'
/>
<x-lopsoft.control.inputform
    wire:model.lazy='abbr'
    id='abbr'
    x-ref='abbr'
    label="{{ transup('abbreviation') }}"
    sublabel="Abreviación para la asignatura"
    class='w-full'
    autofocus
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
    nextref='subject'
/>
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
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-1/3',
    'key'           => 'id',
    'field'         => 'level',
    'defaultvalue'  =>  $record->grade->level->id??null,
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
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-1/3',
    'key'           => 'id',
    'field'         => 'grade',
    'defaultvalue'  =>  $record->grade->id??null,
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
    'classdropdown' => 'w-full md:w-3/4 lg:w-full xl:w-1/3',
    'key'           => 'id',
    'field'         => 'period',
    'defaultvalue'  =>  $record->period->id??null,
    'eventname'     => 'eventsetperiod',
    'uid'           => 'periodcomponent',
    'modelid'       => 'period_id',
    'isTop'         =>  true,
    'requiredfield' =>  true,
    'help'          =>  transup('mandatory'),
    'linknew'       =>  Auth::user()->hasAbility('school_periods.create')?route('school_periods.create'):'',
])

<x-lopsoft.control.tabs minheight='600px'>
    <x-slot name='tabs'>
        <x-lopsoft.control.tabs-index title='PROFESORES' index='1'></x-lopsoft.control.tabs-index>
    </x-slot>
    <x-slot name='tabscontent'>
        <x-lopsoft.control.tabs-content index='1'>

            @if($mode!='show')
                <div class='mt-2'>
                    <x-lopsoft.link.success target='_blank' link="{{ route('teachers.create') }}" icon='fa fa-plus' text='NUEVO' />
                    @if(!$showTeachers && !$selectedTeacher)
                        <x-lopsoft.link.gray wire:click='showTeachersDialog' icon='fa fa-search' text='SELECCIONAR' />
                    @endif
                    <div class='px-2 mt-2 border rounded-lg bg-gray-100 border-cool-gray-300'>
                        @livewire('search.search-teachers-component', [
                            'uid'           =>  'searchteachercomponent',
                            'showdialog'    =>  $showTeachers,
                        ])
                    </div>
                    @if($selectedTeacher)
                        <div class='p-2 mt-4 border rounded-lg bg-gray-100 border-cool-gray-300'>
                            <div class=''>
                                <div class=''>
                                    <x-lopsoft.control.inputform
                                    label="{{ transup('teacher') }}"
                                    class='bg-transparent'
                                    classcontainer='w-full'
                                    mode='show'
                                    value="{{ $teacher->teacher??'' }}"
                                    ></x-lopsoft.control.inputform>
                                </div>
                            </div>

                            @livewire('messages.flash-message', ['msgid' => 'teacherInfo'] )
                        </div>
                    @endif
                </div>
            @endif

            <div class='mt-4'>
                @forelse($teachers_list as $key=>$teacher)
                    <div class="pt-1 pb-4 md:pb-0 px-4 mb-1 flex flex-wrap md:flex-no-wrap items-center justify-start bg-cool-gray-200 hover:bg-cool-gray-300 {{ ($mode=='edit' || $mode=='create')?'cursor-pointer':'' }} rounded-md">
                        <div class='w-full md:w-20 flex items-center justify-end md:justify-start p-2'>
                            @if($mode!='show')
                                <div class='p-1'>
                                    <i wire:click='deleteTeacher({{$key}})' class='text-red-400 cursor-pointer hover:text-red-600 fa fa-minus-circle'></i>
                                </div>
                            @endif
                            <div class='p-1'>
                                @if($mode!='show')
                                    <i wire:click='setCoordinator({{$teacher['teacher']['id']}})' class="{{ ($teacher['teacher']['coordinator']==1)?'text-purple-500':'text-gray-400' }} cursor-pointer hover:text-purple-500 fa fa-user-tie"></i>
                                @else
                                    <i class="{{ ($teacher['teacher']['coordinator']==1)?'text-purple-500':'text-gray-300' }}  fa fa-user-tie"></i>
                                @endif
                            </div>
                            <div class='p-1'>
                                <a href="{{ route('teachers.show', ['id' => $teacher['teacher']['id']] ) }}" target='_blank'>
                                    <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                </a>
                            </div>
                        </div>
                        <div class='w-full md:w-20'>
                            <div class='w-full flex items-center justify-center'>
                                <img class='w-16 p-2 rounded-full' src='{{ $teacher['teacher']['avatar'] }}' />
                            </div>
                        </div>
                        <div class='w-full md:w-80 font-bold text-gray-500 md:text-left text-center'>
                            {{ $teacher['teacher']['teacher']}}
                        </div>
                        <div class='w-full md:w-80 font-bold text-gray-400 md:text-left text-center'>
                            {{ $teacher['teacher']['degree']}}
                        </div>
                    </div>

                @empty
                    <div class='font-bold text-gray-500'>NO EXISTEN PROFESORES ASIGNADOS A ESTA ASIGNATURA</div>
                @endforelse

                <div class='text-right mt-2 text-sm'>
                    <i class="text-purple-500 fa fa-user-tie "></i> <span class='text-cool-gray-400 font-bold'>COORDINADOR DE LA ASIGNATURA</span>
                </div>

            </div>
        </x-lopsoft.control.tabs-content>
    </x-slot>
</x-lopsoft.control.tabs>
