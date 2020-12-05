@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commoncreate', [
        'module'    =>  'aux',
        'component' =>  'language'
    ])

@endsection
