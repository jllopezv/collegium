
@if(appsetting('customers_avatar'))
    <div class='flex flex-wrap items-center justify-center'>
        <div class='self-start w-full lg:w-1/4'>
            @include('livewire.partials.modelavatar' , [
                'canmodify' => ($mode=='edit' || $mode=='create')?true:false
                ])
        </div>
    </div>
@endif

<x-lopsoft.control.inputform
    wire:model.lazy='customer'
    id='customer'
    x-ref='customer'
    label="{{ transup('customer') }}"
    sublabel='Nombre completo del cliente'
    class='w-full'
    autofocus
    classcontainer='w-full'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='rnc'
/>

<x-lopsoft.control.inputform
    wire:model.lazy='rnc'
    id='rnc'
    x-ref='rnc'
    label="{{ transup('rnc') }}"
    sublabel='ID del cliente'
    class='w-full'
    autofocus
    classcontainer='w-40'
    requiredfield
    help="{{ transup('unique') }}"
    mode="{{ $mode }}"
    nextref='address1'
/>

<div class='flex flex-wrap items-end justify-start'>
    <div class=''>
        @livewire('controls.drop-down-table-component', [
            'model'         => \App\Models\Crm\CustomerType::class,
            'mode'          => $mode,
            'filterraw'     => '',
            'sortorder'     => 'type',
            'label'         => transup('type'),
            'classdropdown' => 'w-80 mr-2',
            'key'           => 'id',
            'field'         => 'type',
            'defaultvalue'  =>  $record->customer_type_id??null,
            'eventname'     => 'eventsettype',
            'uid'           => 'typecomponent',
            'modelid'       => 'customer_type_id',
            'isTop'         =>  true,
            'requiredfield' =>  true,
            'help'          =>  transup('mandatory'),
            'linknew'       =>  Auth::user()->hasAbility('customer_types.create')?route('customer_types.create'):'',
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
    'uid'   =>  'customersphones',
    'phones'=>  $record==null?null:getPhones($record->phones),
    'model' =>  App\Models\Crm\CustomerPhone::class,
])

@livewire('controls.emails-table-component',[
    'mode'  =>  $mode,
    'uid'   =>  'customersemails',
    'emails'=>  $record==null?null:getEmails($record->emails),
    'model' =>  App\Models\Crm\CustomerEmail::class,
])

<x-lopsoft.control.tabs minheight='600px'>
    <x-slot name='tabs'>
        <x-lopsoft.control.tabs-index title='USUARIO' index='1'></x-lopsoft.control.tabs-index>
        <x-lopsoft.control.tabs-index title='DOCUMENTOS' index='2'></x-lopsoft.control.tabs-index>
        <x-lopsoft.control.tabs-index class="{{ $notes!=''?'text-red-500':'' }}" title='NOTAS' index='3'></x-lopsoft.control.tabs-index>
    </x-slot>
    <x-slot name='tabscontent'>
        <x-lopsoft.control.tabs-content index='1'>
            @include('components.lopsoft.auth.userprofile')
        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='2'>

            @if($mode=='create')
                <div>
                    <span class='font-bold text-red-400'>DEBE CREAR PRIMERO AL EMPLEADO PARA PODER ASIGNARLE DOCUMENTOS</span>
                </div>
            @else
                <div class='mt-4'>
                    @livewire('controls.document-list-component', [

                        'documentable_type' =>  \App\Models\Crm\Customer::class,
                        'documentable_id'   =>  $record->id??null,
                        'mode'              =>  $mode,
                        'table'             =>  'documents',
                        'uuid'              =>  'document-customer',
                        'record'            =>  $record,
                        'documents_root'    =>  $documents_root,
                    ])
                </div>
            @endif
        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='3'>
            <x-lopsoft.control.textareaform
                wire:model.lazy='notes'
                id='notes'
                x-ref='notes'
                label="{{ transup('notes') }}"
                class='w-full'
                autofocus
                classcontainer='w-full'
                mode="{{ $mode }}"
                nextref='btnCreate'
            />
        </x-lopsoft.control.tabs-content>
    </x-slot>
</x-lopsoft.control.tabs>
