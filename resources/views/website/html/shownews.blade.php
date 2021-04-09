@extends('website.layouts.newslayout')

@php
    $newsitem=\App\Models\Website\WebsiteNews::find($id);

@endphp

@section('content')

    <div class='flex items-center justify-center mt-2 p-2 md:p-0'>
        <div>
            <img class=' rounded-lg shadow-lg' src='{{ getImage($newsitem->image,false) }}' />
        </div>
    </div>
    <div class='text-sm px-4'>
        {!! getAgo($newsitem->created_at) !!}
    </div>
    <div class='text-xl font-bold text-center mt-4'>
        {!! $newsitem->title !!}
    </div>

    <div class='mt-4 p-4'>
        {!! $newsitem->body !!}
    </div>

@endsection
