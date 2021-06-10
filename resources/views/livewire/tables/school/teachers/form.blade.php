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

            @if($mode!='show')

                <div class='mt-2'>
                    <x-lopsoft.link.success target='_blank' link="{{ route('school_subjects.create') }}" icon='fa fa-plus' text='NUEVA' />
                    <x-lopsoft.link.gray @click='$wire.showSubjectsDialog=true' icon='fa fa-search' text='SELECCIONAR' />
                </div>

                <div x-show.transition.opacity.in.duration.500ms='$wire.showSubjectsDialog' class='bg-gray-100 border-cool-gray-300 border rounded-lg mt-2 p-2'>

                    <div class='text-right'>
                        <i @click='$wire.showSubjectsDialog=false' class='fa fa-times text-red-400 cursor-pointer'></i>
                    </div>

                    {{--filters--}}
                    <div class='p-2  border rounded-lg bg-cool-gray-100 border-cool-gray-300'>
                        <x-lopsoft.control.searchinput classcontainer='w-full' class='bg-transparent w-full mb-3' wire:model.debounce.500ms='search' wire:keydown.escape='clearSearch' placeholder="Buscar..."></x-lopsoft.control.input>
                        <x-lopsoft.control.checkbox
                                    id='withoutteacher'
                                    label="MOSTRAR SOLO LAS ASIGNATURAS QUE NO ESTÁN ASIGNADAS"
                                    color='text-gray-600' classlabel='font-bold'
                                    wire:model='withoutteacher'
                                    mode="edit"
                                    />
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
                    </div>

                    {{--xl--}}
                    <div class='mt-4 h-80 md:h-48 overflow-y-auto p-2'>
                        <div >
                            @foreach($subjects as $subject)
                                @if(($withoutteacher && $subject->teachers()->count()==0) || !$withoutteacher)
                                    @if($subjects_list!=null && $subjects_list->where('subject.id', $subject->id)->first()==null)
                                        <div class="overflow-x-auto  hidden md:flex items-center justify-start p-2 hover:bg-cool-gray-200 cursor-pointer rounded-md"
                                            wire:click='selectSubject({{ $subject->id }})'  style='min-width: 1200px'>
                                            <div class='w-full text-right md:text-left md:w-20' >
                                                <i class="fa fa-chalkboard-teacher {{ ($subject->teachers()->count()>0)?'text-green-400':'text-cool-gray-300' }}"></i>

                                                <a href="{{ route('school_subjects.show', ['id' => $subject->id] ) }}" target='_blank'>
                                                    <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                                </a>
                                            </div>
                                            <div class='w-80 font-bold text-gray-600' >
                                                {{ $subject->id.'-'.$subject->code }}
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
                                        <div class='hover:bg-cool-gray-200 cursor-pointer rounded-md md:hidden w-full'>
                                            <div class='flex flex-wrap md:flex-no-wrap items-center justify-start p-2 w-full bg-white shadow-md mb-2 rounded-md hover:bg-cool-gray-100'>
                                                <div class='font-bold text-gray-600 flex items-center justify-end md:justify-start w-full md:w-auto'>
                                                    <div class='mr-2'><i class="fa fa-chalkboard-teacher {{ ($subject->teachers()->count()>0)?'text-green-400':'text-cool-gray-300' }}"></i></div>
                                                    <div class='mr-2'>
                                                        <a href="{{ route('school_subjects.show', ['id' => $subject->id] ) }}" target='_blank'>
                                                            <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class='w-full' wire:click='selectSubject({{ $subject->id }})'
                                                     >
                                                    <div class='font-bold text-gray-600 text-xs text-center'>
                                                        {{ $subject->code }}
                                                    </div>
                                                    <div class='font-bold text-gray-600 text-xs text-center'>
                                                        {{ $subject->subject }}
                                                    </div>
                                                    <div class='font-bold text-gray-400 text-center'>
                                                        {{ $subject->grade->grade }}
                                                    </div>
                                                    <div class='font-bold text-gray-400 text-center'>
                                                        {{ $subject->period->period }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    @endif
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div class='text-right mt-4 font-bold text-sm text-cool-gray-400'>
                        <i class="fa fa-chalkboard-teacher text-green-400"></i> ASIGNADA A ALGÚN PROFESOR
                    </div>

                </div>
            @endif

            <div class='mt-2 pb-4 overflow-y-auto'>
                <div class='hidden md:block overflow-x-auto' style='min-width: 1200px'>
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
                    @forelse($subjects_list as $key=>$subject)
                        <div class="md:flex items-center justify-start p-2 hover:bg-cool-gray-200 cursor-pointer rounded-md">
                            <div class='w-full text-right md:text-left md:w-20' >
                                @if($mode!='show')
                                    <i wire:click='deleteSubject({{$key}})' class='text-red-400 cursor-pointer hover:text-red-600 fa fa-minus-circle'></i>
                                @endif
                                @if($mode!='show')
                                    <i wire:click='setCoordinator({{$subject['subject']['id']}})' class="{{ ($subject['subject']['coordinator']==1)?'text-purple-500':'text-gray-400' }} cursor-pointer hover:text-purple-500 fa fa-user-tie"></i>
                                @else
                                    <i class="{{ ($subject['subject']['coordinator']==1)?'text-purple-500':'text-gray-300' }}  fa fa-user-tie"></i>
                                @endif
                                <a href="{{ route('school_subjects.show', ['id' => $subject['subject']['id']  ]) }}" target='_blank'>
                                    <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                </a>
                            </div>
                            <div class='w-80 font-bold text-gray-600' >
                                {{ $subject['subject']['code'] }}
                            </div>
                            <div class='w-80 font-bold text-gray-600' >
                                {{ $subject['subject']['subject'] }}
                            </div>
                            <div class='w-80 font-bold text-gray-400' >
                                {{ $subject['subject']['grade'] }}
                            </div>
                            <div class='w-80 font-bold text-gray-400' >
                                {{ $subject['subject']['period'] }}
                            </div>
                        </div>
                    @empty
                        <div class='font-bold text-gray-500'>NO EXISTEN ASIGNATURAS ASIGNADAS AL PROFESOR</div>
                    @endforelse
                </div>

                {{--md--}}
                <div class='md:hidden'>
                    @forelse($subjects_list as $key=>$subject)
                        <div class="md:flex items-center justify-start p-2  mb-2
                                    hover:bg-cool-gray-200 cursor-pointer rounded-md
                                    bg-white shadow-md">
                            <div class='w-full text-right md:text-left md:w-8' >
                                <a href="{{ route('school_subjects.show', [ 'id' => $subject['subject']['id'] ]) }}" target='_blank'>
                                    <i class="fa fa-info-circle text-cool-gray-400 hover:text-blue-500"></i>
                                </a>
                                @if($mode!='show')
                                    <i wire:click='setCoordinator({{$subject['subject']['id']}})' class="{{ ($subject['subject']['coordinator']==1)?'text-purple-500':'text-gray-400' }} cursor-pointer hover:text-purple-500 fa fa-user-tie"></i>
                                @else
                                    <i class="{{ ($subject['subject']['coordinator']==1)?'text-purple-500':'text-gray-300' }}  fa fa-user-tie"></i>
                                @endif
                                @if($mode!='show')
                                    <i wire:click='deleteSubject({{$key}})' class='text-red-400 cursor-pointer hover:text-red-600 fa fa-minus-circle'></i>
                                @endif
                            </div>
                            <div class='w-full font-bold text-gray-600 text-center text-xs' >
                                {{ $subject['subject']['code'] }}
                            </div>
                            <div class='w-full font-bold text-gray-600 text-center' >
                                {{ $subject['subject']['subject'] }}
                            </div>
                            <div class='w-full font-bold text-gray-400 text-center' >
                                {{ $subject['subject']['grade'] }}
                            </div>
                            <div class='w-full font-bold text-gray-400 text-center' >
                                {{ $subject['subject']['period'] }}
                            </div>
                        </div>
                    @empty
                        <div class='font-bold text-gray-500'>NO EXISTEN ASIGNATURAS ASIGNADAS AL PROFESOR</div>
                    @endforelse
                </div>
            </div>
            <div class='text-right mt-2 text-sm'>
                <i class="text-purple-500 fa fa-user-tie "></i> <span class='text-cool-gray-400 font-bold'>COORDINADOR DE LA ASIGNATURA</span>
            </div>

    </x-lopsoft.control.tabs-content>
</x-slot>
</x-lopsoft.control.tabs>
