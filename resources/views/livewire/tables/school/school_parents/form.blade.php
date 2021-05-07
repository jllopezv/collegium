    <x-lopsoft.control.inputform
        wire:model.lazy='parent'
        id='parent'
        x-ref='parent'
        label="{{ transup('parent') }}"
        sublabel='Nombre completo del pariente'
        class='w-full'
        autofocus
        classcontainer='w-full'
        requiredfield
        help="{{ transup('mandatory_unique') }}"
        mode="{{ $mode }}"
        nextref='address1'
    />

    <x-lopsoft.control.inputform
        wire:model.lazy='address1'
        id='address1'
        x-ref='address1'
        label="{{ transup('address') }}"
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='address2'
    />
    <x-lopsoft.control.inputform
        wire:model.lazy='address2'
        id='address2'
        x-ref='address2'
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='pbox'
    />

    <div class='flex flex-wrap items-center justify-start w-full md:flex-no-wrap'>
        <div class='pr-2'>
            <x-lopsoft.control.inputform
                wire:model.lazy='pbox'
                id='pbox'
                x-ref='pbox'
                label="{{ transup('pbox') }}"
                autofocus
                classcontainer='w-32'
                mode="{{ $mode }}"
                nextref='city'
            />
        </div>
        <div class='w-full'>
            <x-lopsoft.control.inputform
                wire:model.lazy='city'
                id='city'
                x-ref='city'
                label="{{ transup('city') }}"
                autofocus
                classcontainer='w-full'
                mode="{{ $mode }}"
                nextref='state'
            />
        </div>
    </div>
    <x-lopsoft.control.inputform
        wire:model.lazy='state'
        id='state'
        x-ref='state'
        label="{{ transup('state') }}"
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='username'
    />

    @livewire('controls.drop-down-table-component', [
        'model'         => \App\Models\Aux\Country::class,
        'mode'          =>  $mode,
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
        'mode'  =>  $mode,
        'uid'   =>  'parentsphones',
        'phones'=>  $record==null?null:getPhones($record->phones),
        'model' =>  App\Models\School\ParentPhone::class,
    ])

    @livewire('controls.emails-table-component',[
        'mode'  =>  $mode,
        'uid'   =>  'parentsemails',
        'emails'=>  $record==null?null:getEmails($record->emails),
        'model' =>  App\Models\School\ParentEmail::class,
    ])

    <x-lopsoft.control.tabs minheight='600px'>
        <x-slot name='tabs'>
            <x-lopsoft.control.tabs-index title='USUARIO' index='1'></x-lopsoft.control.tabs-index>
            <x-lopsoft.control.tabs-index title='ESTUDIANTES' index='2'></x-lopsoft.control.tabs-index>
        </x-slot>
        <x-slot name='tabscontent'>
            <x-lopsoft.control.tabs-content index='1'>

                @include('components.lopsoft.auth.userprofile')

            </x-lopsoft.control.tabs-content>
            <x-lopsoft.control.tabs-content index='2'>
                @if(count($students)==0 || count($studentsnotenrolled)==0)
                    <span class='text-red-500 font-bold'>NO TIENE ASIGNADO A NINGÚN ESTUDIANTE</span>
                @endif
                @foreach($students as $student)
                    <a href="{{ route('students.show', ['id' => $student->id ]) }}" target='_blank'>
                        <div class='flex flex-wrap md:flex-no-wrap items-center justify-start mt-2 w-full hover:bg-cool-gray-200 cursor-pointer p-2 rounded-lg'>
                            <div class='flex items-center justify-center w-full md:w-16 '>
                                <div class='text-center'>
                                    <img class='rounded-full w-16' src='{{ $student->avatar }}' />
                                </div>
                            </div>

                            <div class='overflow-x-hidden md:ml-2 flex flex-wrap items-center justify-center md:justify-start  w-full'>
                                <div class='w-80 text-center md:text-left'>
                                    <span class='font-bold'>{{ $student->name }}</span>
                                </div>
                                <div class='w-full text-center md:w-40 md:text-left'>
                                    <span class='font-bold text-gray-500'>{{ $student->grade->grade }}</span>
                                </div>
                                <div class='w-full text-center md:w-40 md:text-left'>
                                    <span class='font-bold text-gray-500'>{{ $student->section }}</span>
                                </div>
                                <div class='w-full text-center md:w-40 md:text-left'>
                                    <span class='font-bold text-gray-500'>{{ $student->modality->modality }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                @foreach($studentsnotenrolled as $student)
                    <a href="{{ route('students.show', ['id' => $student->id ]) }}" target='_blank'>
                        <div class='flex flex-wrap md:flex-no-wrap items-center justify-start mt-2 w-full hover:bg-cool-gray-200 cursor-pointer p-2 rounded-lg'>
                            <div class='flex items-center justify-center w-full md:w-16 '>
                                <div class='text-center'>
                                    <img class='rounded-full w-16' src='{{ $student->avatar }}' />
                                </div>
                            </div>

                            <div class='overflow-x-hidden md:ml-2 flex flex-wrap items-center justify-center md:justify-start  w-full'>
                                <div class='w-80 text-center md:text-left'>
                                    <span class='font-bold'>{{ $student->name }}</span>
                                </div>
                                <div class='text-center  md:text-left'>
                                    <span class='font-bold text-red-500'>NO INSCRITO EN ESTE AÑO ACADÉMICO</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </x-lopsoft.control.tabs-content>
        </x-slot>
    </x-lopsoft.control.tabs>
