@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'auth',
        'component' =>  'permission'
    ])

@endsection
