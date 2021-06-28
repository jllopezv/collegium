<x-lopsoft.control.inputform
        wire:model.lazy='ref'
        id='ref'
        ref='ref'
        label="{{ transup('ref') }}"
        class='w-full'
        autofocus
        classcontainer='w-32'
        requiredfield
        help="{{ transup('mandatory_unique') }}"
        mode="{{ $mode }}"
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

    <x-lopsoft.control.radio-inline
        label='SELECCIONAR'
        model='invoice_source'
        color='text-gray-600'
        classlabel='font-bold'
        :options="[
            ['text'     => transup('customers'),
             'value'    => transup('customers')],
            ['text'     => transup('suppliers'),
             'value'    => transup('suppliers')]
        ]"/>



    @if($this->mode!='show')
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

    @livewire('controls.invoice-inline-component',[
        'mode'  =>  $mode,
        'uid'   =>  'invoiceinlinecomponent',
        'defaultlines' =>  $record==null?null:($record->lines!=null?$record->lines->toArray():null),
    ])
