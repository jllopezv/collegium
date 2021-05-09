@extends('lopsoft.layouts.page')

@include('models.school.students.related')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'school',
        'component' =>  'school-parent'
    ])

@endsection
