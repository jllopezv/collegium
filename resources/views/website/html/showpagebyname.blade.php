@extends('website.layouts.pagelayout')

@php
    $page=\App\Models\Website\WebsitePage::where('page', $pagename)->first();
@endphp

@section('content')

    @if($page!=null)
        <div class='flex items-center justify-center'>
            <div class='mt-4 w-3/4'>
                {!! $page->body !!}
            </div>
        </div>
    @endif

@endsection
