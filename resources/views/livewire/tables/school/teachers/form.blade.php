<x-lopsoft.control.inputform
wire:model.lazy='teacher'
id='teacher'
x-ref='teacher'
label="{{ transup('teacher') }}"
sublabel='Nombre que le aparecerá a los estudiantes'
class='w-full'
autofocus
classcontainer='w-full'
requiredfield
help="{{ transup('mandatory_unique') }}"
mode="{{ $mode }}"
nextref='btnCreate'
/>

<div class='w-full'>
    @livewire('controls.drop-down-table-component', [
        'model'         => \App\Models\Crm\Employee::class,
        'mode'          => $mode,
        'filterraw'     => '',
        'sortorder'     => 'employee',
        'label'         => transup('employee'),
        'classdropdown' => 'w-full mr-2',
        'key'           => 'id',
        'field'         => 'employee',
        'defaultvalue'  =>  $record->employee_id??null,
        'eventname'     => 'eventsetemployee',
        'uid'           => 'employeecomponent',
        'modelid'       => 'employee_id',
        'isTop'         =>  true,
        'requiredfield' =>  true,
        'help'          =>  transup('mandatory'),
        'linknew'       =>  Auth::user()->hasAbility('employees.create')?route('employees.create'):'',
        'template'      => 'components.lopsoft.dropdown.employees',
    ])
</div>

<x-lopsoft.control.tabs minheight='600px'>
<x-slot name='tabs'>
    <x-lopsoft.control.tabs-index title='USUARIO' index='1'></x-lopsoft.control.tabs-index>
    <x-lopsoft.control.tabs-index title='ASIGNATURAS' index='2'></x-lopsoft.control.tabs-index>
