@extends('website.layouts.maintenancelayout')

    @php
        $page=\App\Models\Website\WebsitePage::where('page',appsetting('website_maintenance_mode_page_name'))->first();
    @endphp

@section('content')

    @if($page!=null)
        <div class=''>
            {!! $page->body !!}
        </div>
    @else
        <div class='w-full text-center font-bold text-red-500 text-4xl'>
            SITIO WEB EN MANTENIMIENTO
        </div>
        <div class='w-full text-center text-red-500 text-2xl'>
            DISCULPEN LOS INCOVENIENTES
        </div>
    @endif

@endsection
