@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'edit'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>
        <div class='w-full mx-auto'>
            @livewire('aux.image-component', [
                'table'         =>  '{{ $table }}',
                'model'         =>  $model,
                'mode'          =>  'edit',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'record'        =>  $record,
                'recordid'      =>  $recordid,
                'callback'            =>  isset($callback)?$callback:null,
                'paramscallback'      =>  isset($paramscallback)?$paramscallback:null,
                'callforward'            =>  isset($callforward)?$callforward:null,
                'paramscallforward'      =>  isset($paramscallforward)?$paramscallforward:null,
                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection
