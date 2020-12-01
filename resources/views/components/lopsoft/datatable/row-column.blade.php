@props([
    'link'      =>  '',
])

<td {{ $attributes->merge([ 'class' => 'px-2 py-2 text-gray-600' ]) }}>
    @if($link!='')
        <a class='' href='{{ $link }}'>
    @endif
    <div class='overflow-x-hidden w-full'>
        {{ $slot }}
    </div>
    @if($link!='')
        </a>
    @endif
</td>
