@props([
    'title' =>  'OPTION',
    'index' =>  1,
])

<div x-show='optionActive!={{$index}}' @click='for(o=1;o<showOption.length;o++) showOption[o]=false; showOption[{{$index}}]=true; optionActive={{$index}};'
    class='px-4 py-3 m-1 font-bold text-gray-800 rounded-md cursor-pointer text-md md:text-xl hover:text-white hover:bg-cool-gray-500'>
    {{ $title }}
</div>
{{-- ACTIVE --}}
<div x-show='optionActive=={{$index}}' @click='for(o=1;o<showOption.length;o++) showOption[o]=false; showOption[{{$index}}]=true;'
    class='px-4 py-3 m-1 font-bold text-green-300 bg-gray-700 rounded-md cursor-pointer text-md md:text-xl'>
    {{ $title }}
</div>
