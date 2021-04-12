@php
    $ads=\App\Models\Website\WebsiteAdvertisement::query()->published()->orderBy('fixed','desc')->orderBy('top','desc')->orderBy('created_at','desc')->take(appsetting('advertisements_to_show'))->get();
@endphp

@if($ads->count()>0)
    {{--<div class='w-full xl:w-2/3 bg-gray-200'>--}}
    <div class='flex flex-wrap items-center justify-center p-2 bg-gray-200'>
        @foreach($ads as $ad)
            @include('website.html.ads.ads', [ 'ad' => $ad])
        @endforeach
    </div>
    {{--</div>--}}
@endif
