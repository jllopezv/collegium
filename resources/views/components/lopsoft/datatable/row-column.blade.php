@props([
    'link'      =>  '',
    'canshow'   => true,
])

<td {{ $attributes->merge([ 'class' => 'px-2 py-2 text-gray-600' ]) }}>
    @if($link!='' && $canshow)
        <a class='' href='{{ $link }}'>
    @endif
    <div class='w-full overflow-x-hidden'>
        {{ $slot }}
    </div>
    @if($link!='')
        </a>
    @endif
</td>
