<div class='relative'>

    <div class='flex items-center justify-end mb-2'>
        <x-lopsoft.button.success id='btnLineAdd' x-ref='btnLineAdd' wire:click='LineAdd' icon='fa fa-plus' text="{{ transup('line') }}"/>
    </div>
    <div class='absolute top-5 left-3 hidden' wire:loading.delay.class.remove='hidden' >
        <i class='fas fa-circle-notch fa-spin text-blue-500'></i> <span class='text-blue-500'>Sincronizando...</span>
    </div>
    <div class='p-1 xl:bg-gray-100 xl:rounded-lg xl:py-2 '>

        @foreach($lines as $key=>$line)
            <div class="mb-2 xl:mb-0  bg-gray-100 xl:rounded-none rounded-lg  p-2 xl:py-0" >

                <div class='w-full'>
                    {{-- CONTENT --}}
                    <div class='flex flex-wrap items-center justify-start w-full '>
                        <div class='w-full xl:w-1/2  flex flex-wrap md:flex-no-wrap  items-center justify-start '>
                            <div class='w-full sm:w-40 md:w-40'>
                                @if($key==0)
                                    <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('code') }}</span>
                                @else
                                    <span class='xl:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('code') }}</span>
                                @endif
                                <x-lopsoft.control.input
                                    id='invoiceline_code_{{$loop->index}}'
                                    wire:model.lazy='lines.{{$loop->index}}.code'
                                    class='bg-transparent'
                                    classcontainer="w-full md:w-40 md:px-2 text-gray-700"
                                    placeholder="{{ transup('code') }}"
                                    nextref='invoiceline_item_{{$loop->index}}'
                                    mode='{{ $mode }}'
                                />
                            </div>
                            <div class='w-full'>
                                @if($key==0)
                                    <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('article') }}</span>
                                @else
                                    <span class='md:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('article') }}</span>
                                @endif
                                <x-lopsoft.control.input
                                    id='invoiceline_item_{{$loop->index}}'
                                    wire:model.lazy='lines.{{$loop->index}}.item'
                                    class='bg-transparent'
                                    classcontainer="w-full md:px-2 text-gray-700"
                                    placeholder="{{ transup('article') }}"
                                    nextref='invoiceline_quantity_{{$loop->index}}'
                                    mode='{{ $mode }}'
                                />
                            </div>
                        </div>
                        <div class='w-full xl:w-1/2 flex flex-wrap md:flex-no-wrap items-center justify-start '>
                            <div class='flex items-center justify-start w-full md:w-1/3 '>
                                <div class='w-1/3'>
                                    @if($key==0)
                                        <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('quantity_short') }}</span>
                                    @else
                                        <span class='md:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('quantity_short') }}</span>
                                    @endif
                                    <x-lopsoft.control.input
                                        id='invoiceline_quantity_{{$loop->index}}'
                                        wire:model.lazy='lines.{{$loop->index}}.quantity'
                                        class='bg-transparent text-right'
                                        classcontainer="w-full md:px-2 text-gray-700 mr-2"
                                        placeholder="0"
                                        nextref='invoiceline_price_{{$loop->index}}_input'
                                        mode='{{ $mode }}'
                                    />
                                </div>

                                <div class='w-2/3'>
                                    @if($key==0)
                                        <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('price') }}</span>
                                    @else
                                        <span class='md:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('price') }}</span>
                                    @endif
                                    <div class='flex items-center justify-center w-full'>
                                        <div class='w-full'>
                                            @livewire('controls.currency-input-form', [
                                                'uid'           =>  'invoiceline_price_'.$loop->index,
                                                'nextref'       =>  'invoiceline_discount_'.$loop->index.'_input',
                                                'showcurrency'  =>  false,
                                                'showpercent'   =>  false,
                                                'isPercent'     =>  false,
                                                'mode'          =>  $mode,
                                                'classinput'    =>  'text-cool-gray-700',
                                                'currency_id'   =>  $currency_id,
                                            ], key('price'.$loop->index))
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='flex items-center justify-start w-full md:w-1/3 '>
                                <div class='w-1/2 flex items-center justify-start'>
                                    <div class='w-full ml-0 md:ml-2'>
                                        @if($key==0)
                                            <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('discount_short') }}</span>
                                        @else
                                            <span class='md:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('discount_short') }}</span>
                                        @endif
                                        @livewire('controls.currency-input-form', [
                                                'uid'           =>  'invoiceline_discount_'.$loop->index,
                                                'nextref'       =>  'invoiceline_tax_'.$loop->index,
                                                'showcurrency'  =>  false,
                                                'showpercent'   =>  true,
                                                'isPercent'     =>  true,
                                                'mode'          =>  $mode,
                                                'classinput'    =>  'text-cool-gray-700',
                                                'currency_id'   =>  $currency_id,
                                            ], key('discount'.$loop->index))
                                    </div>
                                </div>
                                <div class='w-1/2'>
                                    <div class='w-full'>
                                        @if($key==0)
                                            <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('tax_short') }}</span>
                                        @else
                                            <span class='md:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('tax_short') }}</span>
                                        @endif
                                        <div class='flex items-center justify-start w-full'>
                                            <div class='w-full'>
                                                <x-lopsoft.control.input
                                                    id='invoiceline_tax_{{$loop->index}}'
                                                    wire:model.lazy='lines.{{$loop->index}}.tax'
                                                    class='bg-transparent text-right text-gray-700'
                                                    classcontainer="w-full pl-2"
                                                    placeholder="0"
                                                    nextref='btnLineAdd'
                                                    mode='{{ $mode }}'
                                                />
                                            </div>
                                            <div class='w-4'>
                                                <i class="fa-fw fa fa-percent fa-xs text-cool-gray-500 '"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='w-full md:w-1/3 flex items-center justify-start'>
                                <div class='w-full'>
                                    @if($key==0)
                                        <span class='text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('amount') }}</span>
                                    @else
                                        <span class='md:hidden text-xs font-bold md:pl-3 text-cool-gray-500'>{{ transup('amount') }}</span>
                                    @endif
                                    @livewire('controls.currency-input-form', [
                                                    'uid'           =>  'invoiceline_amount_'.$loop->index,
                                                    'showcurrency'  =>  false,
                                                    'showpercent'   =>  false,
                                                    'isPercent'     =>  false,
                                                    'mode'          =>  'show',
                                                    'classinput'    =>  'text-cool-gray-700',
                                                    'currency_id'   =>  $currency_id,
                                                ], key('amount'.$loop->index))
                                </div>
                                <div class="{{ $key==0?'mt-4':'mb-2' }}">
                                    @livewire('controls.drop-down-table-component', [
                                        'model'         => \App\Models\Aux\Currency::class,
                                        'mode'          => $mode,
                                        'filterraw'     => '',
                                        'sortorder'     => 'id',
                                        'classinput'    => 'text-xs bg-gray-400 text-white rounded-md hover:bg-gray-600 hover:text-green-300',
                                        'classdropdown' => 'w-14 pr-2 text-center text-gray-700 rounded-md text-xs',
                                        'key'           => 'id',
                                        'field'         => 'symbol',
                                        'defaultvalue'  =>  $currency_id,
                                        'eventname'     => 'eventsetcurrency',
                                        'uid'           => 'currencycomponent_'.$loop->index,
                                        'modelid'       => 'modality_id',
                                        'isTop'         =>  false,
                                        'cansearch'     =>  false,
                                        'cansync'       =>  false,
                                        'borderless'    =>  true,
                                        'arrowless'     =>  true,
                                    ], key('dropdowncomponent'.$loop->index))
                                </div>
                            </div>
                            @if($mode!='show')
                                <div class="{{ $key==0?'pt-6':'' }} pl-2 w-full md:w-4">
                                    <div class='flex items-center justify-end'>
                                        <div wire:click="LineDelete({{ $loop->index }})" class=''>
                                            <i class="{{ (!$loop->first || ($loop->first && count($lines)>1)) ? 'text-red-400 cursor-pointer hover:text-red-600' : 'text-gray-200' }} fa fa-minus-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
