@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'setting',
        'component' =>  'model-config'
    ])

@endsection
