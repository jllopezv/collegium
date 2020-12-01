@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'auth',
        'component' =>  'role'
    ])

@endsection
