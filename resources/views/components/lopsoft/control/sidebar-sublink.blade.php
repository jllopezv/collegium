@props(['icon','link' => '','text' =>'' , 'help' => ''])

<div {{ $attributes->merge([

    'class' =>  'text-gray-400 mx-2 p-2  hover:bg-gray-700 hover:text-white rounded-md transition-all duration-300'

])}} >

    @if($link)
        <a href='{{ $link }}'  >
    @endif
    <div class='flex items-center pl-2 cursor-pointer'>
        <div class="pr-1">
            <div class='tooltip'>
            <i class='{{ $icon }} fa-lg fa-fw'></i>
            <span class='tooltiptext tooltiptext-center-right'
                x-show.transition='!opensidebar'>
                {{ $help }}
            </span>
            </div>
        </div>
        <div
            {{ $attributes }}
            x-show.transition='opensidebar'
            :class="' cursor-pointer font-bold transition-opacity duration-300 '+(opensidebar?'opacity-100  text-left':'opacity-0')">
                {!! $text !!}
        </div>
    </div>
    @if($link)
        </a>
    @endif
</div>
