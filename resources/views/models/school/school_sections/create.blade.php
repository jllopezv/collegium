@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'school',
        'component' =>  'school-section'
    ])

@endsection
