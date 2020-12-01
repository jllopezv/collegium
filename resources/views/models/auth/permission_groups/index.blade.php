@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'auth',
        'component' =>  'permission-group'
    ])

@endsection
