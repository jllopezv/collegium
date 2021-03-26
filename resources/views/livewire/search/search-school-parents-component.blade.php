<div class=''>
    <x-lopsoft.control.inputform
        {{-- wire:keydown.enter='searchParent' --}}
        wire:model.debounce.500ms='search'
        label='BUSCAR'
        id='searchparent'
        placeholder="Nombre del pariente"
        class='bg-transparent w-80'
        classcontainer='w-full'></x-lopsoft.control.inputform>

    {{-- List --}}
    <div class='h-40 overflow-y-auto'>
        @forelse($data as $parent)
            <div
            wire:click='selectParent({{$parent->id}})'
            class='flex flex-wrap items-center justify-start p-2 font-bold rounded-md cursor-pointer hover:bg-cool-gray-200'>
                <div class='w-80'>
                    {{$parent->parent}}
                </div>
                <div class='w-40 text-cool-gray-500'>
                    {{$parent->user->username}}
                </div>
                <div class='w-40 text-cool-gray-500'>
                    {{$parent->user->email}}
                </div>
            </div>
        @empty
            <span class='font-bold text-gray-500'>NO SE ENCONTRARON RESULTADOS</span>
        @endforelse
    </div>
</div>
