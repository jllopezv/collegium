<div x-cloak x-data="{showselect: false}"
    @click="showselect=true"
    @click.away='showselect=false' >
    <input type='text' class='form-input px-1 pb-1 text-lg rounded-none border-b-2 border-t-0 border-l-0 border-r-0 border-gray-300
                        hover:border-gray-500 hover:shadow-none
                        active:border-gray-500 active:shadow-none
                        focus:border-gray-500 focus:shadow-none
                                transition-all duration-300 w-full' />
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
        <input type='text' class='w-full border border-gray-400 p-2' placeholder='buscar...' />
        <div class=' max-h-32 overflow-y-scroll'>
            @foreach($options as $option)
                <div class='flex items-center justify-center  bg-red-100' @click="showselect=false">
                    <div class='p-2 cursor-pointer'>
                        <x-lopsoft.control.avatar avatar="http://collegium.devel:8000/storage/system/userdefault.png"/>
                    </div>
                    <div class='p-2 bg-yellow-100
                        cursor-pointer
                        hover:bg-blue-100
                        w-full
                    '>{!! $option !!}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
