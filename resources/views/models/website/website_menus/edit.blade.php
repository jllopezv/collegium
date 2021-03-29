@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'website',
        'component' =>  'website-menu'
    ])

@endsection
