@extends('lopsoft.layouts.page')

@section('content')

    @php
        $grade=\App\Models\School\SchoolGrade::find($id);
    @endphp

    <div>
        <div class='flex items-center justify-between px-4 py-5 bg-gray-200 shadow'>
            <div class=''>
                <div class="text-xl text-gray-800 md:text-2xl ">LISTADO DE ESTUDIANTES</div>
                <div class="text-xl font-bold text-gray-800 md:text-xl">GRADO {{ $grade->grade }}</div>
            </div>
            <div>
                <x-lopsoft.link.gray link="{{ route('dashboard') }}" icon='fa fa-angle-double-left' text='VOLVER'></x-lopsoft.link.gray>
            </div>
        </div>
    </div>

    <div  class='justify-center inline-block w-full px-4 py-2 mt-4 items-top'>


        <div x-data='{ showTree{{$grade->id}}:true }' class='pb-6'>
            <div  class='flex items-center justify-start p-2 mt-6 text-white border-b cursor-pointer bg-cool-gray-500'>
                <div @click="showTree{{$grade->id}}=!showTree{{$grade->id}}" class='flex items-center justify-start'>
                    <div  class='w-full mr-2 text-xl font-bold '>
                        {{ $grade->grade }}
                    </div>
                    <div class='flex items-center justify-start px-2 text-green-300 rounded-md bg-cool-gray-700'>
                        <div class=''>
                            <span class='font-bold '>{{ count($grade->students()) }} </span>
                        </div>
                        <div class='ml-1'>
                            <i class=' far fa-graduation-cap fa-md'></i></span>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $students=$grade->students();
            @endphp
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


    </div>

    <div class='h-32'></div>

@endsection
