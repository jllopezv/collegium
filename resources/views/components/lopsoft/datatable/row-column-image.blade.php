@props([
    'link'      =>  '',
    'image'     =>  config('lopsoft.posts_default_avatar'),
    'justify'   =>  'center',
    'classcontainer'    =>  ''
])

<td {{ $attributes->merge([ 'class' => 'px-2 text-gray-600 py-1' ]) }}>
    <div class='flex items-center justify-{{$justify}} {{$classcontainer}}'>
        @if($link!='')
            <a class='text-blue-500 hover:text-blue-700' href='{{ $link }}'>
        @endif
        <img class='w-full h-auto' src='{{ $image }}' />
        @if($link!='')
            </a>
        @endif
    </div>
</td>
