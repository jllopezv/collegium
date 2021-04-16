@extends('website.layouts.postlayout')

@php
    $post=\App\Models\Website\WebsitePost::find($id);
    if ($post!=null) $post->addShowed();
@endphp

@section('content')

    @if($post!=null)
        <img src='{{ $post->image }}' />
    @else
        @include('website.html.errormessage', [
            'message'   => 'NO EXISTE EL ARTÍCULO SOLICITADO',
            'backroute' => route('website.welcome')])
    @endif

@endsection
