@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'setting',
        'component' =>  'app-setting'
    ])

@endsection
