@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'website',
        'component' =>  'website-post-cat'
    ])

@endsection
