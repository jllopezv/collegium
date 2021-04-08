@extends('website.layouts.mainlayout')

@php
    $ads=\App\Models\Website\WebsiteAdvertisement::orderBy('fixed','desc')->orderBy('top','desc')->orderBy('created_at','asc')->get();
@endphp

@section('content')

    <div class='flex flex-wrap items-center justify-center p-2'>
        @foreach($ads as $ad)

            @if($ad->published)

                @include('website.html.ads.ads', [ 'ad' => $ad])

            @endif

        @endforeach
    </div>

@endsection
