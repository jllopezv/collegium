@props(['link' => ''])
<a
    @if($link)
        href="{{$link}}"
    @endif
    {{ $attributes->merge([
        'class' =>  'cursor-pointer rounded-md transition-all duration-300 block px-4 py-2 font-bold text-sm leading-5 text-gray-500 hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-100 focus:text-gray-900'
    ]) }}
    role="menuitem">
    {!! $slot !!}
</a>
