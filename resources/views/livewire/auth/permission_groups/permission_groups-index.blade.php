<div class='relative' >

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50'>
        <x-lopsoft.datatable.mainlayout
            table='{{ $table }}'
            model='{{ $model }}'
            data='{{ $data }}'
            title='{!! $title !!}'
            canadd='{{ $canadd }}'
            canselect='{{ $canselect }}'
            showlocks='{{ $showlocks }}'
            minwidth='700px'
            cansearch='{{ $cansearch }}'
            slave='{{ $slave }}'
            >
            <x-slot name='tableactions'>
                @if(count($rowselected))
                    @include('livewire.partials.batchcommon')
                @endif
            </x-slot>
            <x-slot name="header">
                <x-lopsoft.datatable.header-tr>
                    @if($canselect!=='false') <x-lopsoft.datatable.header-th-checkbox class='w-20' /> @endif
                    <x-lopsoft.datatable.header-th class='w-16' justify='end' sortable sortorder='{{ $sortorder }}' columnname='id'>ID</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-24' justify='end' sortable sortorder='{{ $sortorder }}' columnname='priority'>ORDEN</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-1/4' sortable sortorder='{{ $sortorder }}' columnname='group'>GRUPO</x-lopsoft.datatable.header-th>
                    @if($showactions!='false')
                        <x-lopsoft.datatable.header-th-space class='w-1/4' ></x-lopsoft.datatable.header-th-space>
                        <x-lopsoft.datatable.header-th-actions
                            class='w-32'
                            justify='end'
                            actioncandelete="{{ $actioncandelete }}"
                            actioncanlock="{{ $actioncanlock }}"
                            actioncanedit="{{ $actioncanedit }}"
                        />
                    @endif
                </x-lopsoft.datatable.header-tr>
            </x-slot>
            <x-slot name='body'>
                @if(!is_null($data))
                    @if($data->count())
                        @foreach($data as $index => $item)
                            <x-lopsoft.datatable.body-tr active='{{$item->active??null}}'>
                                @if($canselect!=='false') <x-lopsoft.datatable.row-checkbox id="row{{$index}}" value="{{$item->id}}"/> @endif
                                <x-lopsoft.datatable.row-column  class='text-right' >{{ $item->id }}</x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column  class='text-right' link="{{ route($table.'.show',$item->id) }}">{{ $item->priority }}</x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column  link="{{ route($table.'.show',$item->id) }}">{{ $item->group }}</x-lopsoft.datatable.row-column>

                                @if($showactions!='false')
                                    <x-lopsoft.datatable.row-column-space />
                                    <x-lopsoft.datatable.row-actions
                                        table='{{$table}}'
                                        model='{{$model}}'
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
            <x-slot name="headerxs">
                @include('livewire.partials.headerxs-common')
            </x-slot>
            <x-slot name='bodyxs'>
                @if(!is_null($data))
                    @if($data->count())
                        @foreach($data as $index => $item)
                            {{-- Card --}}
                            <div class='p-2 m-2 bg-white rounded-lg shadow'>
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
                                        @include('livewire.partials.recordinfo-xs')
                                    </div>
                                </div>
                                <div class='mt-1 text-center'>
                                    <a href="{{ route($table.'.show',$item->id) }}"><span class='text-gray-600'><b>{{ $item->group }}</b></span></a>
                                </div>
                                <div  class='text-right'>
                                    <x-lopsoft.datatable.row-actions-xs table='{{$table}}' model='{{$model}}' itemid="{{ $item->id }}" active="{{ $item->active??null }}"/>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </x-slot>
            <x-slot name='nodata'>
                @if(is_null($data) || !$data->count())
                    <div class='p-4 font-bold text-gray-500'>NO HAY DATOS PARA MOSTRAR</div>
                @endif
            </x-slot>
            <x-slot name='links'>
                @if( !is_null($data) )
                    @if( $data->count() )
                        <div class='w-full p-4'>
                            <div>
                                <span class='text-sm text-gray-700'>Total registros {{ (!$showlocks)?$model::active()->count().' de ':'' }} {{ $model::all()->count() }}.</span>
                                @if(count($rowselected)) <span class='text-sm text-gray-700'>Registros seleccionados: {{ count($rowselected) }}</span>@endif
                            </div>
                            {{-- {{ $data->links('components.lopsoft.datatable.pagination') }} --}}
                            {{ $data->links() }}
                        </div>
                    @endif
                @endif
            </x-slot>
        </x-lopsoft.datatable.mainlayout>
    </div>
</div>