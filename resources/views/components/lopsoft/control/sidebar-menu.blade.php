@props(['icon','link','text', 'menuid', 'help' => '', 'look' => '' ,'classmenu' => ''])
<div class=''>
    <div
        x-on:click.prevent="menuEvent('{{$menuid}}')"
        class='p-2 mx-2 text-gray-500 transition-all duration-300 rounded-md cursor-pointer hover:bg-gray-700 {{ $classmenu!=''?$classmenu:'hover:text-gray-400' }} ' >

        <div class='flex justify-between'>
            <div class='flex items-center'>
                <div class="pr-1"
                    x-on:click.prevent="iconEvent('{{$menuid}}')">
                        <i class='{{ $icon }} fa-lg fa-fw'></i>
                </div>
                <div
                    {{ $attributes }}
                    :class="' font-bold transition-all duration-300 '+(opensidebar?'visible opacity-100  text-left':'opacity-0 invisible')">
                    {!! $text !!}
                </div>
            </div>
            <div
                {{ $attributes }}
                :class="' font-bold transition-all duration-300 '+(opensidebar?'visible opacity-100  text-left':'invisible opacity-0')">
                <i id='iconsidebarmenu_{{ $menuid }}' class='fa fa-angle-down'></i>
            </div>
        </div>

    </div>
    <div  id='sidebarmenu_{{ $menuid }}' :class="' '+(opensidebar?'opacity-100 block text-left':'opacity-0 hidden')" style='display: none;'>
        {!! $slot !!}
    </div>
</div>
