@extends('lopsoft.layouts.page')

@section('content')

    <div>
        <div class='px-4 py-5 bg-gray-200 shadow'>
            <div class="text-xl text-gray-800 md:text-2xl ">CONFIGURACIÓN DEL SISTEMA</div>
            <div class="text-xl text-gray-700 md:text-xl ">Seleccione las opciones de configuración</div>
        </div>
    </div>
    <div class='flex flex-wrap items-start justify-between md:h-full'>
        <div class='w-full h-full md:w-1/4'>
            @livewire('setting.config-page-component')
        </div>
        <div class='w-full h-full bg-white md:w-3/4 '>
            @livewire('setting.config-page-content-component')
        </div>
    </div>

@endsection
