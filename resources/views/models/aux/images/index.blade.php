@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'aux',
        'component' =>  'image'
    ])

@endsection
