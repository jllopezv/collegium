@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'crm',
        'component' =>  'customer-type'
    ])

@endsection
