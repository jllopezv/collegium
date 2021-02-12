@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonedit', [
        'module'    =>  'school',
        'component' =>  'school-modality'
    ])

@endsection
