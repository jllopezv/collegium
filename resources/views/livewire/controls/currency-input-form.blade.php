<div>
    <div class='flex items-center justify-start'>
        <div class="{{ !$showcurrency?'hidden':'' }}">
            @livewire('controls.drop-down-table-component', [
                'model'         => \App\Models\Aux\Currency::class,
                'mode'          => $mode,
                'filterraw'     => '',
                'sortorder'     => 'id',
                'classinput'    => 'text-xs bg-gray-400 text-white rounded-md hover:bg-gray-600 hover:text-green-300',
                'classdropdown' => 'w-14 pb-1 text-center text-gray-700 rounded-md text-xs',
                'key'           => 'id',
                'field'         => 'symbol',
                'defaultvalue'  => $currencydefault,
                'eventname'     => $uid.'_setcurrency',
                'uid'           => $uid.'_currency',
                'modelid'       => 'modality_id',
                'isTop'         => false,
                'cansearch'     => false,
                'cansync'       => false,
                'borderless'    => $borderless,
                'arrowless'     => $arrowless,
            ])
        </div>
        <div class='w-full'>
            <x-lopsoft.control.input
                id='{{ $uid }}_input'
                wire:model.lazy='inputbox'
                class='bg-transparent text-right {{ $classinput }} '
                classcontainer="w-full"
                placeholder="0.00"
                nextref='{{ $nextref }}'
                mode="{{ $mode }}"
                wire:blur='focusout'
                wire:focus='focus'
            />
        </div>
        @if($showpercent)
            <div class='flex items-baseline justify-start pr-1'>
                @if($isPercent)
                    <div wire:click='setPercent(0)' class="{{ !$isPercent?'text-cool-gray-600':'text-cool-gray-400 hover:text-cool-gray-600 ' }} cursor-pointer"><i class="fa-fw fa fa-percent fa-xs "></i></div>
                @endif
                @if(!$isPercent)
                    <div wire:click='setPercent(1)'><i class="fa-fw fa fa-dollar-sign fa-xs {{ $isPercent?'text-cool-gray-600':'text-cool-gray-400 hover:text-cool-gray-600 ' }} cursor-pointer"></i></div>
                @endif
            </div>
        @endif
    </div>
</div>
