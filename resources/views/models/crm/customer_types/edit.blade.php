@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'crm',
        'component' =>  'customer-type'
    ])

@endsection
