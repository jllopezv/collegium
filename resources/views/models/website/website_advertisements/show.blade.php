@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'show'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto'>
            @livewire('website.website-advertisement-component', [
                'table'         =>  '{{ $table }}',
                'model'         =>  $model,
                'mode'          =>  'show',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'recordid'      =>  $recordid,
                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection
