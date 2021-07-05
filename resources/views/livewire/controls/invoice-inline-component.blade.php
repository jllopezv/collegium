<div>
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
            'defaultvalue'  => $currency_id??\App\Models\Aux\Currency::getCurrent()->id,
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
            'defaultlines' =>  $defaultlines,
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
                {{--
                @livewire('controls.currency-input-form', [
                    'uid'           =>  'invoice_discount',
                    'showcurrency'  =>  false,
                    'showpercent'   =>  true,
                    'isPercent'     =>  false,
                    'mode'          =>  $mode,
                    'nextref'       =>  'ref',
                    'inputborderless'    =>  true
                ]) --}}
                <div class='flex items-center justify-start w-full'>
                    <div class='w-full'>
                        <x-lopsoft.control.input
                            id='discount'
                            wire:model.lazy='discount'
                            class='bg-transparent text-right'
                            classcontainer="w-full md:px-2 text-gray-700"
                            placeholder="{{ transup('discount') }}"
                            mode='{{  $mode }}'
                            />
                    </div>
                    <div class=''>
                        @if($mode!='show')
                            <div class='flex items-baseline justify-start pr-1'>
                                @if($discount_percent)
                                    <div wire:click='setPercent(0)' class="{{ !$discount_percent?'text-cool-gray-600':'text-cool-gray-600 hover:text-cool-gray-700 ' }} cursor-pointer"><i class="fa-fw fa fa-percent fa-xs "></i></div>
                                @endif
                                @if(!$discount_percent)
                                    <div wire:click='setPercent(1)'><i class="fa-fw fa fa-dollar-sign fa-xs {{ $discount_percent?'text-cool-gray-700':'text-cool-gray-600 hover:text-cool-gray-600 ' }} cursor-pointer"></i></div>
                                @endif
                            </div>
                        @else
                            <div class='flex items-baseline justify-start pr-1'>
                                @if($discount_percent)
                                    <div class="{{ !$discount_percent?'text-cool-gray-600':'text-cool-gray-600  ' }} cursor-pointer"><i class="fa-fw fa fa-percent fa-xs "></i></div>
                                @endif
                                @if(!$discount_percent)
                                    <div ><i class="fa-fw fa fa-dollar-sign fa-xs {{ $discount_percent?'text-cool-gray-600':'text-cool-gray-600 ' }} cursor-pointer"></i></div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
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
