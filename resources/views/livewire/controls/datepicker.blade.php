<div x-data="{}"
   @click.away='$wire.hidebody()'
   @keydown.escape='$wire.hidebody()'
   x-init='$wire.getValue($wire.uid)'
   class='py-4'

>
    <label class="block font-bold">
        {{ $label }}
    </label>
    <div class='relative w-40'>
        <div class='flex items-center justify-center'>
            <div class='flex items-center justify-between
                p-0 m-0 rounded-none border-b-2 border-t-0 border-l-0 border-r-0 border-gray-300
             hover:border-gray-500 hover:shadow-none
                active:border-gray-500 active:shadow-none
             focus:border-gray-500 focus:shadow-none
                transition-all duration-300 w-full {{ $readonly?'cursor-default':'cursor-pointer'}}' wire:click='togglebody'>
                <div class='pl-1'>
                    {{-- <div class='text-black'>{!! $contenttoshow !!}</div> --}}
                    <input wire:model.lazy='value' type='text' class='w-full pb-1 pl-1 text-lg bg-transparent border-0 form-input hover:shadow-none active:shadow-none focus:shadow-none'/>
                </div>
                @if(!$readonly)
                    <div class="{{ $readonly?'cursor-default':'cursor-pointer'}}  {{$classchevron}} pr-1" >
                        {{-- <i class='fa fa-angle-{{$isTop?'up':'down'}} pt-2'></i> --}}
                        <i class='pt-2 far fa-calendar-alt'></i>
                    </div>
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
        <div>
            <span class='text-red-500'>{{ $validationerror }}</span>
        </div>
        @if($showcontent)
            <div @click.away='$wire.hidebody()' class='absolute border border-gray-300  rounded-lg z-10
                        {{$isTop?'bottom-10':''}}  left-0 shadow-lg p-2 bg-gray-100 w-60 h-80
                        ' >
                <div class='flex items-center justify-between p-2'>
                    <div wire:click='prevMonth' class='items-center w-8 h-8 text-xl font-bold text-center rounded-full cursor-pointer hover:bg-cool-gray-300'>
                        <i class='fa fa-angle-left'></i>
                    </div>
                    <div x-data='{showanno: false, showmonth: false}' >
                        <span @click='showmonth=true' @click.away='showmonth=false' class='font-bold cursor-pointer '> {{ mb_strtoupper($currentdate->locale(config('lopsoft.locale_default'))->monthName) }} </span>
                        <span @click='showanno=true' @click.away='showanno=false'class='font-bold cursor-pointer '> {{ mb_strtoupper($currentdate->year) }} </span>
                        <div x-show='showmonth' class='absolute left-0 w-full overflow-y-auto text-white bg-gray-600 rounded-md shadow-xl h-60 nosb'>
                            @for($mn=0;$mn<12;$mn++,$monthname->addMonth())
                                <div wire:click='goMonth({{$mn}})' class="cursor-pointer p-2 hover:font-bold hover:bg-green-400 text-xl text-center {{ $monthname->month==$month ? 'bg-green-600 font-bold  text-white': '' }}">
                                    {{ mb_strtoupper($monthname->locale(config('lopsoft.locale_default'))->monthName) }}
                                </div>
                            @endfor
                        </div>
                        <div x-show='showanno' class='absolute left-0 right-0 overflow-y-auto text-white bg-gray-600 rounded-md shadow-xl h-60 nosb'>
                            @for($anno=1970;$anno<2100;$anno++)
                            <div wire:click='goYear({{$anno}})' class="cursor-pointer p-2 hover:font-bold hover:bg-green-400 text-xl text-center  {{ $anno==$year ? 'bg-green-600 font-bold  text-white': '' }}">{{ $anno }}</div>
                            @endfor
                        </div>
                    </div>
                    <div wire:click='nextMonth' class='items-center w-8 h-8 text-xl font-bold text-center rounded-full cursor-pointer hover:bg-cool-gray-300'>
                        <i class='fa fa-angle-right'></i>
                    </div>
                </div>
                <div class='mt-1'>
                    <div class='flex items-center justify-center'>
                        @for($i=0; $i < 7 ; $i++, $tempdate->addDay())
                        <div class="flex items-center justify-center w-8 h-8">
                            <div class="text-sm  font-bold {{ in_array($tempdate->dayOfWeek,$weekdays) ? 'text-red-500' : '' }}">{{ substr(strtoupper($tempdate->minDayName), 0, 1) }}</div>
                            {{-- $daystr[$i] --}}
                        </div>
                        @endfor
                    </div>
                    @for( $tempdate->subDay(7),$row=1;$row<=ceil(($lastdaymonth->day+($skip-1))/7);$row++ )
                        <div class='flex items-center justify-center'>
                            @for($i=0; $i < 7 ; $i++,$tempdate->addDay() )
                                <div wire:click="selectday({{$tempdate->day}},{{$tempdate->month}},{{$tempdate->year}})" class="w-8 h-8 cursor-pointer  rounded-full
                                    flex items-center justify-center
                                    hover:bg-cool-gray-200
                                    {{ $tempdate->month != $currentdate->month ? 'text-gray-400' : '' }}
                                    {{ ( (in_array($tempdate->dayOfWeek,$weekdays) && $tempdate->month == $currentdate->month ) && $tempdate->format('Y-m-d')!=$today->format('Y-m-d') )? 'text-red-400' : '' }}
                                    @if($valuedate!=null)
                                        {{ ( $tempdate->month==$valuedate->month && $tempdate->year==$valuedate->year && $tempdate->day==$valuedate->day)? 'bg-blue-200': ''}}
                                    @endif
                                    {{ $tempdate->format('Y-m-d')==$today->format('Y-m-d') ? 'bg-green-400 text-white': '' }}
                                    ">
                                    <div  class='text-sm font-bold'>{{ $tempdate->day}}</div>
                                </div>
                            @endfor
                        </div>
                    @endfor
                    <div class='absolute bottom-0 right-0 px-4 py-2'>
                        <span wire:click='goToday' class='text-sm font-bold cursor-pointer hover:text-green-500 '>{{ mb_strtoupper(__('lopsoft.today')) }}</span>
                    </div>
                </div>


            </div>
        @endif

    </div>
</div>
