<div x-show='$wire.showcustommessage===true && $wire.custommessage!="" ' class='absolute top-0 left-0 z-50 w-full h-full'>
    <div class='flex items-center content-center justify-center w-full h-full'>
        <div class='p-4 mx-auto text-lg text-white bg-gray-700 rounded-md'>
            <div class='flex items-center justify-center'>
                <div>
                    <i class="fas fa-circle-notch fa-spin"></i>
                </div>
                <div class='pl-2 text-lg font-bold'>{{ $custommessage!=""?$custommessage:'ESPERE...' }}</div>
            </div>
        </div>
    </div>
</div>


