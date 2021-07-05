<div x-data='{}' x-show='$wire.showdialog' class='bg-transparent relative'>
    <div
        wire:click='resetDialog' class='absolute top-2 right-1'>
        <i class='fa fa-times text-red-400 cursor-pointer'></i>
    </div>
    <x-lopsoft.control.inputform
        wire:model.debounce.500ms='search'
        label='BUSCAR'
        id='searchstudent'
        placeholder="Nombre del estudiante. Use * para listar todos"
        class='bg-transparent w-80'
        classcontainer='w-full'></x-lopsoft.control.inputform>

    {{-- List --}}
    <div class='h-80 overflow-y-auto'>
        @forelse($data as $student)
            <div
            class='flex flex-wrap md:flex-no-wrap items-center justify-start p-2 mb-2 font-bold rounded-md cursor-pointer bg-cool-gray-200 hover:bg-cool-gray-300'>

                <div class='flex flex-wrap items-center justify-center md:justify-start w-full '>
                    <div class='w-full md:pl-4 md:w-10 pr-4'>
                        <div class='text-right md:text-left'>
                            <a href="{{route('students.show', ['id' => $student->id])}}" target='_blank'><i class='fa fa-info-circle text-cool-gray-400 hover:text-blue-500'></i></a>
                        </div>
                    </div>
                    <div class='w-full md:w-16 flex flex-wrap items-center justify-center'>
                        <div>
                            <img wire:click='selectStudent({{$student->id}})' class='rounded-full w-16 h-auto p-2' src='{{ $student->avatar }}' />
                        </div>
                    </div>
                    <div class='w-full md:w-auto md:flex flex-wrap items-center justify-center md:justify-start md:pl-2'>
                        <div wire:click='selectStudent({{$student->id}})' class='text-cool-gray-600 text-center md:text-left'>
                            {{$student->names}}
                        </div>

                        <div wire:click='selectStudent({{$student->id}})' class='md:pl-4 text-sm text-cool-gray-400 text-center md:text-left'>
                            ???
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <span class='font-bold text-gray-500'>NO SE ENCONTRARON RESULTADOS</span>
        @endforelse
    </div>
</div>
