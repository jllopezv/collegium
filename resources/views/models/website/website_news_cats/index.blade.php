@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'website',
        'component' =>  'website-news-cat'
    ])

@endsection
