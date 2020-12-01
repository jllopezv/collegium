@props([
    'justify'   =>  'start',
    'link'      =>  '',
    'avatar'    =>  '',
])

<div class='flex items-center justify-{{$justify}}'>
    @if($link!='')
        <a class='text-blue-500 hover:text-blue-700' href='{{ $link }}'>
    @endif
    <img class='rounded-full h-auto w-12' src='{{ $avatar }}' />
    @if($link!='')
        </a>
    @endif
</div>
