@extends('lopsoft.layouts.page')

@section('content')

    @php
        $anno=getUserAnnoSession();
        $level=\App\Models\School\SchoolLevel::find($id);
        $grades=$anno->schoolGrades->append('level_id')->where('level_id',$id);
        $totalst=0;
        if ($anno!=null)
        {
            foreach($grades as $grade)
            {
                $totalst+=count($grade->students($anno->id));
            }
        }
    @endphp

    <div>
        <div class='flex items-center justify-between px-4 py-5 bg-gray-200 shadow'>
            <div class=''>
                <div class="text-xl text-gray-800 md:text-2xl ">LISTADO DE ESTUDIANTES</div>
                <div class="flex items-center font-bold text-gray-800 justify-left ">
                    <div class='text-xl md:text-xl'>
                        NIVEL {{ $level->level }}
                    </div>
                    <div class='flex items-center justify-start px-2 ml-2 text-green-300 rounded-md bg-cool-gray-700'>
                        <div class=''>
                            <span class='font-bold '>{{ $totalst }} </span>
                        </div>
                        <div class='ml-1'>
                            <i class=' far fa-graduation-cap fa-md'></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <x-lopsoft.link.gray link="{{ route('dashboard') }}" icon='fa fa-angle-double-left' text='VOLVER'></x-lopsoft.link.gray>
            </div>
        </div>
    </div>

    <div  class='justify-center inline-block w-full px-4 py-2 mt-4 items-top'>
        @if($level!=null)
            @if(count($grades))
                @foreach($grades as $grade)
                    @php
                        $students=$grade->students($anno->id);
                    @endphp
                    <div x-data='{ showTree{{$grade->id}}:true }' class='pb-6'>
                        <div  class='flex items-center justify-start p-2 mt-6 text-white border-b cursor-pointer bg-cool-gray-500'>
                            <div @click="showTree{{$grade->id}}=!showTree{{$grade->id}}" class='flex items-center justify-start'>
                                <div  class='w-full mr-2 text-xl font-bold '>
                                    {{ $grade->grade }}
                                </div>
                                <div class='flex items-center justify-start px-2 text-green-300 rounded-md bg-cool-gray-700'>
                                    <div class=''>
                                        <span class='font-bold '>{{ count($grade->students($anno->id)) }} </span>
                                    </div>
                                    <div class='ml-1'>
                                        <i class=' far fa-graduation-cap fa-md'></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if( count($students) )
                            @foreach($students as $student)
                                <div x-cloak x-show.transition.opacity='showTree{{$grade->id}}' class=''>
                                    @include("school.formats.students")
                                </div>
                            @endforeach
                        @else
                            <div x-show='showTree{{$grade->id}}' class='font-bold text-cool-gray-500'>NO HAY ESTUDIANTES INSCRITOS</div>
                        @endif
                    </div>
                @endforeach
            @else
                <div  class='font-bold text-cool-gray-500'>NO HAY GRADOS EN ESTE NIVEL PARA ESTE AÑO ACADÉMICO</div>
            @endif
        @endif

    </div>

    <div class='h-32'></div>

@endsection
