@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'auth',
        'component' =>  'permission-group'
    ])


@endsection
