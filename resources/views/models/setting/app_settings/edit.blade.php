@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'setting',
        'component' =>  'app-setting'
    ])

@endsection
