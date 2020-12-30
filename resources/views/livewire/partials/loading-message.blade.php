<div wire:loading.delay class='absolute top-0 left-0 z-10 w-full h-full'>
    <div class='flex items-center content-center justify-center w-full h-full'>
        <div class='p-4 mx-auto text-lg text-white bg-gray-700 rounded-md'>
            <div class='flex items-center justify-center'>
                <div>
                    <i class='fa fa-spinner fa-pulse'></i>
                </div>
                <div class='pl-2 text-lg font-bold'>{{ $loading_message??'CARGANDO DATOS' }}</div>
            </div>
        </div>
    </div>
</div>


