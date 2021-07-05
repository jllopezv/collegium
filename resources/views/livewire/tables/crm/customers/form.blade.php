
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
    wire:model.lazy='code'
    id='code'
    ref='code'
    label="{{ transup('code') }}"
    sublabel="Use - para obtener un código automático"
    class='w-full'
    autofocus
    classcontainer='w-32'
    requiredfield
    help="{{ transup('mandatory_unique') }}"
    mode="{{ $mode }}"
    nextref='description'
/>

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

@livewire('controls.drop-down-table-component', [
    'model'         => \App\Models\Crm\CustomerType::class,
    'mode'          => $mode,
    'filterraw'     => '',
    'sortorder'     => 'type',
    'label'         => transup('type'),
    'classdropdown' => 'w-full md:w-3/4 lg:w-2/4 xl:w-1/3',
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
    'template'      => 'components.lopsoft.dropdown.countries',
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
        @if(appsetting('module_school'))
            <x-lopsoft.control.tabs-index title='ESTUDIANTES' index='3'></x-lopsoft.control.tabs-index>
        @endif
        <x-lopsoft.control.tabs-index title='FACTURAS' index='10'></x-lopsoft.control.tabs-index>
        <x-lopsoft.control.tabs-index class="{{ $notes!=''?'text-red-500':'' }}" title='NOTAS' index='30'></x-lopsoft.control.tabs-index>
    </x-slot>
    <x-slot name='tabscontent'>
        <x-lopsoft.control.tabs-content index='1'>
            @include('components.lopsoft.auth.userprofile')
        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='2'>

            @if($mode=='create')
                <div>
                    <span class='font-bold text-red-400'>DEBE CREAR PRIMERO AL CLIENTE PARA PODER ASIGNARLE DOCUMENTOS</span>
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
        @if(appsetting('module_school'))
            <x-lopsoft.control.tabs-content index='3'>
                @forelse($students as $student)
                    <div class='flex-block md:flex flex-wrap md:flex-no-wrap items-center justify-start hover:bg-cool-gray-200 mt-2 p-2 rounded-md cursor-pointer bg-white md:bg-transparent'>
                        <div class='flex items-center justify-end md:justify-start '>
                            <div class="ml-2  {{ $student->isEnrolled()?'text-purple-500':'text-cool-gray-400' }}">
                                <i class='fa fa-graduation-cap'></i>
                            </div>
                            <div class='ml-2 text-cool-gray-400 hover:text-blue-500 cursor-pointer'>
                                <a href='{{ route('students.show', ['id' => $student->id??0 ]) }}' target='_blank' ><i class='fa fa-info-circle'></i></a>
                            </div>
                        </div>
                        <div class='p-2 flex items-center justify-center'>
                            <div class='w-12'>
                                <img src='{{ $student->avatar }}' class='w-12 h-162 rounded-full' />
                            </div>
                        </div>
                        <div class='w-full flex-block md:flex items-center justify-center md:justify-start font-bold text-cool-gray-600'>
                            <div class='w-full md:w-1/2 text-center md:text-left '>
                                {{ $student->name }}
                            </div>@if($student->isEnrolled())
                            <div class="w-full md:w-52 text-center md:text-left  font-bold text-cool-gray-400">
                                {{ $student->grade->grade }}
                            </div>
                            <div class="w-full md:w-52 text-center md:text-left font-bold text-cool-gray-400">
                                {{ $student->section }}
                            </div>
                            @else
                                <div class='w-full md:w-80 font-bold text-red-500 text-center md:text-left'>

                                </div>
                            @endif
                        </div>

                    </div>

                @empty
                    <div>
                        <span class='font-bold text-cool-gray-400'>NO HAY ESTUDIANTES ASIGNADOS AL CLIENTE</span>
                    </div>
                @endforelse
                <div class='text-right mt-2 text-sm'>
                    <i class="text-purple-500 fa fa-graduation-cap "></i> <span class='text-cool-gray-400 font-bold'>INSCRITO EN ESTE AÑO ACADÉMICO</span>
                </div>
            </x-lopsoft.control.tabs-content>
        @endif
        <x-lopsoft.control.tabs-content index='10'>
            <div class='my-4 flex flex-wrap items-center justify-between h-full'>
                <div class='flex items-center justify-start'>
                    <div class=''>
                        <x-lopsoft.link.gray icon='fa fa-sync' wire:click='syncInvoices'/>
                    </div>
                    @if($mode!='create')
                        @hasAbility('invoices.create')
                            <div class='ml-2'>
                                <x-lopsoft.link.success target='_blank' link="{{ route('customers.invoice.create', ['id' => $record->id ]) }}" icon='fa fa-plus' text='NUEVA' />
                            </div>
                        @endhasAbility
                    @endif
                </div>
                <div>
                    @if($mode!='create')
                        <div class='flex items-center justify-end'>
                            <div class='ml-2'>
                                @livewire('controls.drop-down-component', [
                                            'mode'          => 'edit',
                                            'classdropdown' => 'w-40',
                                            'options'       =>  \App\Lopsoft\LopHelp::getInvoicesOrder(),
                                            'defaultvalue'  => 'invoice_date',
                                            'eventname'     => 'eventsetinvoiceorder',
                                            'uid'           => 'invoiceordercomponent',
                                            'modelid'       => 'invoiceorder',
                                            'isTop'         =>  false,
                                        ])

                            </div>
                            <div class='ml-2'>
                                <x-lopsoft.link.gray wire:click='changeInvoiceSortDirection' icon="fa
                                {{  Str::startsWith($invoiceorder,'-')?'fa-sort-amount-up-alt':'fa-sort-amount-down-alt' }}" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @livewire('crm.list-invoices-component', [
                'invoices'      =>  $invoices,
                'uid'           =>  'customerinvoiceslist',
                'sortorder'     =>  '-ref',
            ])
            @forelse($students as $studentitem)
                <div class='mt-8'>
                    <span class='font-bold text-cool-gray-600 text-lg px-2'>{{  $studentitem->exp }} - {{ $studentitem->name }}</span>
                    @livewire('crm.list-invoices-component', [
                        'invoices'      =>  $studentitem->invoices,
                        'uid'           =>  'studentinvoiceslist_'.$studentitem->id,
                        'sortorder'     =>  '-ref',
                    ], key($studentitem->id))
                </div>
            @empty
            @endforelse

            <div class='mt-8 w-full flex flex-wrap items-center justify-end text-sm p-2 bg-cool-gray-300 rounded-md'>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-cool-gray-700'>{!!  $invoices_sum_total_string !!}</span>
                    <span class='font-bold text-blue-400'>
                        <i class='fa fa-dollar-sign'></i>
                    </span>
                </div>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-green-400'>
                        <span class='font-bold text-cool-gray-700'>{!!  $invoices_sum_paid_string !!}</span>
                        <i class='fa fa-hand-holding-usd'></i>
                    </span>
                </div>
                <div class='w-full sm:w-40 text-right'>
                    <span class='font-bold text-red-400'>
                        <span class='font-bold text-cool-gray-700'>{!!  $invoices_sum_pending_string !!}</span>
                        <i class='fa fa-money-check-alt'></i>
                    </span>
                </div>
            </div>

            <div class='flex items-center justify-end text-sm mt-4'>
                <div class='ml-2'>
                    <span class='font-bold text-cool-gray-400'>
                        <i class='fa fa-dollar-sign text-blue-400'></i> {{ transup('total') }}
                    </span>
                </div>
                <div class='ml-2'>
                    <span class='font-bold text-cool-gray-400'>
                        <i class='fa fa-hand-holding-usd text-green-400'></i> {{ transup('paid') }}
                    </span>
                </div>
                <div class='ml-2'>
                    <span class='font-bold text-cool-gray-400'>
                        <i class='fa fa-money-check-alt text-red-400'></i> {{ transup('pending') }}
                    </span>
                </div>
            </div>
        </x-lopsoft.control.tabs-content>
        <x-lopsoft.control.tabs-content index='30'>
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
