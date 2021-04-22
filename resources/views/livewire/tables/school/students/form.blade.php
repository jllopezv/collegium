<div class='flex flex-wrap items-center justify-center'>
    <div class='self-start w-full lg:w-1/4'>
        @include('livewire.partials.studentsavatar' , [
            'canmodify' => ($mode=='edit' || $mode=='create')?true:false
            ])
    </div>
    <div class='w-full lg:w-2/3'>
        <x-lopsoft.control.inputform
            wire:model.lazy='exp'
            id='exp'
            x-ref='exp'
            label="{{ transup('exp') }}"
            sublabel='Use un guión (-) para generar un expediente automáticamente.'
            class='w-32'
            autofocus
            classcontainer='w-full sm:w-32'
            requiredfield
            help="{{ transup('mandatory_unique') }}"
            nextref='names'
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='names'
            id='names'
            x-ref='names'
            label="{{ transup('names') }}"
            nextref='first_surname'
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='first_surname'
            id='first_surname'
            x-ref='first_surname'
            label="{{ transup('first_surname') }}"
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory') }}"
            nextref='second_surname'
            mode="{{ $mode }}"
        />
        <x-lopsoft.control.inputform
            wire:model.lazy='second_surname'
            id='second_surname'
            x-ref='second_surname'
            label="{{ transup('second_surname') }}"
            classcontainer='w-full'
            requiredfield
            help="{{ transup('mandatory') }}"
            nextref='priority'
            mode="{{ $mode }}"
        />
        <div class='flex flex-wrap items-center justify-start'>
            <div class='mr-4'>
                @livewire('controls.drop-down-component', [
                            'mode'          => $mode,
                            'label'         => transup('gender'),
                            'classdropdown' => 'w-40',
                            'options'       => \App\Lopsoft\LopHelp::getSexDropDown(),
                            'defaultvalue'  => 'M',
                            'eventname'     => 'eventsetgender',
                            'uid'           => 'gendercomponent',
                            'modelid'       => 'gender',
                            'template'      => 'components.lopsoft.dropdown.sex',
                            'isTop'         =>  true,
                        ])
            </div>
            <div class='flex flex-wrap items-end justify-start'>
                <div class='mr-4'>
                @livewire('controls.datepicker',[
                    'mode'              => $mode,
                    'id'                =>  'birth',
                    'modelid'           =>  'birth',
                    'label'             =>  transup('birth'),
                    'defaultvalue'      =>  getDateString(getDateFromDate(2000,1,1)),
                    'uid'               =>  'birthcomponent',
                    'eventname'         =>  'eventsetbirth',
                ])
                </div>
                <div class=''>
                    <x-lopsoft.control.textform
                    id='age'
                    x-ref='age'
                    label="{{ transup('age') }}"
                    classcontainer='w-32'>
                        {{ $age }}
                    </x-lopsoft.control.textform>
                </div>
            </div>
        </div>

        <x-lopsoft.control.inputform
            wire:model.lazy='priority'
            id='priority'
            x-ref='priority'
            label="{{ transup('priority') }}"
            sublabel='Orden dentro del grado en el que se mostrará cuando vaya a elegir el estudiante en otro formulario'
            classcontainer='w-24'
            requiredfield
            help="{{ transup('mandatory') }}"
            mode="{{ $mode }}"
        />

        <div class='flex flex-wrap items-center justify-start'>

            <div class='w-full pr-2 md:w-2/4 lg:w-2/4 xl:w-1/4'>
                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\School\SchoolGrade::class,
                    'mode'          => $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'priority',
                    'label'         => transup('grade'),
                    'classdropdown' => '',
                    'key'           => 'id',
                    'field'         => 'grade',
                    'defaultvalue'  =>  ($this->mode=='create')?null:$record->pivot->grade_id,
                    'eventname'     => 'eventsetgrade',
                    'uid'           => 'gradecomponent',
                    'modelid'       => 'grade_id',
                    'isTop'         =>  true,
                    'requiredfield' =>  true,
                    'help'          =>  transup('mandatory'),
                    'linknew'       =>  Auth::user()->hasAbility('school_grades.create')?route('school_grades.create'):'',
                ])
            </div>

            <div class='w-full pr-2 md:w-2/4 lg:w-2/4 xl:w-1/4'>
                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\School\SchoolSection::class,
                    'mode'          => $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'priority',
                    'label'         => transup('section'),
                    'classdropdown' => '',
                    'key'           => 'id',
                    'field'         => 'section',
                    'defaultvalue'  => ($this->mode=='create')?null:$record->pivot->section_id,
                    'eventname'     => 'eventsetsection',
                    'uid'           => 'sectioncomponent',
                    'modelid'       => 'section_id',
                    'isTop'         =>  true,
                    'requiredfield' =>  true,
                    'help'          =>  transup('mandatory'),
                    'linknew'       =>  Auth::user()->hasAbility('school_sections.create')?route('school_sections.create'):'',
                ])
            </div>

            <div class='w-full pr-2 md:w-2/4 lg:w-2/4 xl:w-1/4'>
                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\School\SchoolBatch::class,
                    'mode'          => $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'priority',
                    'label'         => transup('batch'),
                    'classdropdown' => '',
                    'key'           => 'id',
                    'field'         => 'batch',
                    'defaultvalue'  => ($this->mode=='create')?null:$record->pivot->batch_id,
                    'eventname'     => 'eventsetbatch',
                    'uid'           => 'batchcomponent',
                    'modelid'       => 'batch_id',
                    'isTop'         =>  true,
                    'requiredfield' =>  true,
                    'help'          =>  transup('mandatory'),
                    'linknew'       =>  Auth::user()->hasAbility('school_batches.create')?route('school_batches.create'):'',
                ])
            </div>

            <div class='w-full pr-2 md:w-2/4 lg:w-2/4 xl:w-1/4'>
                @livewire('controls.drop-down-table-component', [
                    'model'         => \App\Models\School\SchoolModality::class,
                    'mode'          => $mode,
                    'filterraw'     => '',
                    'sortorder'     => 'priority',
                    'label'         => transup('modality'),
                    'classdropdown' => '',
                    'key'           => 'id',
                    'field'         => 'modality',
                    'defaultvalue'  =>  ($this->mode=='create')?null:$record->pivot->modality_id,
                    'eventname'     => 'eventsetmodality',
                    'uid'           => 'modalitycomponent',
                    'modelid'       => 'modality_id',
                    'isTop'         =>  true,
                    'requiredfield' =>  true,
                    'help'          =>  transup('mandatory'),
                    'linknew'       =>  Auth::user()->hasAbility('school_modalities.create')?route('school_modalities.create'):'',
                ])
            </div>

        </div>



    </div>

