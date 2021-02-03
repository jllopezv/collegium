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
    'noFilterInGetDataQuery' => 'false',
])

<div x-data='{ screen_width: getScreenWidth() }' @resize.window='screen_width=getScreenWidth()'>
    <div
        {{-- x-show='screen_width>640'  --}}
        class='{{ ($slave=='true')?'pt-2 rounded-t-lg bg-gray-700':''}}' >
    </div>
    <div class='flex flex-wrap items-center justify-between {{ ($slave!='true')?'mb-2':'bg-gray-700 px-2 py-2' }} '>
        <div class=''>
            @isSuperadmin
                @if($noFilterInGetDataQuery==true)
                    <x-lopsoft.link.purple wire:click='changeFilterInGetDataQuery' icon='fa fa-filter' help='ACTIVAR FILTRO PRINCIPAL' helpclass='tooltiptext-up-right'></x-lopsoft.link.purple>
                @else
                    <x-lopsoft.link.danger wire:click='changeFilterInGetDataQuery' icon='fa fa-filter' help='DESACTIVAR FILTRO PRINCIPAL' helpclass='tooltiptext-up-right'></x-lopsoft.link.danger>
                @endif
            @endisSuperadmin
            <x-lopsoft.link.gray
                wire:click='refreshDatatable'>
                <div class='flex items-center justify-center'>
                    <div wire:loading><i class="fas fa-sync fa-spin"></i></div>
                    <div wire:loading.remove><i class="fas fa-sync"></i></div>
                </div>
            </x-lopsoft.link.gray>
            @if($canadd!='false')
                @if(Auth::user()->hasAbility($table.".create"))
                    <x-lopsoft.link.success link="{{route($table.'.create')}}" icon='fa fa-plus' text='NUEVO'></x-lopsoft.link.teal>
                @endif
            @endif
            {{ $tableactions }}
        </div>
        <div class='flex items-center justify-center '>
            @if($cansearch!='false')
                <x-lopsoft.datatable.searchbar textcolor="{{ $slave=='true'?'text-white':'' }}" />
                @isAdmin
                    <div class='ml-1'>
                        @if(property_exists($model,'hasactive'))
                            @if($showlocks!='1')
                                <x-lopsoft.link.gray wire:click='showLock(true)' icon='fa fa-lock' help='VER TODOS' helpclass='tooltiptext-up-left' ></x-lopsoft.link.gray>
                            @else
                                <x-lopsoft.link.gray wire:click='showLock(false)' icon='fa fa-unlock' help='VER SOLO ACTIVOS' helpclass='tooltiptext-up-left' ></x-lopsoft.link.gray>
                            @endif
                        @endif
                    </div>
                @endisAdmin
            @endif
        </div>
    </div>
    {{ $filters }}
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

