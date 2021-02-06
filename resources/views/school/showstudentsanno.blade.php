@extends('lopsoft.layouts.page')

@section('content')

    @php
        $anno=\App\Models\School\Anno::find($id);
        $levels=$anno->schoolLevels;
        $totalst=0;
        if ($anno!=null)
        {
            foreach($levels as $level)
            {
                $grades=$anno->schoolGrades->append('level_id')->where('level_id',$level->id);
                foreach($grades as $grade)
                {
                    $totalst+=count($grade->students($id));
                }

            }
        }
    @endphp

    <div>
        <div class='flex items-center justify-between px-4 py-5 bg-gray-200 shadow'>
            <div class=''>
                <div class="text-xl text-gray-800 md:text-2xl ">LISTADO DE ESTUDIANTES</div>
                <div class="flex flex-wrap items-center font-bold text-gray-800 justify-left ">
                    <div class='mr-2 text-xl md:text-xl'>
                        AÑO ACADÉMICO {{ $anno->anno }}
                    </div>
                    <div class='flex items-center justify-start px-2 text-green-300 rounded-md bg-cool-gray-700'>
                        <div class='mr-1'>
                            <span class='font-bold '>{{ $totalst }} </span>
                        </div>
                        <div class=''>
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

    <div  class='justify-center inline-block w-full h-full px-4 py-2 mt-4 items-top'>

        @if($anno!=null)
            @if(count($levels))
                @foreach($levels as $level)
                    @php
                        $grades=$anno->schoolGrades->append('level_id')->where('level_id',$level->id);
                        $totalst=0;
                        foreach($grades as $grade)
                        {
                            $totalst+=count($grade->students($id));
                        }
                    @endphp
                    <div x-data='{ showLevel{{$level->id}}:true }' class='mb-6'>
                        <div  class='flex items-center justify-start p-2 text-white border-b cursor-pointer bg-cool-gray-600'>
                            <div @click="showLevel{{$level->id}}=!showLevel{{$level->id}}" class='flex items-center justify-start'>
                                <div  class='w-full mr-2 text-xl font-bold '>
                                    {{ $level->level }}
                                </div>
                                <div class='flex items-center justify-start px-2 text-green-300 rounded-md bg-cool-gray-700'>
                                    <div class=''>
                                        <span class='font-bold '>{{ $totalst }} </span>
                                    </div>
                                    <div class='ml-1'>
                                        <i class=' far fa-graduation-cap fa-md'></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- GRADES --}}
                        <div x-cloak x-show.transition.opacity='showLevel{{$level->id}}' class=''>
                            @if(count($grades))
                            @foreach($grades as $grade)
                                @php
                                    $students=$grade->students($id);
                                @endphp
                                {{-- GRADE TITLE --}}
                                <div x-data='{ showTree{{$grade->id}}:true }' class='pl-4 mb-6 '>
                                    <div  class='flex items-center justify-start cursor-pointer text-cool-gray-800'>
                                        <div @click="showTree{{$grade->id}}=!showTree{{$grade->id}}" class='flex items-center justify-start'>
                                            <div  class='w-full mr-2 text-xl font-bold '>
                                                {{ $grade->grade }}
                                            </div>
                                            <div class='flex items-center justify-start px-2 text-green-300 rounded-md bg-cool-gray-700'>
                                                <div class=''>
                                                    <span class='font-bold '>{{ count($students) }} </span>
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
                                        <div x-show='showTree{{$grade->id}}' class='px-2 font-bold text-cool-gray-500'>NO HAY ESTUDIANTES INSCRITOS</div>
                                    @endif
                                </div>
                            @endforeach
                            @else
                            <div x-show='showLevel{{$level->id}}' class='px-2 font-bold text-cool-gray-500'>NO HAY GRADOS EN ESTE AÑO ACADÉMICO</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div  class='font-bold text-cool-gray-500'>NO HAY GRADOS EN ESTE AÑO ACADÉMICO</div>
            @endif
        @endif
    </div>

    <div class='h-32'></div>

@endsection