</div>

<x-lopsoft.control.tabs minheight='600px'>
    <x-slot name='tabs'>
        <x-lopsoft.control.tabs-index title='USER' index='1'></x-lopsoft.control.tabs-index>
        <x-lopsoft.control.tabs-index title='PARIENTES' index='2'></x-lopsoft.control.tabs-index>
    </x-slot>
    <x-slot name='tabscontent'>
        <x-lopsoft.control.tabs-content index='1'>
            <div class='flex flex-wrap items-center justify-start md:flex-no-wrap'>
                <div class='w-full md:w-3/4 lg:w-3/4 xl:w-1/2'>
                    <x-lopsoft.control.inputform
                        wire:model.lazy='email'
                        id='email'
                        x-ref="refemail"
                        label="
                        <div class='flex items-center justify-start'>
                            <div class=''>
                                {{ transup('email') }}
                            </div>
                            <div x-show='$wire.checkedEmail' x-cloak class='ml-2 text-xs'>
                                <div x-show='$wire.validEmail' class='font-bold text-green-500'>EL EMAIL NO EXISTE. PUEDE UTILIZARSE.</div>
                                <div x-show='$wire.validEmail==false' class='font-bold text-red-500'>EL EMAIL YA EXISTE.</div>
                            </div>
                        </div>
                        "
                        sublabel="Email para crear el usuario asociado al estudiante"
                        classcontainer='w-full'
                        requiredfield
                        help="{{ transup('mandatory') }}"
                        nextref='username'
                        mode="{{ $mode }}"
                    />

                </div>
                @if($mode!='show')
                    <div class='ml-2 tooltip'>
                        <x-lopsoft.button.gray wire:click='generateEmail'  text='GENERAR EMAIL' icon='fa fa-cogs'></x-lopsoft.button.gray>
                        <span class='md:hidden tooltiptext tooltiptext-center-right'>GENERAR EMAIL</span>
                    </div>
                @endif
            </div>
            <x-lopsoft.control.inputform
                wire:model.lazy='username'
                id='username'
                x-ref='username'
                label="{{ transup('username') }}"
                sublabel="Nombre de usuario para que el estudiante accese a la plataforma"
                classcontainer='w-60'
                requiredfield
                help="{{ transup('mandatory') }}"
                mode="{{ $mode }}"
            />
        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='2'>
            @if($this->mode=='edit')
                <div class='mt-4'>
                    <div class=''>
                        <x-lopsoft.link.success target='_blank' link="{{ route('school_parents.create') }}" icon='fa fa-plus' text='NUEVO' />
                        @if(!$showParents && !$selectedParent)
                            <x-lopsoft.link.success wire:click='showParentsDialog' icon='fa fa-search' text='SELECCIONAR' />
                        @endif
                    </div>
                    @if($showParents)
                    <div class='px-2 mt-2 border rounded-lg bg-cool-gray-100 border-cool-gray-300'>
                        @livewire('search.search-school-parents-component', [
                            'uid'   =>  'searchschoolparentcomponent'
                        ])
                    </div>
                    @endif
                    @if($selectedParent)
                        <div class='p-2 mt-2 border rounded-lg bg-cool-gray-100 border-cool-gray-300'>
                            <div class=''>
                                <div class=''>
                                    <x-lopsoft.control.inputform
                                    label="{{ transup('parent') }}"
                                    class='bg-transparent'
                                    classcontainer='w-full'
                                    mode='show'
                                    value="{{ $schoolparent->parent??'' }}"
                                    ></x-lopsoft.control.inputform>
                                </div>
                                <div class=''>
                                    <x-lopsoft.control.inputform
                                    wire:model.lazy='relationship'
                                    id='relationship'
                                    x-ref="relationship"
                                    label="{{ transup('relationship') }}"
                                    sublabel='Ej. PADRE / MADRE / TUTOR / TIO / TIA / ...'
                                    class='bg-transparent'
                                    classcontainer='w-80'
                                    ></x-lopsoft.control.inputform>
                                </div>
                            </div>
                            <div class='text-right'>
                                <x-lopsoft.button.gray wire:click='assignParent' text='ASIGNAR' icon='fa fa-check'></x-lopsoft.button.gray>
                                <x-lopsoft.button.danger wire:click='cancelAssign' text='CANCELAR' icon='fa fa-times'></x-lopsoft.button.danger>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                @if ($this->mode=='create')
                    <div>
                        <span class='font-bold text-red-400'>DEBE CREAR PRIMERO EL ESTUDIANTE PARA PODER ASIGNAR A LOS PARIENTES</span>
                    </div>
                @else
                    <div class='flex items-start justify-start mt-2 ' style='min-height:500px;'>
                        <div class='w-1/2 pr-2'>
                            @forelse($record->parents as $parent)
                                <div
                                wire:click='selectInfoParent({{$parent->id}})'
                                class='flex items-center justify-start p-2 rounded-md cursor-pointer hover:bg-cool-gray-200'>
                                    <div class='w-80'>
                                        {{ $parent->parent }}
                                    </div>
                                    <div class=''>
                                        <span class='text-gray-500'>{{ $parent->pivot->relationship }}</span>
                                    </div>
                                </div>
                            @empty
                                <span class='font-bold text-gray-500'>NO HAY PARENSTESCOS DEFINIDOS</span>
                            @endforelse
                        </div>
                        @if(count($infoParentArray)>0)
                            <div class='w-1/2 pl-2 border-l-2 border-gray-300' style='min-height: 500px'>
                                <div class='p-2 bg-yellow-100'>
                                    <div class='mt-2 text-xl font-bold'>
                                        <div class='flex items-center justify-between '>
                                            <div class=''>
                                                {{  count($infoParentArray)>0?$infoParentArray['parent']:'' }}
                                            </div>
                                            <div class='bg-blue-500 text-white py-0.5 px-1 text-xs rounded font-bold'>
                                                @isSuperadmin
                                                    ID {{ $infoParent->id??'' }}
                                                @endisSuperadmin
                                            </div>
                                        </div>
                                    </div>
                                    <div class='border-b border-cool-gray-300'>
                                        {{ count($infoParentArray)>0?$infoParentArray['pivot']['relationship']:'' }}
                                    </div>
                                </div>
                                <div class='mt-4'>
                                    <x-lopsoft.control.inputform
                                        wire:model.lazy='infoParentArray.address1'
                                        id='address1'
                                        x-ref='address1'
                                        label="{{ transup('address') }}"
                                        autofocus
                                        classcontainer='w-full'
                                        mode="show"
                                    />
                                    <x-lopsoft.control.inputform
                                        wire:model.lazy='infoParentArray.address2'
                                        id='address2'
                                        x-ref='address2'
                                        autofocus
                                        classcontainer='w-full'
                                        mode="show"
                                    />
                                </div>
                                <div class='flex flex-wrap items-center justify-start w-full mt-2 md:flex-no-wrap'>
                                    <div class='pr-2'>
                                        <x-lopsoft.control.inputform
                                            wire:model.lazy='infoParentArray.pbox'
                                            id='pbox'
                                            x-ref='pbox'
                                            label="{{ transup('pbox') }}"
                                            autofocus
                                            classcontainer='w-32'
                                            mode="show"
                                        />
                                    </div>
                                    <div class='w-full'>
                                        <x-lopsoft.control.inputform
                                            wire:model.lazy='infoParentArray.city'
                                            id='city'
                                            x-ref='city'
                                            label="{{ transup('city') }}"
                                            autofocus
                                            classcontainer='w-full'
                                            mode="show"
                                        />
                                    </div>
                                </div>
                                <x-lopsoft.control.inputform
                                    wire:model.lazy='infoParentArray.state'
                                    id='state'
                                    x-ref='state'
                                    label="{{ transup('state') }}"
                                    autofocus
                                    classcontainer='w-full'
                                    mode="show"
                                    nextref='username'
                                />
                                @livewire('controls.drop-down-table-component', [
                                    'model'         => \App\Models\Aux\Country::class,
                                    'mode'          => 'show',
                                    'filterraw'     => '',
                                    'sortorder'     => 'country',
                                    'label'         => transup('country'),
                                    'classdropdown' => 'w-full md:w-3/4 lg:w-2/4 xl:w-1/3',
                                    'key'           => 'id',
                                    'field'         => 'country',
                                    'defaultvalue'  =>  $record->country_id??( (\App\Models\Aux\Country::where('country',config('lopsoft.country_default'))->first())->id??null),
                                    'eventname'     => 'eventsetcountry',
                                    'uid'           => 'countrycomponent',
                                    'modelid'       => 'countries',
                                    'isTop'         =>  true,
                                    'template' => 'components.lopsoft.dropdown.countries',
                                ])

                                @livewire('controls.phones-table-component',[
                                    'mode'  =>  'show',
                                    'uid'   =>  'parentsphones',
                                    'phones'=>  $infoParent==null?null:getPhones($infoParent->phones),
                                ])

                                @livewire('controls.emails-table-component',[
                                    'mode'  =>  'show',
                                    'uid'   =>  'parentsemails',
                                    'emails'=>  $infoParent==null?null:getEmails($infoParent->emails),
                                ])
                            </div>
                        @endif
                    </div>
                @endif
            @endif
        </x-lopsoft.control.tabs-content>
    </x-slot>
</x-lopsoft.control.tabs>

@livewire('messages.flash-message', ['msgid' => 'studentsaved'] )
