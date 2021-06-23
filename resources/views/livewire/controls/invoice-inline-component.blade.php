<div>
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
        requiredfield
        help="{{ transup('mandatory_unique') }}"
        mode="{{ $mode }}"
        nextref='invoiceline_code_0'
    />

    <div class='w-full sm:w-80'>
        @livewire('controls.drop-down-table-component', [
            'model'         => \App\Models\Aux\Currency::class,
            'mode'          => $mode,
            'filterraw'     => '',
            'sortorder'     => 'id',
            'key'           => 'id',
            'field'         => 'symbol',
            'label'         => transup('currency'),
            'sublabel'      => 'Define la divisa para la factura',
            'defaultvalue'  => \App\Models\Aux\Currency::getCurrent()->id,
            'eventname'     => 'eventsetinvoicecurrency',
            'uid'           => 'invoicecurrency',
            'modelid'       => 'currency_id',
            'isTop'         => false,
            'cansearch'     => false,
            'cansync'       => false,
            'template'      => 'components.lopsoft.dropdown.currencies',
        ])
    </div>

    {{-- LINEAS --}}
    <div class='mt-4'>
        @livewire('controls.invoice-lines-component',[
            'mode'  =>  $mode,
            'uid'   =>  'invoicelines',
            'lines' =>  null,
            'model' =>  App\Models\Crm\Invoice::class,
        ])
    </div>

    {{-- TOTALES --}}
    <div class='flex items-center justify-end w-full mt-4'>
        <div class='w-full md:w-1/2 lg:w-1/3 flex flex-wrap items-center justify-end border-t border-cool-gray-300 px-2'>
            <div class='w-full sm:w-1/2 text-left'>
                SUBTOTAL
            </div>
            <div class='w-full sm:w-1/2 text-right ' style='padding-right: 23px'>
                {{ $subtotal_string }}
            </div>
        </div>
    </div>
    <div class='flex items-center justify-end w-full mt-1.5'>
        <div class='w-full md:w-1/2 lg:w-1/3 flex flex-wrap items-center justify-end px-2'>
            <div class='w-full sm:w-1/2 text-left'>
                IMPUESTOS
            </div>
            <div class='w-full sm:w-1/2 text-right' style='padding-right: 23px'>
                {{ $taxes_string }}
            </div>
        </div>
    </div>
    <div class='flex items-center justify-end w-full '>
        <div class='w-full md:w-1/2 lg:w-1/3 flex flex-wrap items-center justify-end px-2'>
            <div class='w-full sm:w-1/2 text-left' >
                DTO
            </div>
            <div class='w-full sm:w-1/2 text-right'>
                @livewire('controls.currency-input-form', [
                    'uid'           =>  'invoice_discount',
                    'showcurrency'  =>  false,
                    'showpercent'   =>  true,
                    'isPercent'     =>  false,
                    'mode'          =>  $mode,
                    'nextref'       =>  'ref',
                    'inputborderless'    =>  true
                ])
            </div>
        </div>
    </div>

    <div class='flex items-center justify-end w-full mt-8'>
        <div class='w-full md:w-1/2 lg:w-1/3 flex flex-wrap items-center justify-end px-2 text-lg'>
            <div class='w-full sm:w-1/3 text-left font-bold'>
                TOTAL
            </div>
            <div class='w-full sm:w-2/3 text-right font-bold ' style='padding-right: 23px'>
                {{ $total_string }}
            </div>
        </div>
    </div>
</div>
