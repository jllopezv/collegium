@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'website',
        'component' =>  'website-advertisement-cat'
    ])

@endsection
