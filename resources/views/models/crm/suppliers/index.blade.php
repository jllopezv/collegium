@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'crm',
        'component' =>  'supplier'
    ])

@endsection
