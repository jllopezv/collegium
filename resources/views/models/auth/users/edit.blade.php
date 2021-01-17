@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'edit'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto'>
            @livewire('auth.user-component', [
                'table'         =>  '{{ $table }}',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'mode'          =>  'edit',
                'model'         =>  $model,
                'record'        =>  $record,
                'recordid'      =>  $recordid,
                ])
        </div>

    </div>

    <div class='h-32'></div>


@endsection
