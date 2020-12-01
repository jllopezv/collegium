@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'create'] )

    <div class='inline-block items-top justify-center mt-4 p-2 w-full'>

        <div class='mx-auto w-full'>
            @livewire('auth.user-component', [
                'table'         =>  '{{ $table }}',
                'model'         =>  $model,
                'mode'          =>  'create',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,

                ])
        </div>

    </div>

@endsection
