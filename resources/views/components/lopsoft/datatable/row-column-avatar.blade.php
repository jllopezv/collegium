@props([
    'link'      =>  '',
    'avatar'    =>  config('lopsoft.default_avatar'),
    'justify'   =>  'center',
])

<td {{ $attributes->merge([ 'class' => 'px-2 text-gray-600 py-1' ]) }}>
    <div class='flex items-center justify-{{$justify}}'>
        @if($link!='')
            <a class='text-blue-500 hover:text-blue-700' href='{{ $link }}'>
        @endif
        <img class='rounded-full h-auto w-full' src='{{ $avatar }}' />
        @if($link!='')
            </a>
        @endif
    </div>
</td>
