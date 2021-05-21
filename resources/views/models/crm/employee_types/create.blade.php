@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'crm',
        'component' =>  'employee-type'
    ])

@endsection
