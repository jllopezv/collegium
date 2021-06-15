@extends('lopsoft.layouts.page')

@php
    $teacher=auth()->user()->profile;
    $grades=$teacher->grades;
@endphp

@section('content')

    <div class='font-bold text-4xl text-center'>
        @foreach($grades as $grade)
            <div class=''>
                {{ $grade->grade }}
            </div>
        @endforeach
    </div>

    <div class='p-2'>
        <div class='flex items-center justify-start'>
            <div class='m-2 h-40 bg-white-200 p-2 rounded-lg w-1/4 shadow-lg flex items-baseline justify-center'>
                <div class='font-bold text-6xl text-center'>
                    {{ $grades->count() }}
                </div>
                <div class='font-bold text-4xl text-center'>
                   CURSOS
                </div>
            </div>
            <div class='m-2 h-40 bg-red-200 p-2 rounded-lg w-1/4 shadow-lg flex items-center justify-center'>
                <div class='font-bold text-4xl text-center'>
                    15 cursos asociados
                </div>
            </div>
            <div class='m-2 h-40 bg-red-200 p-2 rounded-lg w-1/4 shadow-lg flex items-center justify-center'>
                <div class='font-bold text-4xl text-center'>
                    15 cursos asociados
                </div>
            </div>
            <div class='m-2 h-40 bg-red-200 p-2 rounded-lg w-1/4 shadow-lg flex items-center justify-center'>
                <div class='font-bold text-4xl text-center'>
                    15 cursos asociados
                </div>
            </div>
        </div>
    </div>

@endsection