</x-slot>
<x-slot name='tabscontent'>
    <x-lopsoft.control.tabs-content index='1'>
        @include('components.lopsoft.auth.userprofile', ['emaildropdown' => false])
    </x-lopsoft.control.tabs-content>
    <x-lopsoft.control.tabs-content index='2'>
        @if($mode!='create')
            @if($mode!='show')
                <div class='mt-4 font-bold'>SELECCIONAR ASIGNATURAS QUE IMPARTIRÁ EL PROFESOR</div>
                <div class='flex flex-wrap items-center justify-start'>

                    <div class='flex flex-wrap items-center justify-start w-full'>

                        <div class='w-full pr-2 md:w-1/3'>
                            @livewire('controls.index-filter-component', [
                                'mode'          => $mode,
                                'label'         => transup('level'),
                                'classdropdown' => 'w-full',
                                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolLevels(), 'id', 'level', '', true, 'priority'),
                                'defaultvalue'  => '*',
                                'eventname'     => 'eventsubjectfilterlevel',
                                'uid'           => 'subjectfilterlevelcomponent',
                                'modelid'       => 'level_id',
                                'isTop'         =>  false,
                            ])
                        </div>

                        <div class='w-full pr-2 md:w-1/3'>

                            @livewire('controls.index-filter-component', [
                                'mode'          => $mode,
                                'label'         => transup('grade'),
                                'classdropdown' => 'w-full',
                                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolGrades(), 'id', 'grade', '', true, 'priority'),
                                'defaultvalue'  => '*',
                                'eventname'     => 'eventsubjectfiltergrade',
                                'uid'           => 'subjectfiltergradecomponent',
                                'modelid'       => 'grade_id',
                                'isTop'         =>  false,
                            ])
                        </div>

                        <div class='w-full pr-2 md:w-1/3'>

                            @livewire('controls.index-filter-component', [
                                'mode'          => $mode,
                                'label'         => transup('period'),
                                'classdropdown' => 'w-full',
                                'options'       => \App\Lopsoft\LopHelp::getFilterDropdownBuilder(getUserAnnoSession()->schoolPeriods(), 'id', 'period', '', true, 'priority'),
                                'defaultvalue'  => '*',
                                'eventname'     => 'eventsubjectfilterperiod',
                                'uid'           => 'subjectfilterperiodcomponent',
                                'modelid'       => 'period_id',
                                'isTop'         =>  false,
                            ])
                        </div>
                    </div>
                </div>

                <div class='mt-4 h-48 overflow-y-auto bg-gray-100 border-cool-gray-300 border rounded-lg p-2'>
                    <div class='overflow-x-auto' style='min-width: 1000px'>
                    @foreach($subjects as $subject)
                        @if($subjects_id_selected!=null && !$subjects_id_selected->contains($subject->id))
                            <div class="hidden md:flex items-center justify-start p-2 hover:bg-cool-gray-200 cursor-pointer rounded-md"
                                wire:click='selectSubject({{ $subject->id }})'>
                                <div class='w-full text-right md:text-left md:w-20' >
                                    <i class="fa fa-chalkboard-teacher {{ ($subject->teachers()->count()>0)?'text-green-400':'text-cool-gray-300' }}"></i>

                                    <a href="{{ route('school_subjects.show', ['id' => $subject->id] ) }}" target='_blank'>
                                        <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                    </a>
                                </div>
                                <div class='w-80 font-bold text-gray-600' >
                                    {{ $subject->code }}
                                </div>
                                <div class='w-80 font-bold text-gray-600' >
                                    {{ $subject->subject }}
                                </div>
                                <div class='w-80 font-bold text-gray-400' >
                                    {{ $subject->grade->grade }}
                                </div>
                                <div class='w-80 font-bold text-gray-400' >
                                    {{ $subject->period->period }}
                                </div>
                            </div>

                            {{--md--}}
                            <div class='hover:bg-cool-gray-200 cursor-pointer rounded-md md:hidden'>
                                <div class='flex items-center justify-start p-2'>
                                    <div class='font-bold text-gray-600 flex items-center justify-start'>
                                        <div class='w-full mr-2'><i class="fa fa-chalkboard-teacher {{ ($subject->teachers()->count()>0)?'text-green-400':'text-cool-gray-300' }}"></i></div>
                                        <div class='w-full mr-2'>
                                            <a href="{{ route('school_subjects.show', ['id' => $subject->id] ) }}" target='_blank'>
                                                <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class='w-80 font-bold text-gray-600'   wire:click='selectSubject({{ $subject->id }})'>
                                        {{ $subject->subject }}
                                        <div class='font-bold text-gray-400'>
                                            {{ $subject->grade->grade }}
                                        </div>
                                        <div class='font-bold text-gray-400'>
                                            {{ $subject->period->period }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            @endif

            <div class='mt-2 font-bold'>ASIGNATURAS QUE IMPARTE EL PROFESOR</div>

            <div class='mt-2 pb-4 overflow-y-auto'>
                <div class='hidden md:block overflow-x-auto' style='min-width: 1000px'>
                    <div class="hidden md:flex items-center justify-start p-2 mb-2 font-bold text-green-300 bg-gray-700">
                        <div class='w-16' >

                        </div>
                        <div class='w-80' >
                            {{ transup('code') }}
                        </div>
                        <div class='w-80' >
                            {{ transup('schoolsubject') }}
                        </div>
                        <div class='w-80' >
                            {{ transup('grade') }}
                        </div>
                        <div class='w-80' >
                            {{ transup('period') }}
                        </div>
                    </div>
                    @if(count($subjects_selected)==0)
                        <div class='my-4 font-bold text-red-500 p-2'>NO HAY ASIGNATURAS ASOCIADAS AL PROFESOR</div>
                    @endif
                    @foreach($subjects_selected as $key=>$subject)
                        <div class="md:flex items-center justify-start p-2 hover:bg-cool-gray-200 cursor-pointer rounded-md">
                            <div class='w-full text-right md:text-left md:w-16' >
                                <i wire:click='deleteSubject({{$key}})' class='text-red-400 cursor-pointer hover:text-red-600 fa fa-minus-circle'></i>
                                <a href="{{ route('school_subjects.show', ['id' => $subject->id] ) }}" target='_blank'>
                                    <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                </a>
                            </div>
                            <div class='w-80 font-bold text-gray-600' >
                                {{ $subject->code }}
                            </div>
                            <div class='w-80 font-bold text-gray-600' >
                                {{ $subject->subject }}
                            </div>
                            <div class='w-80 font-bold text-gray-400' >
                                {{ $subject->grade->grade }}
                            </div>
                            <div class='w-80 font-bold text-gray-400' >
                                {{ $subject->period->period }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{--md--}}
                <div class='md:hidden'>
                    @if(count($subjects_selected)==0)
                        <div class='my-4 font-bold text-red-500 p-2'>NO HAY ASIGNATURAS ASOCIADAS AL PROFESOR</div>
                    @endif
                    @foreach($subjects_selected as $key=>$subject)
                        <div class="md:flex items-center justify-start p-2  mb-2
                                    hover:bg-cool-gray-200 cursor-pointer rounded-md
                                    bg-white shadow-md">
                            <div class='w-full text-right md:text-left md:w-8' >
                                <a href="{{ route('school_subjects.show', ['id' => $subject->id] ) }}" target='_blank'>
                                    <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                </a>
                                <i wire:click='deleteSubject({{$key}})' class='text-red-400 cursor-pointer hover:text-red-600 fa fa-minus-circle'></i>
                            </div>
                            <div class='w-full font-bold text-gray-600 text-center text-xs' >
                                {{ $subject->code }}
                            </div>
                            <div class='w-full font-bold text-gray-600 text-center' >
                                {{ $subject->subject }}
                            </div>
                            <div class='w-full font-bold text-gray-400 text-center' >
                                {{ $subject->grade->grade }}
                            </div>
                            <div class='w-full font-bold text-gray-400 text-center' >
                                {{ $subject->period->period }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class='text-red-500 font-bold'>DEBE CREAR EL PROFESOR ANTES DE PODER ASIGNARLE ASIGNATURAS</div>
        @endif
    </x-lopsoft.control.tabs-content>
</x-slot>
</x-lopsoft.control.tabs>
