<div style='height:500px'>
    <div class='flex items-center justify-center h-full'>
        <div class=''>
            <div class='flex items-center justify-center mb-4'>
                <div class=''><i class='fa fa-exclamation-circle text-red-500 fa-2x mr-4'></i></div>
                <div><span class='text-3xl font-bold text-red-500'>{{ $message }}</span></div>

            </div>
            <div class='flex items-center justify-center'>
                <x-lopsoft.link.danger link='{{ $backroute }}' text='VOLVER' />
            </div>
        </div>
    </div>
</div>
