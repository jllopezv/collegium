@props(['link' => ''])

@if($link)
<a href='{{$link}}'>
@endif
    <img {{ $attributes }} />
@if($link)
</a>
@endif
