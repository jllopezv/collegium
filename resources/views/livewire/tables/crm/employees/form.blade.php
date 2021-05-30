<div class='flex flex-wrap items-center justify-center'>
    <div class='self-start w-full lg:w-1/4'>
        @include('livewire.partials.modelavatar' , [
            'canmodify' => ($mode=='edit' || $mode=='create')?true:false
            ])
    </div>
</div>

<x-lopsoft.control.inputform
    wire:model.lazy='employee'
    id='employee'
    x-ref='employee'
    label="{{ transup('employee') }}"
    sublabel='Nombre completo del empleado'
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='address1'
/>

<div class='flex flex-wrap items-end justify-start'>
    <div class=''>
        @livewire('controls.drop-down-table-component', [
            'model'         => \App\Models\Crm\EmployeeType::class,
            'mode'          => $mode,
            'filterraw'     => '',
            'sortorder'     => 'type',
            'label'         => transup('type'),
            'classdropdown' => 'w-80 mr-2',
            'key'           => 'id',
            'field'         => 'type',
            'defaultvalue'  =>  $record->employee_type_id??null,
            'eventname'     => 'eventsettype',
            'uid'           => 'typecomponent',
            'modelid'       => 'employee_type_id',
            'isTop'         =>  true,
            'requiredfield' =>  true,
            'help'          =>  transup('mandatory'),
            'linknew'       =>  Auth::user()->hasAbility('employee_types.create')?route('employee_types.create'):'',
        ])
    </div>
    <div class='mr-4'>
        @livewire('controls.datepicker',[
            'mode'              => $mode,
            'id'                =>  'hired',
            'modelid'           =>  'hired',
            'label'             =>  transup('hired'),
            'defaultvalue'      =>  getDateString($this->hired),
            'uid'               =>  'hiredcomponent',
            'eventname'         =>  'eventsethired',
        ])
    </div>
</div>

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
    'uid'   =>  'employeesphones',
    'phones'=>  $record==null?null:getPhones($record->phones),
    'model' =>  App\Models\Crm\EmployeePhone::class,
])

@livewire('controls.emails-table-component',[
    'mode'  =>  $mode,
    'uid'   =>  'employeesemails',
    'emails'=>  $record==null?null:getEmails($record->emails),
    'model' =>  App\Models\Crm\EmployeeEmail::class,
])

<x-lopsoft.control.tabs minheight='600px'>
    <x-slot name='tabs'>
        <x-lopsoft.control.tabs-index title='USUARIO' index='1'></x-lopsoft.control.tabs-index>
        <x-lopsoft.control.tabs-index title='DATOS' index='2'></x-lopsoft.control.tabs-index>
        <x-lopsoft.control.tabs-index title='DOCUMENTOS' index='3'></x-lopsoft.control.tabs-index>
    </x-slot>
    <x-slot name='tabscontent'>
        <x-lopsoft.control.tabs-content index='1'>
            @include('components.lopsoft.auth.userprofile')
        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='2'>

            <div class='flex flex-wrap items-end justify-start'>
                <div class='mr-4'>
                @livewire('controls.datepicker',[
                    'mode'              => $mode,
                    'id'                =>  'birth',
                    'modelid'           =>  'birth',
                    'label'             =>  transup('birth'),
                    'defaultvalue'      =>  getDateString($this->birth),
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
            <div class='w-full'>
                <x-lopsoft.control.inputform
                    wire:model.lazy='degree'
                    id='degree'
                    x-ref='degree'
                    label="{{ transup('degree') }}"
                    autofocus
                    classcontainer='w-full'
                    mode="{{ $mode }}"
                    nextref='salary'
                />
            </div>
            <div class='w-full'>
                <x-lopsoft.control.inputform
                    wire:model.lazy='salary'
                    id='salary'
                    x-ref='salary'
                    label="{{ transup('salary') }}"
                    autofocus
                    class='text-right'
                    classcontainer='w-80'
                    mode="{{ $mode }}"
                    nextref='employee'
                    sufix='RD$'
                />
            </div>

        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='3'>

            @if($mode=='create')
                <div>
                    <span class='font-bold text-red-400'>DEBE CREAR PRIMERO AL EMPLEADO PARA PODER ASIGNARLE DOCUMENTOS</span>
                </div>
            @else
                <div class='mt-4'>
                    @livewire('controls.document-list-component', [

                        'documentable_type' =>  \App\Models\Crm\Employee::class,
                        'documentable_id'   =>  $record->id??null,
                        'mode'              =>  $mode,
                        'table'             =>  'documents',
                        'uuid'              =>  'document-employees',
                        'record'            =>  $record,
                        'documents_root'    =>  $documents_root,
                    ])
                </div>
            @endif
        </x-lopsoft.control.tabs-content>
    </x-slot>
</x-lopsoft.control.tabs>
