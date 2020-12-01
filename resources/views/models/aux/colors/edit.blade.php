@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'aux',
        'component' =>  'color'
    ])

@endsection
