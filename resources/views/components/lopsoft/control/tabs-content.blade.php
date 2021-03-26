@props([
    'index' =>  1,
])
<div x-show.transition.opacity.in.duration.500ms='showOption[{{$index}}]' class='h-full'>
    {!! $slot !!}
</div>
