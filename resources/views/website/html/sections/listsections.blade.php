@php
    $sections=\App\Models\Website\WebsiteSection::query()->published()->orderBy('fixed','desc')->orderBy('top','desc')->orderBy('priority','asc')->orderBy('created_at','desc')->get();
@endphp

@if($sections->count()>0)
    <div class='flex flex-wrap items-center justify-center bg-white'>
        @foreach($sections as $section)
            @include('website.html.sections.sections', [ 'section' => $section])
        @endforeach
    </div>
@endif
