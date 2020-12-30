@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'setting',
        'component' =>  'app-setting-page'
    ])

@endsection
