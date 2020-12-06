<div x-cloak x-data="{showselect: false}"
    @click="showselect=true"
    @click.away='showselect=false' >
    <input type='text' class='w-full px-1 pb-1 text-lg transition-all duration-300 border-t-0 border-b-2 border-l-0 border-r-0 border-gray-300 rounded-none form-input hover:border-gray-500 hover:shadow-none active:border-gray-500 active:shadow-none focus:border-gray-500 focus:shadow-none' />
    @php
        $options=[];
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
        $options[]="<span class='text-gray-400'>OPCION</span>";
    @endphp

    <div x-show.transition='showselect' class='border border-gray-300' >
        <input type='text' class='w-full p-2 border border-gray-400' placeholder='buscar...' />
        <div class='overflow-y-scroll  max-h-32'>
            @foreach($options as $option)
                <div class='flex items-center justify-center bg-red-100' @click="showselect=false">
                    <div class='p-2 cursor-pointer'>
                        <x-lopsoft.control.avatar avatar="http://collegium.devel:8000/storage/system/userdefault.png"/>
                    </div>
                    <div class='w-full p-2 bg-yellow-100 cursor-pointer hover:bg-blue-100 '>{!! $option !!}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
