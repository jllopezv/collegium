@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'aux',
        'component' =>  'country'
    ])

@endsection
