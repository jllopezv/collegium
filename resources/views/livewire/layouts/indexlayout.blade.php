<div class='relative' >

    @include('livewire.partials.loading-message')

    <div @if(!$disableloading) wire:loading.delay.class='opacity-25' @endif>
        <x-lopsoft.datatable.mainlayout
            table='{{ $table }}'
            module='{{ $module }}'
            model='{{ $model }}'
            data='{{ $data }}'
            title='{!! $title !!}'
            canadd='{{ $canadd }}'
            canselect='{{ $canselect }}'
            showlocks='{{ $showlocks }}'
            minwidth="{{ $minwidth??'700px' }}"
            cansearch='{{ $cansearch }}'
            slave='{{ $slave }}'
            noFilterInGetDataQuery='{{ $noFilterInGetDataQuery }}'
            >
            {{-- BATCH COMMON --}}
                <x-slot name='tableactions'>
                    @if(count($rowselected))
                        <x-lopsoft.button.danger icon='fa fa-trash' wire:click='destroyBatch' />
                        @if (property_exists($model,'hasactive'))
                            <x-lopsoft.button.warning wire:click='lockBatch' help='BLOQUEAR REGISTRO' helpclass='tooltiptext-up-right' class='ml-1' icon='fa fa-lock' />
                            <x-lopsoft.button.success wire:click='unlockBatch' help='DESBLOQUEAR REGISTRO' helpclass='tooltiptext-up-right' class='ml-1' icon='fa fa-unlock' />
                        @endif
                    @endif
                </x-slot>
            {{-- /BATCH COMMON --}}
            {{-- FILTERS --}}
                <x-slot name='filters'>
                    @yield('filters')
                </x-slot>
            {{-- /FILTERS --}}
            {{-- HEADER --}}
                <x-slot name="header">
                    <x-lopsoft.datatable.header-tr>
                        @if($canselect!=='false') <x-lopsoft.datatable.header-th-checkbox class='w-20' /> @endif
                        <x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
                        @isSuperadmin
                            {{-- <x-lopsoft.datatable.header-th class='w-32'>AÑO</x-lopsoft.datatable.header-th> --}}
                        @endisSuperadmin
                        @yield('header')
                        @if($showactions!='false')
                            <x-lopsoft.datatable.header-th-space class='w-2/4' ></x-lopsoft.datatable.header-th-space>
                            <x-lopsoft.datatable.header-th-actions
                                class='w-52'
                                justify='end'
                                actioncandelete="{{ $actioncandelete }}"
                                actioncanlock="{{ $actioncanlock }}"
                                actioncanedit="{{ $actioncanedit }}"
                            />
                        @endif
                    </x-lopsoft.datatable.header-tr>
                </x-slot>
            {{-- /HEADER --}}
            {{-- BODY --}}
                <x-slot name='body'>
                    @if(!is_null($data))
                        @if($data->count())
                            @foreach($data as $index => $item)

                                <x-lopsoft.datatable.body-tr
                                    active='{{$item->active??true}}'
                                    model='{{ $model }}'
                                    index="{{$item->id}}"
                                    table="{{$table}}">
                                    @if($canselect!=='false')
                                        @if($item->allowDelete() || $item->allowLock())
                                            @if($item->canDeleteRecord() || $item->canLockRecord() || $item->canUnlockRecord() || $item->canCustomActionRecord() )
                                                <x-lopsoft.datatable.row-checkbox id="row{{$index}}" value="{{$item->id}}"/>
                                            @else
                                                <x-lopsoft.datatable.row-checkbox id="row{{$index}}" value="{{$item->id}}" readonly/>
                                            @endif
                                        @else
                                            <x-lopsoft.datatable.row-checkbox id="row{{$index}}" value="{{$item->id}}" readonly/>
                                        @endif
                                    @endif
                                    @include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->id, 'classrow' => 'text-right'])
                                    @isSuperadmin
                                        {{-- @include('components.lopsoft.datatable.rowcolumn', ['slot'=> $item->anno(getUserAnnoSession()->id)!=null?$item->anno(getUserAnnoSession()->id)->anno:'' ] ) --}}
                                    @endisSuperadmin
                                    @include('livewire.tables.'.$module.".".$table.".indexbody")
                                    @if($showactions!='false')
                                        <x-lopsoft.datatable.row-column-space />
                                        <x-lopsoft.datatable.row-actions
                                            table='{{$table}}'
                                            model='{{$model}}'
                                            module='{{$module}}'
                                            itemid="{{ $item->id }}"
                                            active="{{ $item->active??null }}"
                                            actioncandelete="{{ $actioncandelete }}"
                                            actioncanlock="{{ $actioncanlock }}"
                                            actioncanedit="{{ $actioncanedit }}"
                                        />
                                    @endif
                                </x-lopsoft.datatable.body-tr>

                            @endforeach
                        @endif
                    @endif
                </x-slot>
            {{-- /BODY --}}
            {{-- HEADERXS --}}
                <x-slot name="headerxs">
                    @yield('headerxs')
                    <div class='ml-2'>
                        @if($canselect!=='false')
                            <div class=''>
                                <x-lopsoft.control.checkbox label='SELECCIONAR PAGINA' model='rowselectpage' color='text-green-400' classlabel='font-bold'/>
                            </div>
                            <div class=''>
                                <x-lopsoft.control.checkbox label='SELECCIONAR TODOS'  model='rowselectall'  color='text-green-600' classlabel='font-bold'/>
                            </div>
                        @endif
                        @if(!is_null($data) && method_exists($data->first(),'syncPriority'))
                            <i wire:click='syncPriority' class='font-bold cursor-pointer fa fa-sync fa-fw fa-sm text-cool-gray-400 hover:text-cool-gray-600'></i><span class='pl-3 text-sm font-bold'>SYNC PRIORIDAD</span>
                        @endif
                    </div>
                </x-slot>
            {{-- /HEADERXS --}}
            {{-- BODYXS --}}
                <x-slot name='bodyxs'>
                    @if(!is_null($data))
                        @if($data->count())
                            @foreach($data as $index => $item)
                                {{-- Card --}}
                                <div class='p-2 m-2 bg-white
                                    @include('livewire.partials.cardstates', [ 'record' => $item ])
                                    rounded-lg shadow'>


                                    <div class='flex items-center justify-between'>
                                        <div class=''>
                                            @if($canselect!=='false')
                                                <input
                                                    id="row{{$index}}"
                                                    value="{{$item->id}}"
                                                    type='checkbox'
                                                    wire:model='rowselected'
                                                    class="w-5 h-5 text-green-400 cursor-pointer form-checkbox hover:shadow-none hover:border-gray-500 active:shadow-none focus:shadow-none focus:border-gray-500"
                                                />
                                            @endif
                                        </div>
                                        <div class=''>
                                            {{-- RECORD INFO --}}
                                            <span class='bg-blue-500 text-white py-0.5 px-1 text-xs rounded font-bold'>ID {{ $item->id }}</span>
                                            @if(property_exists($model,'hasactive'))
                                                @if ($item->active)
                                                    <span class='bg-green-400 text-white py-0.5 px-1 text-xs rounded font-bold'>ACTIVO</span>
                                                @else
                                                    <span class='bg-red-500 text-white py-0.5 px-1 text-xs rounded font-bold'>NO ACTIVO</span>
                                                @endif
                                            @endif
                                            {{-- /RECORD INFO --}}
                                        </div>
                                    </div>
                                    @if($item->canShowRecord() && $item->allowShow())
                                        <a class='cursor-pointer' href="{{ route($table.'.show',$item->id) }}">
                                    @endif
                                        @include('livewire.tables.'.$module.".".$table.".indexbodyxs")
                                    @if($item->canShowRecord() && $item->allowShow())
                                        </a>
                                    @endif
                                    <div  class='flex items-baseline justify-between'>
                                        <div>
                                            @if(method_exists($item,'syncPriority'))
                                                <div class='flex items-center justify-start'>
                                                    <div class='pt-1 tooltip'>
                                                        <i wire:click='upPriority({{$item->id}})' class="fa fa-angle-up fa-lg {{ $item->priority<2?'text-cool-gray-300':'text-cool-gray-400 hover:text-cool-gray-600 cursor-pointer ' }}"></i>
                                                        <span class='tooltiptext tooltiptext-center-right'>AUMENTAR PRIORIDAD</span>
                                                    </div>
                                                    <div class='px-2 tooltip'>
                                                        <span class='px-2 text-xs font-bold text-green-300 rounded-md bg-cool-gray-600'>{{ $item->priority }}</span>
                                                        <span class='tooltiptext tooltiptext-center-right'>PRIORIDAD</span>
                                                    </div>
                                                    <div class='pt-1 tooltip'>
                                                        <i wire:click='downPriority({{$item->id}})' class='cursor-pointer text-cool-gray-400 hover:text-cool-gray-600 fa fa-angle-down fa-lg'></i>
                                                        <span class='tooltiptext tooltiptext-center-right'>DECREMENTAR PRIORIDAD</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class=''>
                                            <x-lopsoft.datatable.row-actions-xs
                                                table='{{$table}}'
                                                model='{{$model}}'
                                                module='{{ $module }}'
                                                itemid="{{ $item->id }}"
                                                active="{{ $item->active??true }}"/>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                </x-slot>
            {{-- /BODYXS --}}
            {{-- NODATA --}}
                <x-slot name='nodata'>
                    @if(is_null($data) || !$data->count())
                        <div class='p-4 font-bold text-gray-500'>NO HAY DATOS PARA MOSTRAR</div>
                    @endif
                </x-slot>
            {{-- /NODATA --}}
            {{-- LINKS --}}
                <x-slot name='links'>
                    @if( !is_null($data) )
                        @if( $data->count() )
                            <div class='w-full p-4'>
                                <div>
                                    <span class='text-sm text-gray-700'>Total registros {{ (!$showlocks && property_exists($model,'hasactive') )?$recordcount.' de ':'' }} {{ $model::all()->count() }}.</span>
                                    @if(count($rowselected)) <span class='text-sm text-gray-700'>Registros seleccionados: {{ count($rowselected) }}</span>@endif
                                </div>
                                {{ $data->links() }}
                            </div>
                        @endif
                    @endif
                </x-slot>
            {{-- /LINKS --}}
        </x-lopsoft.datatable.mainlayout>
    </div>
</div>
