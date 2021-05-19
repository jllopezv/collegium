@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'school',
        'component' =>  'school-subject'
    ])

@endsection
