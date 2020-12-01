{{-- <div wire:loading.delay>
    <div  class='absolute top-0 left-0  w-full h-full  bg-black bg-opacity-75 z-10'>
        <div class='flex items-center justify-center content-center w-full h-full'>
            <div class='mx-auto text-white text-lg p-4 bg-gray-800 rounded-md'>
                <div class='flex items-center justify-center'>
                    <div>
                        <i class='fa fa-spinner fa-pulse'></i>
                    </div>
                    <div class='text-lg pl-2'>{{ $loading_message??'CARGANDO DATOS' }}</div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div wire:loading.delay class='absolute top-0 left-0  w-full h-full  z-10'>
        <div class='flex items-center justify-center content-center w-full h-full'>
            <div class='mx-auto text-white text-lg p-4 bg-gray-700 rounded-md'>
                <div class='flex items-center justify-center'>
                    <div>
                        <i class='fa fa-spinner fa-pulse'></i>
                    </div>
                    <div class='text-lg font-bold pl-2'>{{ $loading_message??'CARGANDO DATOS' }}</div>
                </div>
            </div>
        </div>
    </div>

