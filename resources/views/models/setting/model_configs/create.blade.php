@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'create'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto'>
            @livewire('setting.model-config-component', [
                'table'         =>  '{{ $table }}',
                'model'         =>  $model,
                'mode'          =>  'create',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,

                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection


