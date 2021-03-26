@props([
    'justify'   =>  'start',
    'link'      =>  '',
    'avatar'    =>  '',
])

<div class='flex items-center justify-{{$justify}}'>
    @if($link!='')
        <a class='text-blue-500 hover:text-blue-700' href='{{ $link }}'>
    @endif
    <img class='w-12 h-auto rounded-full' src='{{ $avatar }}' />
    @if($link!='')
        </a>
    @endif
</div>
