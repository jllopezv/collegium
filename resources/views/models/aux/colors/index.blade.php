@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'aux',
        'component' =>  'color'
    ])

@endsection
