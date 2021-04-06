@php
    $banner=App\Models\Website\WebsiteBanner::getBanner(appsetting('WEBSITE_BANNER_MAIN'));
    $images=null;
    if ($banner) $images=$banner->images;
@endphp

@if($images)
    <div class="fotorama"
        data-width="100%"
        data-height="auto"
        data-transition="slide"
        data-autoplay="8000"
        data-loop="true"
        data-autoplay="true"
        data-arrows="false"
        data-click="false"
        data-swipe="true"
        data-nav="false"
        data-fit="cover">
        @foreach($images as $image)

            <div data-img='{{ $image->urlImage }}'>

                    <div >

                        {{--<div class='align-center w-100 mt-2'>
                            <div class='navigation-text-container mx-auto' style='width: 50%'>
                                @if($image->getCustomProperty('title')!='')
                                    <div class='navigation-title'>{{ $image->getCustomProperty('title')}}</div>
                                @endif
                            </div>
                        </div> --}}

                        {{--<div>{!! $image->getCustomProperty('body') !!}</div>--}}
                    </div>

            </div>
        @endforeach
    </div>
@else
    <img style='width: 100%;height: auto' src="{{ getImage('') }}" >
@endif
