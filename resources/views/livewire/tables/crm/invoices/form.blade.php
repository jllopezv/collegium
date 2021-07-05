<div class='relative'>
    <div class='absolute top-0 right-0'>
        {!!  $record==null?'':$record->status('text-base') !!}
    </div>
    <x-lopsoft.control.inputform
        wire:model.lazy='ref'
        id='ref'
        ref='ref'
        label="{{ transup('ref') }}"
        sublabel="Use - para obtener un código automático"
        class='w-full'
        autofocus
        classcontainer='w-32'
        requiredfield
        help="{{ transup('mandatory_unique') }}"
        mode="{{  $mode=='create'?'create':'show' }}"
        nextref='description'
    />

    <x-lopsoft.control.inputform
        wire:model.lazy='description'
        id='description'
        ref='description'
        label="{{ transup('description') }}"
        class='w-full'
        autofocus
        classcontainer='w-full'
        mode="{{ $mode }}"
        nextref='invoiceline_code_0'
    />
    <div class='flex flex-wrap sm:flex-no-wrap items-center justify-start w-full'>
        <div class='w-full sm:w-auto mr-4'>
            @livewire('controls.datepicker',[
                'mode'              => $mode,
                'id'                =>  'invoice_date',
                'modelid'           =>  'invoice_date',
                'label'             =>  transup('date'),
                'defaultvalue'      =>  getDateString($this->invoice_date),
                'uid'               =>  'invoicedatecomponent',
                'eventname'         =>  'eventsetinvoicedate',
            ])
        </div>
        <div class='w-full sm:w-auto mr-4'>
            @livewire('controls.datepicker',[
                'mode'              => $mode,
                'id'                =>  'invoice_due',
                'modelid'           =>  'invoice_due',
                'label'             =>  transup('due'),
                'defaultvalue'      =>  getDateString($this->invoice_due),
                'uid'               =>  'invoiceduecomponent',
                'eventname'         =>  'eventsetinvoicedue',
            ])
        </div>
    </div>
    @if(!$hideselectsource)
        <x-lopsoft.control.radio-inline
            label='SELECCIONAR TIPO DE FACTURA'
            model='invoice_source'
            color='text-gray-600'
            classlabel='font-bold mt-4'
            wire:click='checkSource'
            :options="\App\Lopsoft\LopHelp::getInvoicesSource()"
        />
        @if($this->mode!='show' && $invoice_source=='customers' && $showCustomersSearch)
            <div class='mt-4'>
                <div class=''>
                    <x-lopsoft.link.success target='_blank' link="{{ route('customers.create') }}" icon='fa fa-plus' text='NUEVO' />
                    @if(!$showCustomers)
                        <x-lopsoft.link.gray wire:click='showCustomersDialog' icon='fa fa-search' text='SELECCIONAR' />
                    @endif
                </div>
                <div class='px-2 mt-2 border rounded-lg bg-gray-100 border-cool-gray-300'>
                    @livewire('search.search-customers-component', [
                        'uid'           =>  'searchcustomerscomponent',
                        'showdialog'    =>  $showCustomers,
                    ])
                </div>
            </div>
        @endif
        @if($this->mode!='show'&& $invoice_source=='suppliers'  && $showSuppliersSearch)
            <div class='mt-4'>
                <div class=''>
                    <x-lopsoft.link.success target='_blank' link="{{ route('suppliers.create') }}" icon='fa fa-plus' text='NUEVO' />
                    @if(!$showSuppliers)
                        <x-lopsoft.link.gray wire:click='showSuppliersDialog' icon='fa fa-search' text='SELECCIONAR' />
                    @endif
                </div>
                <div class='px-2 mt-2 border rounded-lg bg-gray-100 border-cool-gray-300'>
                    @livewire('search.search-suppliers-component', [
                        'uid'           =>  'searchsupplierscomponent',
                        'showdialog'    =>  $showSuppliers,
                    ])
                </div>
            </div>
        @endif
        @if($this->mode!='show'&& $invoice_source=='students'  && $showStudentsSearch)
            <div class='mt-4'>
                <div class=''>
                    <x-lopsoft.link.success target='_blank' link="{{ route('students.create') }}" icon='fa fa-plus' text='NUEVO' />
                    @if(!$showSuppliers)
                        <x-lopsoft.link.gray wire:click='showStudentsDialog' icon='fa fa-search' text='SELECCIONAR' />
                    @endif
                </div>
                <div class='px-2 mt-2 border rounded-lg bg-gray-100 border-cool-gray-300'>
                    @livewire('search.search-students-component', [
                        'uid'           =>  'searchstudentscomponent',
                        'showdialog'    =>  $showStudents,
                    ])
                </div>
            </div>
        @endif
    @endif

    <div class='p-2 border rounded-lg bg-gray-100 border-cool-gray-300 mt-4'>
        {{-- Source Data --}}
        <div class='relative pb-4'>
            <div class='absolute bottom-0 right-0' >
                @if(!$showSourceData)
                    <span class='text-gray-400 hover:text-gray-600 cursor-pointer ' wire:click='showSourceDataInfo'><i  class='fa fa-angle-down'></i> Mostrar Datos</span>
                @endif
                @if($showSourceData)
                    <span class='text-gray-400 hover:text-gray-600 cursor-pointer ' wire:click='hideSourceDataInfo' ><i class='fa fa-angle-up'></i> Ocultar Datos</span>
                @endif
            </div>
            @if($invoice_source=='students')
                <div class='flex flex-wrap items-center justify-start'>
                    <div class='w-full sm:w-1/4 md:w-40 pr-2'>
                        <x-lopsoft.control.inputform
                                wire:model.lazy='student.exp'
                                id='exp'
                                ref='exp'
                                label="{{ transup('exp') }}"
                                class='w-full'
                                autofocus
                                classcontainer='w-full'
                                mode="{{ $mode }}"
                                nextref='name'
                            />
                    </div>
                    <div class='w-full sm:w-3/4'>
                        <x-lopsoft.control.inputform
                            wire:model.lazy='student.name'
                            id='name'
                            ref='name'
                            label="{{ transup('student') }}"
                            class='w-full'
                            autofocus
                            classcontainer='w-full'
                            mode="{{ $mode }}"
                            nextref='rnc'
                        />
                    </div>
                </div>
            @endif
            <div class='flex flex-wrap items-center justify-start'>
                <div class='w-full sm:w-3/4 pr-2'>
                    @if($invoice_source=='customers' || $invoice_source=='students')
                        <x-lopsoft.control.inputform
                            wire:model.lazy='invoiceowner.customer'
                            id='customer'
                            ref='customer'
                            label="{{ transup('customer') }}"
                            class='w-full'
                            autofocus
                            classcontainer='w-full'
                            mode="{{ $mode }}"
                            nextref='rnc'
                        />
                    @else
                        <x-lopsoft.control.inputform
                            wire:model.lazy='invoiceowner.supplier'
                            id='supplier'
                            ref='supplier'
                            label="{{ transup('supplier') }}"
                            class='w-full'
                            autofocus
                            classcontainer='w-full'
                            mode="{{ $mode }}"
                            nextref='rnc'
                        />
                    @endif
                </div>
                <div class='w-full sm:w-1/4'>
                    <x-lopsoft.control.inputform
                            wire:model.lazy='invoiceowner.rnc'
                            id='rnc'
                            ref='rnc'
                            label="{{ transup('rnc') }}"
                            class='w-full'
                            autofocus
                            classcontainer='w-full md:w-40'
                            mode="{{ $mode }}"
                            nextref='rnc'
                        />
                </div>
            </div>
        </div>
        <div x-cloak x-show='$wire.showSourceData' class=''>
            <div class=''>
                <x-lopsoft.control.inputform
                    wire:model.lazy='invoiceowner.address1'
                    id='address1'
                    x-ref='address1'
                    label="{{ transup('address') }}"
                    autofocus
                    classcontainer='w-full'
                    mode="{{ $mode }}"
                    nextref='address2'
                />
                <x-lopsoft.control.inputform
                    wire:model.lazy='invoiceowner.address2'
                    id='address2'
                    x-ref='address2'
                    autofocus
                    classcontainer='w-full'
                    mode="{{ $mode }}"
                    nextref='pbox'
                />

            </div>
            <div class='flex flex-wrap items-center justify-start w-full md:flex-no-wrap'>
                <div class='pr-2'>
                    <x-lopsoft.control.inputform
                        wire:model.lazy='invoiceowner.pbox'
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
                        wire:model.lazy='invoiceowner.city'
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
                wire:model.lazy='invoiceowner.state'
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
                'defaultvalue'  =>  $invoiceowner!=null?$invoiceowner['country_id']:( (\App\Models\Aux\Country::where('country',config('lopsoft.country_default'))->first())->id??null),
                'eventname'     => 'eventsetcountry',
                'uid'           => 'countrycomponent',
                'modelid'       => 'invoiceowner.country_id',
                'isTop'         =>  true,
                'template'      => 'components.lopsoft.dropdown.countries',
            ])
        </div>
    </div>
    <div class='mt-4'>
        @livewire('controls.invoice-inline-component',[
            'mode'          =>  $mode,
            'uid'           =>  'invoiceinlinecomponent',
            'defaultlines'  =>  $record==null?null:($record->lines!=null?$record->lines->toArray():null),
            'currency_id'   =>  $currency_id??0,
        ])
    </div>
</div>
