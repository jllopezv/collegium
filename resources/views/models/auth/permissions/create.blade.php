@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'auth',
        'component' =>  'permission'
    ])

@endsection
