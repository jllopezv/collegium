@extends('website.layouts.advertisementlayout')

@php
    $ad=\App\Models\Website\WebsiteAdvertisement::find($id);
    if ($ad!=null) $ad->addShowed();
@endphp

@section('content')

    @if($ad!=null)
        <div class='flex items-center justify-center mt-2 p-2 md:p-0'>
            <div>
                <img class=' rounded-lg shadow-lg' src='{{ getImage($ad->image,false) }}' />
            </div>
        </div>
        {{--<div class='text-sm px-4'>
            {!! getAgo($ad->created_at) !!}
        </div>--}}
        <div class='text-xl font-bold text-center mt-4'>
            {!! $ad->title !!}
        </div>

        <div class='mt-4 p-4'>
            {!! $ad->body !!}
        </div>
    @else
        @include('website.html.errormessage', [
            'message'   => 'NO EXISTE EL ANUNCIO SOLICITADO',
            'backroute' => route('website.welcome')])
    @endif

@endsection
