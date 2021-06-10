<div x-data='{}' x-show='$wire.showdialog' class='bg-transparent relative'>
    <div
        wire:click='resetDialog' class='absolute top-2 right-1'>
        <i class='fa fa-times text-red-400 cursor-pointer'></i>
    </div>
    <x-lopsoft.control.inputform
        wire:model.debounce.500ms='search'
        label='BUSCAR'
        id='searchteacher'
        placeholder="Nombre del profesor"
        class='bg-transparent w-80'
        classcontainer='w-full'></x-lopsoft.control.inputform>

    {{-- List --}}
    <div class='h-80 overflow-y-auto'>
        @forelse($data as $teacher)
            <div
            class='flex flex-wrap md:flex-no-wrap items-center justify-start p-2 mb-2 font-bold rounded-md cursor-pointer bg-cool-gray-200 hover:bg-cool-gray-300'>

                <div class='flex flex-wrap items-center justify-center md:justify-start w-full '>
                    <div class='w-full md:pl-4 md:w-10 pr-4'>
                        <div class='text-right md:text-left'>
                            <a href="{{route('teachers.show', ['id' => $teacher->id])}}" target='_blank'><i class='fa fa-info-circle text-cool-gray-400 hover:text-blue-500'></i></a>
                        </div>
                    </div>
                    <div class='w-full md:w-16 flex flex-wrap items-center justify-center'>
                        <div>
                            <img wire:click='selectTeacher({{$teacher->id}})' class='rounded-full w-16 h-auto p-2' src='{{ $teacher->avatar }}' />
                        </div>
                    </div>
                    <div class='w-full md:w-auto md:flex flex-wrap items-center justify-center md:justify-start md:pl-2'>
                        <div wire:click='selectTeacher({{$teacher->id}})' class='text-cool-gray-600 text-center md:text-left'>
                            {{$teacher->teacher}}
                        </div>

                        <div wire:click='selectTeacher({{$teacher->id}})' class='md:pl-4 text-sm text-cool-gray-400 text-center md:text-left'>
                            {{$teacher->employee->degree}}
                        </div>
                        {{--
                        <div wire:click='selectTeacher({{$teacher->id}})' class='md:w-80 text-cool-gray-400 text-center md:text-left'>
                            {{$teacher->user->email}}
                        </div>--}}
                    </div>
                </div>
            </div>
        @empty
            <span class='font-bold text-gray-500'>NO SE ENCONTRARON RESULTADOS</span>
        @endforelse
    </div>
</div>
