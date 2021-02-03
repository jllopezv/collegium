<div>
    <div class='flex items-center justify-between px-4 py-5 bg-gray-200 shadow'>
        <div class=''>
            <div class="text-xl text-gray-800 md:text-2xl ">{{ $headertext }}</div>
            <div class="text-xl text-gray-700 md:text-xl ">{{ $subheadertext??'' }}</div>
        </div>
        <div>
            @if ($mode!='index')
                @if( $routeback!='' )
                    <x-lopsoft.link.gray link="{{ $routeback }}" icon='fa fa-angle-double-left' text='VOLVER'></x-lopsoft.link.gray>
                @else
                    <x-lopsoft.link.gray link="{{ route($table.'.index') }}" icon='fa fa-angle-double-left' text='VOLVER'></x-lopsoft.link.gray>
                @endif
            @endif
        </div>
    </div>
</div>
