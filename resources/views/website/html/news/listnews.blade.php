@php
    $news=\App\Models\Website\WebsiteNews::query()->published()->orderBy('fixed','desc')->orderBy('top','desc')->orderBy('created_at','desc')->take(appsetting('news_to_show'))->get();
@endphp

@if($news->count()>0)
    {{--<div class='w-full xl:w-1/3  h-full'>--}}
    <div class='text-center font-bold text-4xl text-red-500 mt-8'>
        ÚLTIMAS NOTICIAS
    </div>
    <div class='flex flex-wrap items-center justify-center p-2'>
        @foreach($news as $newsitem)
            @include('website.html.news.news', [ 'newsitem' => $newsitem])
        @endforeach
    </div>
    {{--</div>--}}
@endif
