@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'website',
        'component' =>  'website-advertisement-cat'
    ])

@endsection
