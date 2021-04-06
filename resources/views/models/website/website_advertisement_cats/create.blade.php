@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'website',
        'component' =>  'website-advertisement-cat'
    ])

@endsection
