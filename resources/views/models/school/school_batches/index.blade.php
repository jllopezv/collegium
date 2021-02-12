@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'school',
        'component' =>  'school-batch'
    ])

@endsection
