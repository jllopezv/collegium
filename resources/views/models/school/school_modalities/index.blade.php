@extends('lopsoft.layouts.page')

@include('models.school.annos.related')

@section('content')

    @include('livewire.partials.states.commonindex', [
        'module'    =>  'school',
        'component' =>  'school-modality'
    ])

@endsection
