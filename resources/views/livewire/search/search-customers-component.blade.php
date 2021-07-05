<div x-data='{}' x-show='$wire.showdialog' class='bg-transparent relative'>
    <div
        wire:click='resetDialog' class='absolute top-2 right-1'>
        <i class='fa fa-times text-red-400 cursor-pointer'></i>
    </div>
    <x-lopsoft.control.inputform
        wire:model.debounce.500ms='search'
        label='BUSCAR'
        id='searchcustomer'
        placeholder="Nombre del cliente. Use * para listar todos"
        class='bg-transparent w-80'
        classcontainer='w-full'></x-lopsoft.control.inputform>

    {{-- List --}}
    <div class='h-80 overflow-y-auto'>
        @forelse($data as $item)
            <div
            wire:click='selectCustomer({{$item->id}})'
            class='flex flex-wrap md:flex-no-wrap items-center justify-start p-2 font-bold rounded-md cursor-pointer hover:bg-cool-gray-200'>
                <div class='w-full md:w-16 md:mr-4 flex flex-wrap items-center justify-center'>
                    <div>
                        <img class='rounded-full w-16 h-auto' src='{{ $item->avatar }}' />
                    </div>
                </div>
                <div class='flex flex-wrap items-center justify-center md:justify-start w-full '>
                    <div class='w-full md:w-80 '>
                        <div class='text-center md:text-left'>
                            <a href="{{route('customers.show', ['id' => $item->id])}}" target='_blank'><i class='fa fa-info-circle text-cool-gray-400 hover:text-blue-500'></i></a><span class='ml-2'>{{$item->customer}}</span>
                        </div>
                    </div>
                    <div class='md:pl-8 w-full md:w-auto md:flex  items-center justify-center md:justify-start '>
                        <div class='md:w-60 text-cool-gray-500 text-center md:text-left'>
                            {{$item->user->username??'' }}
                        </div>
                        <div class='md:w-60 text-cool-gray-500 text-center md:text-left'>
                            {{$item->user->email??'' }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <span class='font-bold text-gray-500'>NO SE ENCONTRARON RESULTADOS</span>
        @endforelse
    </div>
</div>
