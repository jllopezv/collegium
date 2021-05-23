@extends('lopsoft.layouts.page')

@include('models.crm.employees.related')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'crm',
        'component' =>  'employee-type'
    ])

@endsection
