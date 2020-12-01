@props(['icon','link','text', 'menuid', 'help' => '', 'look' => '' ])
<div class=''>
    <div
        x-on:click.prevent="menuEvent('{{$menuid}}')"
        class='cursor-pointer mx-2 p-2 transition-all duration-300 rounded-md text-gray-500 hover:bg-gray-700 hover:text-white ' >

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
