@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'crm',
        'component' =>  'supplier-type'
    ])

@endsection
