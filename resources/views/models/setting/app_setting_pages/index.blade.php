@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'setting',
        'component' =>  'app-setting-page'
    ])

@endsection
