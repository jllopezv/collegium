@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'show'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto'>
            @livewire('school.student-component', [
                'table'         =>  '{{ $table }}',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'show',
                'model'         =>  $model,
                'recordid'      =>  $recordid,
                ])
        </div>
    </div>

@endsection
