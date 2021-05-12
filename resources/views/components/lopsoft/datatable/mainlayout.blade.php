@props([
    'table'     =>  '',
    'module'    =>  '',
    'model'     =>  null,
    'data'      =>  null,
    'title'     =>  '',
    'canadd'    =>  'true',
    'canselect' =>  'true',
    'showlocks' =>  '0',
    'minwidth'  =>  '700px',
    'minheight' =>  '500px',
    'cansearch' => 'true',
    'slave'     => 'false',
    'noFilterInGetDataQuery'    => 'false',
    'canShowFilterButton'       => 'false',
    'canShowSortButton'         => 'false',
])
<div x-data='{ showFilters:true, showSorts:false, screen_width:getScreenWidth()  }' @resize.window='screen_width=getScreenWidth()'>
    <div
        {{-- x-show='screen_width>640'  --}}
        class='{{ ($slave=='true')?'pt-2 rounded-t-lg bg-gray-700':''}}' >
    </div>
    <div class='flex flex-wrap items-center justify-between {{ ($slave!='true')?'mb-2':'bg-gray-700 px-2 py-2' }} '>
        <div class='flex items-center justify-start'>
            <div class='mr-1'>
                <x-lopsoft.link.gray
                    wire:click='refreshDatatable'>
                    <div class='flex items-center justify-center'>
                        <div wire:loading><i class="fas fa-sync fa-spin"></i></div>
                        <div wire:loading.remove><i class="fas fa-sync"></i></div>
                    </div>
                </x-lopsoft.link.gray>
            </div>
            {{ $modelactions }}
            {{-- FILTERS AND SORT --}}
            @if($canShowFilterButton)
                <div class='mr-1'>
                    <x-lopsoft.link.gray @click="showFilters=!showFilters" icon='fa fa-filter' ></x-lopsoft.link.gray>
                </div>
            @endif
            @if($canShowSortButton)
                <div class='mr-1 sm:hidden'>
                    <x-lopsoft.link.gray @click="showSorts=!showSorts" icon='fa fa-sort-alpha-down'></x-lopsoft.link.gray>
                </div>
            @endif
            @if($canadd!='false')
                @if(Auth::user()->hasAbility($table.".create"))
                <div class='mr-1'>
                    <x-lopsoft.link.success link="{{route($table.'.create')}}" icon='fa fa-plus' text='NUEVO'></x-lopsoft.link.teal>
                </div>
                @endif
            @endif
            {{ $tableactions }}

        </div>
        <div class='flex items-center justify-center  w-full sm:w-auto'>
            @if($cansearch!='false')
                <x-lopsoft.datatable.searchbar textcolor="{{ $slave=='true'?'text-white':'' }}" class='w-full sm:w-auto' />
                @hasAbilityOr([$table.'.lock', $table.'.lock.owner'])
                    <div class='ml-1'>
                        @if(property_exists($model,'hasactive'))
                            @if($showlocks!='1')
                                <x-lopsoft.link.gray wire:click='showLock(true)' icon='fa fa-lock' help='VER TODOS' helpclass='tooltiptext-up-left' ></x-lopsoft.link.gray>
                            @else
                                <x-lopsoft.link.gray wire:click='showLock(false)' icon='fa fa-unlock' help='VER SOLO ACTIVOS' helpclass='tooltiptext-up-left' ></x-lopsoft.link.gray>
                            @endif
                        @endif
                    </div>
                @endhasAbilityOr
            @endif
        </div>
    </div>
    <div  class='mb-2'>
        <div class='mb-1'>
            {{ $filters }}
        </div>
        <div class='mb-1'>
            {{ $sorts }}
        </div>
    </div>
    <div x-show='!(screen_width>640)'>
        @if($slave=='true')
            <div class='w-full pb-2 bg-gray-700 rounded-b-lg'></div>
        @endif
    </div>
</div>


<div x-data='{ screen_width: getScreenWidth() }' @resize.window='screen_width=getScreenWidth()'>
    <div x-show='screen_width>640' class='w-full shadow'>
        <div class='flex justify-center w-full'>
            <div class='w-full overflow-x-auto bg-white '>
                <div class='overflow-y-hidden'  style='min-height: {{$minheight}}; min-width: {{$minwidth}}'>
                    <table class='w-full table-fixed'>
                        <thead>
                            {{ $header }}
                        </thead>
                        <tbody>
                            {{ $body }}
                        </tbody>
                    </table>
                    {{ $nodata }}
                </div>
            </div>
        </div>
    </div>
    <div x-show='screen_width<=640' class='w-full p-4'>
        <div class='flex justify-center w-full'>
            <div class='w-full overflow-x-auto'>
                <div>
                    <table class='w-full table-fixed'>
                        {{ $headerxs }}
                        {{ $bodyxs }}
                    </table>
                        {{ $nodata }}
                </div>
            </div>
        </div>
    </div>
</div>
{{ $links }}

