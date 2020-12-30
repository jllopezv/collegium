@extends('lopsoft.layouts.voidpage')

@section('content')

    PAGINA DE PRUEBA DE FILEMANAGER<BR/>

    <a onclick="window.open('{{ route('filemanager.browser') }}', 'Popup', 'location,status,scrollbars,resizable,width=800, height=800');">SELECCIONAR ARCHIVO</a><BR/>

    Seleccion:
    <div x-data="{showtext: true}">
        <div @filemanagerselect='showtext=true' x-show='showtext'>
            seleccionado: <input type='text'  />
        </div>
    </div>



@endsection
