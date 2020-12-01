<div
    class='text-gray-500 mx-2 p-2 mt-1  hover:bg-gray-700 hover:text-white rounded-md cursor-pointer transition-all duration-300'
    x-on:click.prevent='toggleSidebar()'>
    <div class='flex items-center '>
        <div class="pr-1">
            <i id='iconopensidebar'  class='fa fa-angle-right fa-lg fa-fw'></i>
        </div>
        <div
            x-show.transition='opensidebar'
            :class="'font-bold transition-opacity duration-300 '+(opensidebar?'opacity-100  text-left':'opacity-0')">
        </div>
    </div>
</div>


