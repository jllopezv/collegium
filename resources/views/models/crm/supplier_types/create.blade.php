@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'crm',
        'component' =>  'supplier-type'
    ])

@endsection
