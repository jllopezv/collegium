@extends('website.layouts.pagelayout')

@php
    $page=\App\Models\Website\WebsitePage::find($id);
@endphp

@section('content')

    @if($page!=null)
        <div class='flex items-center justify-center'>
            <div class='mt-4 md:w-3/4'>
                {!! $page->body !!}
            </div>
        </div>
    @else
        @include('website.html.errormessage', [
            'message'   => 'NO EXISTE LA PÁGINA SOLICITADA',
            'backroute' => route('website.welcome')])
    @endif

@endsection
