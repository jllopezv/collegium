<div class='relative' >

    @include('livewire.partials.loading-message')

    <div wire:loading.delay.class='opacity-50'>
        <x-lopsoft.datatable.mainlayout
            table='{{ $table }}'
            model='{{ $model }}'
            data='{{ $data }}'
            title='{!! $title !!}'
            model='{{ $model }}'
            canadd='{{ $canadd }}'
            canselect='{{ $canselect }}'
            showlocks='{{ $showlocks }}'
            minwidth='{{ $minwidth }}'
            minheight='{{ $minheight }}'
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
                    <x-lopsoft.datatable.header-th class='w-16' justify='center'>FOTO</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-60' sortable sortorder='{{ $sortorder }}' columnname='name'>NOMBRE</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-3/4' sortable sortorder='{{ $sortorder }}' columnname='username'>USUARIO</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-40' justify='end' columnname='level'>NIVEL</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-3/4' columnname='roles'>ROLES</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th class='w-3/4' >INFO</x-lopsoft.datatable.header-th>
                    <x-lopsoft.datatable.header-th-space class='w-3/4' ></x-lopsoft.datatable.header-th-space>
                    <x-lopsoft.datatable.header-th-actions class='w-32' justify='end'/>
                </x-lopsoft.datatable.header-tr>
            </x-slot>
            <x-slot name='body'>
                @if(!is_null($data))
                    @if($data->count())
                        @foreach($data as $index => $item)
                            <x-lopsoft.datatable.body-tr active='{{$item->active??null}}'>
                                @if($canselect!=='false') <x-lopsoft.datatable.row-checkbox  id="row{{$index}}" value="{{$item->id}}"/> @endif
                                <x-lopsoft.datatable.row-column class='text-right'>{{ $item->id }}</x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column-avatar link="{{ route($table.'.show',$item->id) }}" justify='center'  avatar='{{ $item->avatar }}' />
                                <x-lopsoft.datatable.row-column >
                                    <div class='text-lg font-bold'><a href="{{ route($table.'.show',$item->id) }}">{{ $item->name }}</a></div>
                                    <div class='text-sm text-gray-500'><a href='mailto: {{ $item->email }}'>{{ $item->email }}</a></div>
                                </x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column link="{{ route($table.'.show',$item->id) }}" >
                                    {{ $item->username }}
                                </x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column  class='text-right' link="{{ route($table.'.show',$item->id) }}" >
                                    {!! $item->level !!}
                                </x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column link="{{ route($table.'.show',$item->id) }}" >
                                    {!! $item->getRolesTags() !!}
                                </x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column link="{{ route($table.'.show',$item->id) }}" >
                                    <div class='flex items-center justify-start'>
                                        <div>{!! $item->country->flag !!}</div>
                                        <div class='pt-1 ml-1 text-sm'>{{ strtoupper($item->language->code??'') }}</div>
                                    </div>
                                </x-lopsoft.datatable.row-column>
                                <x-lopsoft.datatable.row-column-space />
                                <x-lopsoft.datatable.row-actions table='{{$table}}' model='{{$model}}' itemid="{{ $item->id }}" active="{{ $item->active??null }}"/>
                            </x-lopsoft.datatable.body-tr>
                        @endforeach
                    @endif
                @endif
            </x-slot>
            <x-slot name="headerxs">
                @if($canselect!=='false')
                    <x-lopsoft.control.checkbox label='SELECCIONAR PAGINA' model='rowselectpage' color='text-green-400' classlabel='font-bold'/>
                    <x-lopsoft.control.checkbox label='SELECCIONAR TODOS' model='rowselectall' color='text-green-600' classlabel='font-bold'/>
                @endif
            </x-slot>
            <x-slot name='bodyxs'>
                @if(!is_null($data))
                    @if($data->count())
                        @foreach($data as $index => $item)
                            {{-- Card --}}
                            <tr>
                                <td>
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
                                        <div class='flex items-center justify-center mt-4'>
                                            <a href="{{ route($table.'.show',$item->id) }}">
                                                <img class='w-16 rounded-full' src='{{ $item->avatar }}' />
                                            </a>
                                        </div>
                                        <div class='mt-1 text-center'>
                                            <span class='text-gray-600'><b>{{ $item->name }}</b></span>
                                        </div>
                                        <div class='mt-1 text-center'>
                                            <span class='text-gray-500'>{{ $item->username }}</span>
                                        </div>
                                        <div class='mt-1 text-center'>
                                            <span class='text-gray-400'>{{ $item->email }}</span>
                                        </div>
                                        <div  class='text-right'>
                                            <x-lopsoft.datatable.row-actions-xs table='{{$table}}' model='{{$model}}' itemid="{{ $item->id }}" active="{{ $item->active??null }}"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
