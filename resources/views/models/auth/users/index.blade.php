@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'index'] )

    <div class='px-2 py-4'>
        @livewire('auth.user-component', [
            'table'     =>  $table,
            'model'     =>  $model,
            'mode'      =>  'index',
            'title'     =>  $title,
            'subtitle'  =>  $subtitle,
            'minwidth'  =>  '1000px'])
    </div>

@endsection
