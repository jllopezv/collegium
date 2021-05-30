@extends('lopsoft.layouts.page')

@include('models.school.teachers.related')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'school',
        'component' =>  'teacher'
    ])

@endsection
