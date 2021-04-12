@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonshow', [
        'module'    =>  'website',
        'component' =>  'website-section-cat'
    ])

@endsection
