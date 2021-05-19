<div x-data="{}"
   @click.away='$wire.hidebody()'
   x-init='$wire.getValue($wire.uid)'
   class='py-4'
>
    <label class="block font-bold {{ $validationerror?'text-red-600 ':''}}">
        {{ $label }}
        @if($sublabel!="")
            <div class='text-sm font-normal text-gray-400'>{{ $sublabel}}</div>
        @endif
    </label>
    <div class='relative {{ $classdropdown }} pt-2'>
        <div class='flex items-center justify-center'>
            <div class='flex items-center justify-between
            p-0 m-0 rounded-none border-b-2 border-t-0 border-l-0 border-r-0 border-gray-300
            hover:border-gray-500 hover:shadow-none
            active:border-gray-500 active:shadow-none
            focus:border-gray-500 focus:shadow-none
            transition-all duration-300 w-full {{ $readonly?'cursor-default':'cursor-pointer'}}  {{$classchevron}}' wire:click='togglebody'>
                <div class='w-full py-1 pl-1'>
                    <div class='text-black'>{!! $contenttoshow !!}</div>
                    <input wire:model='value' type='text' class='hidden w-full pb-1 pl-1 bg-transparent border-0 form-input hover:shadow-none active:shadow-none focus:shadow-none' readonly/>
                </div>
                @if(!$readonly)
                    <div class="{{ $readonly?'cursor-default':'cursor-pointer'}} pr-1" ><i class='fa fa-angle-{{$isTop?'up':'down'}} pt-2'></i></div>
                @endif
            </div>
            @if($requiredfield && $mode!='show')
                <div class='cursor-pointer tooltip' onclick="ShowInfo('{!! $help !!}')">
                    <i class='text-blue-400 fa fa-exclamation-circle fa-fw fa-xs'></i>
                    @if($help!='')
                        <span class='tooltiptext tooltiptext-down-left'>
                            {!! $help !!}
                        </span>
                    @endif
                </div>
            @endif
            @if($validationerror!="")
                <div onclick="ShowError('{!! $validationerror !!}')">
                    <i class='text-red-400 cursor-pointer fa fa-exclamation-triangle fa-fw fa-xs'></i>
                </div>
            @endif
        </div>
        {{-- <div>
            <span class='text-red-500'>{{ $validationerror }}</span>
        </div> --}}

        @if($showcontent)
            <div class='border border-gray-300  absolute list-group z-10 {{$isTop?'bottom-10':''}} right-0 left-0 shadow-lg p-1 bg-gray-100' >

                    <div class='flex items-center py-1 mb-1 overflow-x-hidden border-b-2 border-cool-gray-200'>
                        @if($cansearch)
                        <div class='w-full'>
                            <input type='text' class='w-full p-2 border-cool-gray-300 '
                                wire:model.debounce.500ms='search'
                                wire:keydown.escape='clearSearch'
                                placeholder="Buscar..."
                                autofocus />
                        </div>
                        @else
                        <div class='w-full'></div>
                        @endif
                        @if($linknew)
                            <div class='ml-1'>
                                <x-lopsoft.link.success target='_blank' @click='$wire.showcontent=false' :link="$linknew" icon='fa fa-plus' text="{{mb_strtoupper(trans('lopsoft.new'))}}"  />
                            </div>
                        @endif
                        <div class='ml-1'>
                            <div wire:loading.delay >
                                <x-lopsoft.link.gray wire:click='getData' icon='fa fa-spin fa-sync fa-fw'  />
                            </div>
                            <div wire:loading.delay.remove >
                                <x-lopsoft.link.gray wire:click='getData' icon='fa fa-sync fa-fw'  />
                            </div>
                        </div>
                    </div>

                <div class='w-full overflow-y-auto max-h-40 nosb'
                    >
                    @if(count($records))
                        @foreach($records as $index => $record)

                                <div class="p-2
                                    cursor-pointer {{ array_search($record[$key],$selected)!==false?'bg-cool-gray-200':'' }}
                                    hover:bg-gray-600 hover:text-white hover:rounded-lg
                                    w-full"
                                    wire:click="selectchange({{$record[$key]}})">
                                    @if($template)
                                        @include ("$template", [
                                            'record'        => $record,
                                            'index'         => $index,
                                            'isSelected'    => array_search($record[$key],$selected)])
                                    @else
                                        <div class='flex items-center justify-between'>
                                            <div class=''>
                                                {!! $record[$field] !!}
                                            </div>
                                            <div class=''>
                                                @if(array_search($record[$key],$selected)!==false)
                                                    <i class='fa fa-check'></i>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                        @endforeach
                    @else
                    <div class='w-full p-2 cursor-pointer hover:bg-gray-600 hover:text-white hover:rounded-lg' >SIN DATOS
                    </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>
