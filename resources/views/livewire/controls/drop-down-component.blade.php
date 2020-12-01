<div x-data="{}"
   @click.away='$wire.hidebody()'
   class='py-4'
>
    <label class="block font-bold">
        {{ $label }}
    </label>
    <div class='relative pt-2 {{ $classdropdown }}'>
        <div class='flex items-center justify-center'>
            <div class='flex items-center justify-between
            p-0 m-0 rounded-none border-b-2 border-t-0 border-l-0 border-r-0 border-gray-300
            hover:border-gray-500 hover:shadow-none
            active:border-gray-500 active:shadow-none
            focus:border-gray-500 focus:shadow-none
            transition-all duration-300 w-full {{ $readonly?'cursor-default':'cursor-pointer'}}  {{$classchevron}}' wire:click='togglebody'>
                <div class='w-full py-1 pl-1'>
                    <div class='text-black'>{!! $text !!}</div>
                    <input wire:model='value' type='text' class='hidden w-full pb-1 pl-1 text-lg bg-transparent border-0 form-input hover:shadow-none active:shadow-none focus:shadow-none' readonly/>
                </div>
                @if(!$readonly)
                    <div class="{{ $readonly?'cursor-default':'cursor-pointer'}} pr-1" ><i class='fa fa-angle-{{$isTop?'up':'down'}} pt-2'></i></div>
                @endif
            </div>
            @if($requiredfield)
                <div class='cursor-pointer tooltip'>
                    <i class='text-red-400 fa fa-exclamation-circle fa-fw fa-xs'></i>
                    @if($help!='')
                        <span class='tooltiptext tooltiptext-down-left'>
                            {!! $help !!}
                        </span>
                    @endif
                </div>
            @endif
        </div>

        @if($showcontent)
            <div class='absolute left-0 right-0 z-10 p-1 bg-gray-100 border border-gray-300 rounded-b-lg shadow-lg list-group {{$isTop?'bottom-10':''}}' >
                @if($cansearch)
                    <input type='text' class='w-full p-2 border border-gray-400 rounded-lg shadow' placeholder='buscar...' />
                @endif
                <div class='w-full overflow-y-scroll max-h-40'
                    >
                    @foreach($options as $index => $option)

                            <div class='w-full p-2 cursor-pointer hover:bg-gray-600 hover:text-white hover:rounded-lg'
                                wire:click="select({{$index}})">{!! $option['text'] !!}
                            </div>

                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>