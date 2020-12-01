@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'show'] )

    <div class='inline-block items-top justify-center mt-4 p-2 w-full'>

        <div class='mx-auto w-full'>
            @livewire('auth.user-component', [
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
